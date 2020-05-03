<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = \App\Book::with('categories')->paginate(10);

        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create a books
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // menyimpan data buku
        $new_book = new \App\Book;
        $new_book->title = $request->get('title');
        $new_book->description = $request->get('description');
        $new_book->stock = $request->get('stock');
        $new_book->author = $request->get('author');
        $new_book->publisher = $request->get('publisher');
        $new_book->price = $request->get('price');

        $new_book->status = $request->get('save_action');

        // Cover image
        $cover = $request->file('cover');

        if ( $cover ) {
            $cover_path = $cover->store('book-cover', 'public');

            $new_book->cover = $cover_path;
        }

        $new_book->slug = \Str::slug($request->get('title'));
        $new_book->created_by = \Auth::user()->id;

        $new_book->save();

        // attache categories
        $new_book->categories()->attach($request->get('categories'));

        // cek apakah save draft atau publish
        if ( $request->get('save_action') == 'PUBLISH' ) {
            return redirect()->route('books.create')->with('status', 'Book published successfully');
        } else {
            return redirect()->route('books.create')->with('status', 'Book save to draft');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Tampilkan single book
        $book = \App\Book::findOrFail($id);

        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Edit buku
        $book = \App\Book::findOrFail($id);

        return view('books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update buku
        $book = \App\Book::findOrFail($id);

        $book->title = $request->get('title');
        $book->slug = $request->get('slug');
        $book->description = $request->get('description');
        $book->author = $request->get('author');
        $book->publisher = $request->get('publisher');
        $book->stock = $request->get('stock');
        $book->price = $request->get('price');

        $new_cover = $request->file('cover');

        if ( $new_cover ) {
            if ( $book->cover && file_exists(storage_path('app/public/' . $book->cover)) ) {
                \Storage::delete('public/'. $book->cover);
            }

            $new_cover_path = $new_cover->store('book-covers', 'public');

            $book->cover = $new_cover_path;
        }

        $book->updated_by = \Auth::user()->id;
        $book->status = $request->get('status');

        $book->save();

        $book->categories()->sync($request->get('categories'));

        return redirect()->route('books.edit', [$book->id])->with('status', 'Book succefully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // hapus buku
        $book = \App\Book::findOrFail($id);

        $book->delete();

        return redirect()->route('books.index')->with('status', 'Book moved to trash');
    }

    /**
     * Trash 
     */
    public function trash() {
        $books = \App\Book::onlyTrashed()->paginate(10);

        return view('books.trash', ['books' => $books]);
    }
}
