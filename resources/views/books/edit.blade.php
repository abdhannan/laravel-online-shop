@extends('layouts.global')

@section('title')
    Edit Book
@endsection

@section('pageTitle')
    Edit Book
@endsection

@section('content')

    @if (session('status'))
        <div class="aler alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('books.update', [$book->id]) }}"
            class="p-3 shadow-sm bg-white"
            enctype="multipart/form-data"
            method="POST">
                @csrf
                <input type="hidden"
                name="_method" value="PUT">

                <label for="title">Title</label>
                <input type="text"
                name="title"
                value="{{ $book->title }}"
                class="form-control {{ $errors->first('title') ? "is-invalid" : "" }}">
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
                <br>

                <label for="cover">Cover</label>
                <small class="text-moted">Current cover image</small>
                @if ($book->cover)
                    <img src="{{ asset('storage/'. $book->cover) }}" 
                    width="100px">
                @endif
                <br><br>
                <input type="file"
                name="cover"
                id="cover"
                class="form-control {{ $errors->first('cover') ? "is-invalid" : "" }}">
                <small class="text-muted">Kosongkan jika tidak ingin diganti</small>

                <div class="invalid-feedback">
                    {{ $errors->first('cover') }}
                </div>
                <br><br>

                <label for="slug">Slug</label>
                <input type="text"
                name="slug"
                value="{{ $book->slug }}"
                class="form-control {{ $errors->first('slug') ? "is-invalid" : "" }}">
                <div class="invalid-feedback">
                    {{ $errors->first('slug') }}
                </div>
                <br>

                <label for="description">Description</label>
                <textarea name="description"
                id="description" class="form-control {{ $errors->first('description') ? "is-invalid" : "" }}"
                >{{ $book->description }}</textarea>
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}
                </div>
                <br>

                <label for="categories">Categories</label>
                <select name="categories[]" 
                id="categories" class="form-control {{ $errors->first('categories') ? "is-invalid" : "" }}" multiple></select>
                <div class="invalid-feedback">
                    {{ $errors->first('categories') }}
                </div>
                <br>

                <label for="author">Author</label>
                <input type="text" 
                name="author" 
                id="author"
                value="{{ $book->author }}"
                class="form-control {{ $errors->first('author') ? "is-invalid" : "" }}">
                <div class="invalid-feedback">
                    {{ $errors->first('author') }}
                </div>
                <br>

                <label for="publisher">Publisher</label>
                <input type="text"
                name="publisher"
                id="publisher"
                class="form-control {{ $errors->first('publisher') ? "is-invalid" : "" }}"
                value="{{ $book->publisher }}">
                <div class="invalid-feedback">
                    {{ $errors->first('publisher') }}
                </div>
                <br>

                <label for="stock">Stock</label>
                <input type="number"
                name="stock"
                class="form-control {{ $errors->first('stock') ? "is-invalid" : "" }}"
                value="{{ $book->stock }}">
                <div class="invalid-feedback">
                    {{ $errors->first('stock') }}
                </div>
                <br><br>

                <label for="price">Price</label>
                <input type="number"
                name="price"
                min="0"
                value="{{ $book->price }}"
                class="form-control {{ $errors->first('price') ? "is-invalid" : "" }}">
                <div class="invalid-feedback">
                    {{ $errors->first('price') }}
                </div>
                <br>

                <label for="for">Status</label>
                <select name="status" id="status" class="form-control">
                    <option {{ $book->status == 'PUBLISH' ? 'selected' : ''  }} value="PUBLISH">PUBLISH</option>
                    <option {{ $book->status == "DRAFT" ? 'selected' : '' }} value="DRAFT">DRAFT</option>
                </select>
                <br><br>

                <button class="btn btn-primary" value="PUBLISH">Update</button>
                <a href="{{ route('books.index') }}"
                class="btn btn-warning">Cancel</a>
            </form>
        </div>
    </div>
@endsection


@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>


$('#categories').select2({
    ajax: {
        url: 'http://toko-online.test/ajax/categories/search',
        processResults: function(data) {
            return {
                results: data.map(function(item){ return {id: item.id, text: item.name} })
            }
        }
    }
});

var categories = {!! $book->categories !!}

categories.forEach(function(category){
    var option = new Option(category.name, category.id, true, true);
    $('#categories').append(option).trigger('change');
});

</script>
@endsection