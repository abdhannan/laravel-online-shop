@extends('layouts.global')

@section('title')
    Book Trashed
@endsection

@section('pageTitle')
    Book trashed
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
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
                            <td>TODO: Action</td>
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