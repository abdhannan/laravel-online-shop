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
            class="form-control {{ $errors->first('name') ? "is-invalid" : "" }}"
            name="name"
            placeholder="Full Name"
            id="name"
            value="{{ old('name') }}">
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            <br>
    
            <label for="username">Username</label>
            <input type="text"
            class="form-control {{ $errors->first('username') ? "is-invalid" : "" }}"
            placeholder="Username"
            id="username"
            name="username"
            value="{{ old('username') }}">
            <div class="invalid-feedback">
                {{ $errors->first('username') }}
            </div>
            <br>
    
            <label for="">Roles</label>
            <br>
            <input type="checkbox"
            class="form-control {{ $errors->first('roles') ? "i-invalid" : "" }}"
            name="roles[]"
            id="ADMIN"
            value="ADMIN">
            <label for="ADMIN">Administrator</label>
            <br>
    
            <input type="checkbox"
            class="form-control {{ $errors->first('roles') ? "is-invalid" : "" }}"
            name="roles[]"
            id="STAFF"
            value="STAFF">
            <label for="STAFF">Staff</label>
            <br>
    
            <input type="checkbox"
            class="form-control {{ $errors->first('roles') ? "is-invalid" : "" }}"
            name="roles[]"
            id="CUSTOMER"
            value="CUSTOMER">
            <label for="CUSTOMER">Customer</label>

            <div class="invalid-feedback">
                {{ $errors->first('roles') }}
            </div>

            <br>
    
            <label for="phone">Phone Number</label>
            <input type="text"
            name="phone"
            placeholder="Phone Number"
            class="form-control {{ $errors->first('phone') ? "is-invalid" : "" }}"
            id="phone"
            value="{{ old('phone') }}">
            <div class="invalid-feedback">
                {{ $errors->first('phone') }}
            </div>
            <br>
    
            <label for="address">Address</label>
            <textarea name="address" 
            id="address"
            class="form-control {{ $errors->first('address') ? "is-invalid" : "" }}"
            >{{ old('address') }}</textarea>
            <div class="invalid-feedback">
                {{ $errors->first('address') }}
            </div>
            <br>
    
            <label for="avatar">Avatar image</label>
            <input type="file" 
            name="avatar" 
            id="avatar"
            class="form-control {{ $errors->first('avatar') ? "is-invalid" : "" }}"
            value="{{ old('avatar') }}">
            <div class="invalid-feedback">
                {{ $errors->first('avatar') }}
            </div>
            <hr class="my-4">
    
            <label for="email">Email</label>
            <input type="email"
            name="email"
            id="email"
            class="form-control {{ $errors->first('email') ? "is-invalid" : "" }}"
            placeholder="Email"
            value="{{ old('email') }}">
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
            <br>
    
            <label for="password">Password</label>
            <input type="password"
            id="password"
            name="password"
            placeholder="Password"
            class="form-control {{ $errors->first('password') ? "is-invalid" : ""}}">
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
            <br>
    
            <label for="password_confirmation">Password confirmation</label>
            <input type="password"
            class="form-control {{ $errors->first('password_confirmation') ? "is-invalid" : "" }}"
            placeholder="Password confirmation"
            type="password"
            name="password_confirmation"
            id="password_confirmation">
            <div class="invalid-feedback">
                {{ $errors->first('password_confirmation') }}
            </div>
            <br>
    
            <input type="submit"
            class="btn btn-primary"
            value="Save">
            <a href="{{ route('users.index') }}" class="btn btn-warning text-white">Cancel</a>
        </form>
    </div>

@endsection