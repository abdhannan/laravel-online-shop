@extends('layouts.global')

@section('title')
    Edit Book
@endsection

@section('pageTitle')
    Edit Book
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('books.update', [$book->id]) }}"
            class="p-3 shadow-sm bg-white"
            enctype="multipart/form-data"
            method="POST">
                
            </form>
        </div>
    </div>
@endsection