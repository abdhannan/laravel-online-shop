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
        <div class="col-md-12">
            <a href="{{ route('books.index') }}" class="btn btn-info">Back</a>
        </div>
        <div class="col-md-8">
            <form action="{{ route('books.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="shadow-sm p-3 bg-white">
                @csrf

                <label for="titke">Title</label>
                <input type="text"
                name="title"
                class="form-control {{ $errors->first('title') ? "is-invalid" : "" }}"
                placeholder="Title">
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
                <br>

                <label for="cover">Cover</label>
                <input type="file"
                name="cover"
                class="form-control {{ $errors->first('cover') ? "is-invalid" : "" }}"
                placeholder="Cover Book">
                <div class="invalid-feedback">
                    {{ $errors->first('cover') }}
                </div>
                <br>

                <label for="description">Description</label>
                <textarea name="description" 
                id="description"
                class="form-control {{ $errors->first('description') ? "is-invalid" : "" }}"
                placeholder="Give a description about this book"></textarea>
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}
                </div>
                <br>

                <label for="categories">Categories</label>
                <select name="categories[]" 
                id="categories"
                multiple
                class="form-control {{ $errors->first('categories') ? "is-invalid" : "" }}">
                </select>
                <div class="invalid-feedback">
                    {{ $errors->first('categories') }}
                </div>
                <br>

                <label for="stock">Stock</label>
                <input type="number"
                class="form-control {{ $errors->first('stock') ? "is-invalid" : "" }}"
                id="stock"
                name="stock"
                min="0"
                value="0">
                <div class="invalid-feedback">
                    {{ $errors->first('stock') }}
                </div>
                <br>

                <label for="author">Author</label>
                <input type="text"
                name="author"
                id="author"
                class="form-control {{ $errors->first('author') ? "is-invalid" : "" }}"
                placeholder="Book Author">
                <div class="invalid-feedback">
                    {{ $errors->first('author') }}
                </div>
                <br>

                <label for="publisher">Publisher</label>
                <input type="text"
                name="publisher"
                class="form-control {{ $errors->first('publisher') ? "is-invalid" : "" }}"
                id="publisher"
                placeholder="Publisher">
                <div class="invalid-feedback">
                    {{ $errors->first('publisher') }}
                </div>
                <br>

                <label for="price">Price</label>
                <input type="number"
                name="price"
                class="form-control {{ $errors->first('price') ? "is-invalid" : "" }}"
                min="0"
                placeholder="Book price">
                <div class="invalid-feedback">
                    {{ $errors->first('price') }}
                </div>
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