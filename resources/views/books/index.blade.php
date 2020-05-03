@extends('layouts.global')

@section('title')
    Book lists
@endsection

@section('pageTitle')
    Book lists
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection