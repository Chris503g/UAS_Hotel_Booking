@extends('layouts.adminlte')
@section('title', 'Rooms')

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

    <form class="form" method="get" action="{{ route('searchRoom') }}">
        <div class="form-group w-100 mb-3">
            <label for="searchRoom" class="d-block mr-2">Search..</label>
            <input type="text" name="searchRoom" class="form-control w-75 d-inline" id="searchRoom" placeholder="enter room id">
            <button type="submit" class="btn btn-primary mb-1">Search</button>
        </div>
    </form>

    <div class="float-right" style="margin-bottom: 10px;">
        <a href="/room/add" class="btn btn-primary btn-md">
        <span class="fas fa-plus-circle" style="margin-right: 4px;"></span>
        Add Room
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
                <th> Room ID </th>
                <th> Hotel ID </th>
                <th> Price Per Day </th>
                <th> Available Room Quantity </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
                @foreach($room as $data)
                    <tr>
                        <td>{{ $data->room_id }}</td>
                        <td>{{ $data->hotel_id }}</td>
                        <td>{{ $data->price_per_day }}</td>
                        <td>{{ $data->available_room_qty }}</td>
                        <td>
                            <a href="/room/detail/{{ $data->room_id }}" class="btn btn-sm btn-success">Detail</a>
                            <a href="/room/edit/{{ $data->room_id }}" class="btn btn-sm btn-warning">Edit</a>
                            <a type="button" class="btn btn-sm btn-danger" data-toggle="modal" 
                            data-target="#del-confirm{{ $data->room_id }}">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <thead class="thead-dark">
                <tr>
                    <th> Room ID </th>
                    <th> Hotel ID </th>
                    <th> Price Per Day </th>
                    <th> Available Room Quantity </th>
                    <th> Action </th>
                </tr>
            </thead>
        </table>
        {{ $room->links() }}
    </div>

    @foreach ($room as $data)
    <div class="modal fade" id="del-confirm{{ $data->room_id }}">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">ID : {{ $data->room_id }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this data?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                    <a href="/room/delete/{{ $data->room_id }}" type="button" class="btn btn-outline-light">Yes</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection