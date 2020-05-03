@extends('layouts.global')

@section('title')
    List Users
@endsection

@section('pageTitle')
    List Users
@endsection

@section('content')

    @if ( session('status') )
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    
    <form action="{{route('users.index')}}">
        <div class="row">
            <div class="col-md-6">
                <input 
                  value="{{Request::get('keyword')}}" 
                  name="keyword" 
                  class="form-control" 
                  type="text" 
                  placeholder="Masukan email untuk filter..."/>
            </div>
            <div class="col-md-6">
                <input {{Request::get('status') == 'ACTIVE' ? 'checked' : ''}} 
                  value="ACTIVE" 
                  name="status" 
                  type="radio" 
                  class="form-control" 
                  id="active">
                  <label for="active">Active</label>
        
                <input {{Request::get('status') == 'INACTIVE' ? 'checked' : ''}} 
                  value="INACTIVE" 
                  name="status" 
                  type="radio" 
                  class="form-control" 
                  id="inactive">
                  <label for="inactive">Inactive</label>
        
                <input 
                  type="submit" 
                  value="Filter" 
                  class="btn btn-primary">

                  <a href="{{ route('users.create') }}" class="btn btn-primary float-right">Create User</a>
            </div>
        </div>
    </form>

    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Avatar</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->avatar)
                    <img src="{{ asset('storage/'.$user->avatar) }}" width="70px">
                    @else
                    N/A
                    @endif
                </td>
                <td>
                    @if( $user->status == "ACTIVE" )
                    <span class="badge badge-success">
                        {{ $user->status }}
                    </span>
                    @else
                    <span class="badge badge-danger">
                        {{ $user->status }}
                    </span>
                    @endif
                </td>
                <td>
                    
                    <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-info text-white btn-sm">Edit</a>
                    <a href="{{ route('users.show', [$user->id]) }}"
                        class="btn btn-primary btn-sm">Detail</a>

                    <form action="{{ route('users.destroy', [$user->id]) }}"
                        onsubmit="return confirm('Delete this user permanently?')"
                        class="d-inline"
                        method="POST">
                        @csrf
                        <input type="hidden" 
                        name="_method"
                        value="DELETE">

                        <input type="submit" class="btn btn-danger btn-sm"
                        value="Delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                {{-- pagination dan hasil filter tetap work --}}
                <td>{{ $users->appends(Request::all())->links() }}</td>
            </tr>
        </tfoot>
    </table>

@endsection