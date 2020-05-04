@extends('layouts.global')

@section('title')
    Book Trashed
@endsection

@section('pageTitle')
    Book trashed
@endsection

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link  
                        {{ Request::get('status') == NULL && Request::path() == 'books' ? 'active' : '' }}" 
                        href="{{route('books.index')}}">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link
                        {{ Request::get('status') == 'publish' ? 'active' : '' }}" 
                        href="{{route('books.index', ['status' => 'publish'])}}">Publish</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link
                        {{ Request::get('status') == 'draft' ? 'active' : '' }}"
                        href="{{route('books.index', ['status' => 'draft'])}}">Draft</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link
                        {{ Request::path() == 'books/trash' ? 'active' : '' }}" 
                        href="{{route('books.trash')}}">Trash</a>
                    </li>
                    </ul>
                </div>
                </div>
                <hr class="my-3">

            <table class="table table-bordered table-stripped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Cover</th>
                        <th>Author</th>
                        <th>Categories</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>
                                @if ($book->cover)
                                    <img src="{{ asset('storage/'. $book->cover) }}" 
                                    width="80px">
                                @endif
                            </td>
                            <td>{{ $book->author }}</td>
                            <td>
                                @foreach ($book->categories as $category)
                                    <span class="badge bg-info">{{ $category->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $book->stock }}</td>
                            <td>{{ $book->price }}</td>
                            
                            <td>
                                <form action="{{ route('books.restore', [$book->id]) }}"
                                    method="POST"
                                    class="d-inline">
                                    @csrf

                                    <input type="submit"
                                    value="Restore"
                                    class="btn btn-success">
                                </form>

                                <form action="{{ route('books.delete-permanent', [$book->id]) }}"
                                class="d-inline"
                                onsubmit="return confirm('Delete this book permanently?')"
                                method="POST">
                                @csrf
                                <input type="hidden"
                                name="_method"
                                value="DELETE">

                                <input type="submit"
                                value="Delete"
                                class="btn btn-danger btn-sm">
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            {{ $books->appends(Request::all())->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection