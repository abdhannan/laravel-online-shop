@extends('layouts.global')

@section('title')
    Edit User
@endsection

@section('pageTitle')
    Edit User
@endsection

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    <form action="{{ route('users.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <label for="name">Full Name</label>
        <input type="text"
        name="name"
        id="name"
        value="{{ old('name') ? old('name') : $user->name }}"
        placeholder="Full Name"
        class="form-control {{ $errors->first('name') ? "is-invalid" : "" }}">
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>

        <br>

        <label for="username">Username</label>
        <input type="text"
        disabled
        name="username"
        value="{{ $user->username }}"
        class="form-control"
        id="username"
        placeholder="Username">

        <br>
        <label for="">Status</label>
        <br>
        <input {{ $user->status == "ACTIVE" ? "checked" : "" }}
        value="ACTIVE"
        type="radio"
        class="form-control"
        id="active"
        name="status">
        <label for="active">Active</label>
        
        <input {{ $user->status == "INACTIVE" ? "checked" : "" }}
        type="radio"
        value="INACTIVE"
        id="inactive"
        name="status"
        class="form-control">
        <label for="inactive">Inactive</label>
        <br><br>

        <label for="roles">Roles</label> <br>
        <input type="checkbox" 
        {{ in_array("ADMIN", json_decode($user->roles))  ? "checked" : "" }} 
        name="roles[]"
        id="ADMIN"
        value="ADMIN"
        class="form-control {{ $errors->first('roles') ? "is-invalid" : "" }}">
        <label for="ADMIN">Administrator</label>

        <input type="checkbox" 
        {{ in_array("STAFF", json_decode($user->roles)) ? "checked" : "" }} 
        name="roles[]" 
        id="STAFF"
        value="STAFF"
        class="form-control {{ $errors->first('roles') ? "is-invalid" : "" }}">
        <label for="STAFF">Staff</label>

        <input type="checkbox"
        {{ in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : "" }}
        name="roles[]"
        id="CUSTOMER"
        value="CUSTOMER"
        class="form-control {{ $errors->first('roles') ? "is-invalid" : "" }}">
        <label for="CUSTOMER">Customer</label>

        <div class="invalida-feedback">
            {{ $errors->first('roles') }}
        </div>

        <br>
        <br>
        <label for="phone">Phone</label>
        <input type="text"
        name="phone"
        value="{{ $user->phone }}"
        id="phone"
        class="form-control {{ $errors->first('phone') ? "is-invalid" : "" }}">

        <div class="invalid-feedback">
            {{ $errors->first('phone') }}
        </div>
        <br>

        <label for="address">Address</label>
        <textarea name="address" 
        id="address"
        class="form-control {{ $errors->first('address') ? "is-invalid" : "" }}">
        {{ old('address') ? old('address') : $user->address }}</textarea>
        
        <div class="invalid-feedback">
            {{ $errors->first('address') }}
        </div>
        <br>

        <label for="avatar">Avatar Image</label>
        <br> Current avatar: <br>
        @if ($user->avatar)
        <img src="{{ asset('storage/'. $user->avatar) }}" width="70px">
        <br>
        @else
        No Avatar
        @endif
        <br>
        <input type="file"
        name="avatar"
        id="avatar"
        class="form-control">
        <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>

        <hr class="my-3">

        <label for="email">Email</label>
        <input type="email"
        disabled
        value="{{ $user->email }}"
        name="email"
        id="email"
        placeholder="user@mail.com"
        class="form-control">
        <br>
        <input type="submit"
        class="btn btn-primary"
        value="SAVE">

        <a href="{{ route('users.index') }}" class="btn btn-warning">Cancel</a>

    </form>

@endsection