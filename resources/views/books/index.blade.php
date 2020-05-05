@extends('layouts.global')

@section('title')
    Book lists
@endsection

@section('pageTitle')
    Book lists
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
                    <div class="col-md-6">
                        <form action="{{ route('books.index') }}">
                            <div class="input-group">
                                <input type="text"
                                name="keyword"
                                value="{{ Request::get('keyword') }}"
                                class="form-control"
                                placeholder="Filter by title">
                                <div class="input-group-append">
                                    <input type="submit"
                                    class="btn btn-primary" value="Filter">
                                </div>
                            </div>
                        </form>
                    </div>
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
            <div class="row mb-3">
                <div class="col-md-12 text-right">
                <a href="{{ route('books.create') }}"
                class="btn btn-primary">Create Book</a>
                </div>
            </div>

            <table class="table table-bordered table-stripped">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Categories</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>
                                @if ($book->cover)
                                    <img src="{{ asset('storage/'. $book->cover) }}"
                                    width="75px">                                    
                                @endif
                            </td>

                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>
                                @if ($book->status == "DRAFT")
                                    <span class="badge bg-dark text-white">{{ $book->status }}</span>
                                @else
                                    <span class="badge badge-success">{{ $book->status }}</span>
                                @endif
                            </td>
                            <td>
                                <ul class="pl-3">
                                    @foreach ($book->categories as $category)
                                        <li>{{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $book->stock }}</td>
                            <td>{{ $book->price }}</td>
                            <td>
                                <a href="{{ route('books.edit', [$book->id]) }}"
                                    class="btn btn-info btn-sm">Edit</a>
                                
                                <a href="{{ route('books.show', [$book->id]) }}"
                                    class="btn btn-primary btn-sm">Show</a>
                                
                                <form action="{{ route('books.destroy', [$book->id]) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Move book to trash?')">
                                    @csrf
                                    <input type="hidden"
                                    name="_method"
                                    value="DELETE">

                                    <input type="submit"
                                    class="btn btn-danger btn-sm"
                                    value="Trash">
                                </form>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    {{ $books->appends(Request::All())->links() }}
                </tfoot>
            </table>
        </div>
    </div>
@endsection