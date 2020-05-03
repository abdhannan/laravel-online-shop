<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // menampilkan categories
        $categories = \App\Category::paginate(10);

        // ambil filter by name
        $filterName = $request->get('name');

        if ( $filterName ) {
            $categories = \App\Category::where('name', 'LIKE', "%$filterName%")->paginate(10);
        }

        
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // membuat category
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // menambah category
        $name = $request->get('name');

        $new_category = new \App\Category;
        
        $new_category->name = $name;

        if ($request->file('image')) {
            
            $image_path = $request->file('image')
                                  ->store('category_images', 'public');
            $new_category->image = $image_path;
        }
        
        // Menagmbil ID yg user login
        $new_category->created_by = \Auth::user()->id;

        $new_category->slug = \Str::slug($name, '-');

        $new_category->save();
        return redirect()->route('categories.create')->with('status', 'Category successfully create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ambil ID
        $category = \App\Category::findOrFail($id);

        return view('categories.show', ['category' => $category]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // edit category
        $category = \App\Category::findOrFail($id);

        return view('categories.edit', ['category' => $category]);

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
        //
        $name = $request->get('name');
        $slug = $request->get('slug');

        // Cek ID mana yg diupdate
        $category = \App\Category::findOrFail($id);

        // Assign ke nama table
        $category->name = $name;
        $category->slug = $slug;

        // Cek apakah gambar diupate
        if ( $request->file('image') ) {
            // cek apakah ada image di storage
            if ( $category->image && file_exists(storage_path('app/public/'. $category->image)) ) {
                // Jika ada hapus
                \Storage::delete('public/'. $category->image);
            }

            // masukkan gambar baru ke storage
            $new_image = $request->file('image')->store('category_images', 'public');

            // assign ke table
            $category->image = $new_image;
        }

        // field updated by assign ke users
        $category->updated_by = \Auth::user()->id;

        // category slug jadikan slud
        $category->slug = \Str::slug($name);

        // save
        $category->save();

        // redirect dengan pesan
        return redirect()->route('categories.edit', [$id])->with('status', 'Category successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan ID
        $category = \App\Category::findOrFail($id);

        // hapus gambar
        // if ( $category->image && file_exists( storage_path('app/public/'. $category->image) ) ) {
        //     // hapus
        //     \Storage::delete('public/'. $category->image);
        // }

        // hapus category
        $category->delete();

        return redirect()->route('categories.index')
        ->with('status', 'Category succesfully moved to trash');
    }


    /** 
    * Show soft delete
    *
    * @param int $id
    */
    public function trash() {
        $deleted_categories = \App\Category::onlyTrashed()->paginate(10);

        return view('categories.trash', ['categories' => $deleted_categories]);
    }


    /**
     * Restore category
     * @param int $id
     * 
     */
    public function restore($id) {
        // mencari category dengan ID yg statusnya trashed
        $category = \App\Category::withTrashed()->findOrFail($id);

        // Cek apakah actegory dengan ID tsb ada di trash
        if ( $category->trashed()) {
            // Jika ada, maka restore
            $category->restore();
        } else {
            // Jika tidak ada di trash, redirect ke awal dan tampilkan pesan
            return redirect()->route('categories.index')
            ->with('status', 'Category is not in trash');
        }

        // jika berhasil restore, redirect ke awal dan kirim pesan
        return redirect()->route('categories.index')->with('status', 'Category successfully restored');
    }


    /**
     * Delete category permanently
     * 
     * @param int $id
     */
    public function deletePermanent($id) {
        // Ambil id
        $category = \App\Category::withTrashed()->findOrFail($id);

        // Apakah tidak ada di trash
        if ( !$category->trashed() ) {
            // jika tidak ada di trash
            return redirect()->route('categories.index')->with('status', 'Can not delete category permanently');
        } else {
            // hapus gambar
            if ( $category->image && file_exists( storage_path('app/public/'. $category->image) ) ) {
                // hapus
                \Storage::delete('public/'. $category->image);
            }

            // Jika ada di trash
            $category->forceDelete();

            return redirect()->route('categories.index')->with('status', 'category permanently deleted');
        }
    }


    /**
     * Ajx search
     * 
     * @param int $id
     */
    public function ajaxSearch(Request $request) {
        $keyword = $request->get('q');

        $categories = \App\Category::where("name", "LIKE", "%$keyword%")->get();

        return $categories;
    }

}
