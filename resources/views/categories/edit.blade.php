@extends('layouts.global')

@section('title')
    Edit Category
@endsection

@section('pageTitle')
    Edit category {{ $category->name }}
@endsection

@section('content')

    @if ( session('status') )
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="col-md-8">
        <form action="{{ route('categories.update', [$category->id]) }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white shadow-sm p-3">
            @csrf
            <input type="hidden"
            value="PUT"
            name="_method">

            <label>Category Name</label>
            <input type="text"
            name="name"
            value="{{ $category->name }}"
            class="form-control {{ $errors->first('name') ? "is-invalid" : "" }}">
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            <br><br>

            <label>Category SLug</label>
            <input type="text"
            name="slug"
            value="{{ $category->slug }}"
            class="form-control {{ $errors->first('slug') ? "" : "" }}">
            <div class="invalid-feedback">
                {{ $errors->first('slug') }}
            </div>
            <br><br>

            <label>Current image</label><br>
            @if ($category->name)
                <img src="{{ asset('storage/'. $category->image) }}" width="75px">
            @else
                N/A
            @endif
            <br>
            <label>Category Image</label>
            <input type="file"
            name="image"
            class="form-control {{ $errors->first('image') ? "is-invalid" : "" }}">
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
            <span class="text-muted">Kosongkan jika tidak ingin diganti</span>
            <br><br>
            <input type="submit"
            value="Update" class="btn btn-primary">

            <a href="{{ route('categories.index') }}" class="btn btn-warning">Cancel</a>

        </form>
    </div>
@endsection