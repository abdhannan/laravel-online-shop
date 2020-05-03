@extends('layouts.global')
@section('title')
    Create Category
@endsection

@section('pageTitle')
    Create Category
@endsection

@section('content')
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('categories.store') }}"
    method="POST"
    enctype="multipart/form-data" class="bg-white shadow-sm p-3">

    @csrf
    <label for="name">Category Name</label>
    <input type="text"
    name="name"
    class="form-control"
    id="name"
    placeholder="Category Name">
    
    <br>

    <label>Category Image</label>
    <input type="file"
    name="image"
    class="form-control">

    <br>

    <input type="submit"
    value="Save"
    class="btn btn-primary">
    <a href="{{ route('categories.index') }}" class="btn btn-warning">Cancel</a>
    </form>

@endsection