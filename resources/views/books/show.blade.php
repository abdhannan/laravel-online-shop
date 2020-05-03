@extends('layouts.global')

@section('title')
    Book Details
@endsection

@section('pageTitle')
    Book Details
@endsection

@section('content')
    {{ $book->title }}
@endsection