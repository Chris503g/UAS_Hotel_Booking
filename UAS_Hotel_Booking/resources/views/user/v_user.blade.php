@extends('layouts.adminlte')
@section('title', 'Users')

@section('content')

    @if (session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!!!</h4>
        {{ session('success') }}
    </div>
    @endif

    @if (session('failed'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-close"></i> Error!!!</h4>
        {{ session('failed') }}
    </div>
    @endif

    @if(session('alert'))
    <div class="alert alert-warning" role="alert">
        {{ session('alert') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <form class="form" method="get" action="{{ route('search') }}">
        <div class="form-group w-100 mb-3">
            <label for="search" class="d-block mr-2">Search..</label>
            <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="enter keyword">
        </div>
        <button type="submit" class="btn btn-primary mb-1">Search</button>
    </form>

    <div class="float-right" style="margin-bottom: 10px;">
        <a href="/user/add" class="btn btn-primary btn-md">
        <span class="fas fa-plus-circle" style="margin-right: 4px;"></span>
        Add User
        </a>
    </div>

    <style>
        td {
            word-wrap: break-word;
        }

        th {
            word-wrap: break-word;
        }
    </style>


    <div class="table-responsive-md">
        <table class="table table-bordered table-striped" style="table-layout: fixed;">
            <thead class="thead-dark">
            <tr>
                <th> User ID </th>
                <th> User's Name </th>
                <th> Email </th>
                <th> Password </th>
                <th> Birth Date </th>
                <th> Phone Number </th>
                <th> Photo </th>
                <th> Role   </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
                @foreach($user as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->user_full_name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->password }}</td>
                        <td>{{ $data->birthdate }}</td>
                        <td>{{ $data->phone_number }}</td>
                        <td><img src="{{ asset('user_images/' . $data->photo) }}" width="150px"></td>
                        <td>{{ $data->role }}</td>
                        <td>
                            <a href="/user/detail/{{ $data->id }}" class="btn btn-sm btn-success">Detail</a>
                            <a href="/user/edit/{{ $data->id }}" class="btn btn-sm btn-warning">Edit</a>
                            <a type="button" class="btn btn-sm btn-danger" data-toggle="modal" 
                            data-target="#del-confirm{{ $data->id }}">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <thead class="thead-dark">
                <tr>
                    <th> User ID </th>
                    <th> User's Name </th>
                    <th> Email </th>
                    <th> Password </th>
                    <th> Birth Date </th>
                    <th> Phone Number </th>
                    <th> Photo </th>
                    <th> Role   </th>
                    <th> Action </th>
                </tr>
            </thead>
        </table>
        {{ $user->links() }}
    </div>

    @foreach ($user as $data)
    <div class="modal fade" id="del-confirm{{ $data->id }}">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">User : {{ $data->user_full_name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this data?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                    <a href="/user/delete/{{ $data->id }}" type="button" class="btn btn-outline-light">Yes</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection