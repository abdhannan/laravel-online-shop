@extends('layouts.global')

@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $('#categories').select2({
        ajax: {
        url: 'http://toko-online.test/ajax/categories/search',
        processResults: function(data){
            return {
            results: data.map(function(item){return {id: item.id, text: item.name} })
            }
        }
        }
    });
    </script>

@endsection

@section('title')
    Insert Books
@endsection

@section('pageTitle')
    Insert Books
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif    


    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('books.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="shadow-sm p-3 bg-white">
                @csrf

                <label for="titke">Title</label>
                <input type="text"
                name="title"
                class="form-control"
                placeholder="Title">
                <br>

                <label for="cover">Cover</label>
                <input type="file"
                name="cover"
                class="form-control"
                placeholder="Cover Book">
                <br>

                <label for="description">Description</label>
                <textarea name="description" 
                id="description"
                class="form-control"
                placeholder="Give a description about this book"></textarea>
                <br>

                <label for="categories">Categories</label>
                <select name="categories[]" 
                id="categories"
                multiple
                class="form-control">

                </select>

                <label for="stock">Stock</label>
                <input type="number"
                class="form-control"
                id="stock"
                name="stock"
                min="0"
                value="0">
                <br>

                <label for="author">Author</label>
                <input type="text"
                name="author"
                id="author"
                class="form-control"
                placeholder="Book Author">
                <br>

                <label for="publisher">Publisher</label>
                <input type="text"
                name="publisher"
                class="form-control"
                id="publisher"
                placeholder="Publisher">
                <br>

                <label for="price">Price</label>
                <input type="number"
                name="price"
                class="form-control"
                min="0"
                placeholder="Book price">
                <br>

                <button class="btn btn-primary"
                name="save_action"
                value="PUBLISH">Publish</button>

                <button class="btn btn-secondary"
                name="save_action"
                value="DRAFT">Save as draft</button>

            </form>
        </div>
    </div>

@endsection