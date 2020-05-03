@extends('layouts.global')

@section('title')
    Create User
@endsection

@section('pageTitle')
    Create User
@endsection

@section('content')
    
    <div class="col-md-8">

        {{-- flash message --}}
        @if( session('status') )
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{ route('users.store') }}" method="POST">
            @csrf
    
            <label for="name">Name</label>
            <input 
            type="text"
            class="form-control"
            name="name"
            placeholder="Full Name"
            id="name">
            <br>
    
            <label for="username">Username</label>
            <input type="text"
            class="form-control"
            placeholder="Username"
            id="username"
            name="username">
            <br>
    
            <label for="">Roles</label>
            <br>
            <input type="checkbox"
            name="roles[]"
            id="ADMIN"
            value="ADMIN">
            <label for="ADMIN">Administrator</label>
            <br>
    
            <input type="checkbox"
            name="roles[]"
            id="STAFF"
            value="STAFF">
            <label for="STAFF">Staff</label>
            <br>
    
            <input type="checkbox"
            name="roles[]"
            id="CUSTOMER"
            value="CUSTOMER">
            <label for="CUSTOMER">Customer</label>
            <br>
    
            <label for="phone">Phone Number</label>
            <input type="text"
            name="phone"
            placeholder="Phone Number"
            class="form-control"
            id="phone">
            <br>
    
            <label for="address">Address</label>
            <textarea name="address" 
            id="address"
            class="form-control"></textarea>
            <br>
    
            <label for="avatar">Avatar image</label>
            <input type="file" 
            name="avatar" 
            id="avatar"
            class="form-control">
            <hr class="my-3">
    
            <label for="email">Email</label>
            <input type="email"
            name="email"
            id="email"
            class="form-control"
            placeholder="Email">
            <br>
    
            <label for="password">Password</label>
            <input type="password"
            id="password"
            name="password"
            placeholder="Password"
            class="form-control">
            <br>
    
            <label for="password_confirmation">Password confirmation</label>
            <input type="password"
            class="form-control"
            placeholder="Password confirmation"
            type="password"
            name="password_confirmation"
            id="password_confirmation">
            <br>
    
            <input type="submit"
            class="btn btn-primary"
            value="Save">
            <a href="{{ route('users.index') }}" class="btn btn-warning text-white">Cancel</a>
        </form>
    </div>

@endsection