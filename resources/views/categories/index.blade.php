@extends('layouts.global')

@section('title')
    All Categories
@endsection

@section('pageTitle')
    All Categories
@endsection

@section('content')

    @if ( session('status') )
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {{-- Filter --}}
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('categories.index') }}">
                <div class="input-group">
                    <input type="text"
                    name="name"
                    class="form-control"
                    placeholder="filter by name">

                    <div class="input-group-append">
                        <input type="submit"
                        value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link active">Published</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.trash') }}" class="nav-link">Trash</a>
                </li>
            </ul>

            {{--  --}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Create category</a>
        </div>
    </div>
    <hr class="my-3">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td> {{ $category->name }} </td>
                <td> {{ $category->slug }} </td>
                <td>
                @if ( $category->image )
                    <img src="{{ asset('storage/' . $category->image) }}" width="75px">
                @else
                    No Image
                @endif
                </td>
                <td>
                    <a href="{{ route('categories.edit', [$category->id]) }}" 
                        class="btn btn-success btn-sm">Edit</a>
                    
                    <a href="{{ route('categories.show', [$category->id]) }}"
                        class="btn btn-primary btn-sm">Show</a>

                    {{-- Soft delete --}}
                    <form action="{{ route('categories.destroy', [$category->id]) }}"
                    method="POST"
                    onsubmit="return confirm('Move category to trash')">
                        @csrf
                        <input type="hidden"
                        value="DELETE"
                        name="_method">

                        <input type="submit"
                        class="btn btn-danger btn-sm"
                        value="Trash">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection