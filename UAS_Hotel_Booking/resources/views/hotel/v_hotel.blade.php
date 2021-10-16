@extends('layouts.adminlte')
@section('title', 'Hotels')

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

    <div class="float-right" style="margin-bottom: 10px;">
        <a href="/hotel/add" class="btn btn-primary btn-md">
        <span class="fas fa-plus-circle" style="margin-right: 4px;"></span>
        Add Hotel
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
                <th> Hote ID </th>
                <th> Hotel Name </th>
                <th> Rating </th>
                <th> Facility </th>
                <th> Description </th>
                <th> City </th>
                <th> Picture </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
                @foreach($hotel as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->hotel_name }}</td>
                        <td>{{ $data->rating }}</td>
                        <td>{{ $data->facility }}</td>
                        <td>{{ $data->description }}</td>
                        <td>{{ $data->city }}</td>
                        <td><img src="{{ asset('hotel_images/' . $data->picture) }}" width="150px"></td>
                        <td>
                            <a href="/hotel/detail/{{ $data->id }}" class="btn btn-sm btn-success">Detail</a>
                            <a href="/hotel/edit/{{ $data->id }}" class="btn btn-sm btn-warning">Edit</a>
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
                    <th> Hote ID </th>
                    <th> Hotel Name </th>
                    <th> Rating </th>
                    <th> Facility </th>
                    <th> Description </th>
                    <th> City </th>
                    <th> Picture </th>
                    <th> Action </th>
                </tr>
            </thead>
        </table>
        {{ $hotel->links() }}
    </div>

    @foreach ($hotel as $data)
    <div class="modal fade" id="del-confirm{{ $data->id }}">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $data->hotel_name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this data?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                    <a href="/hotel/delete/{{ $data->id }}" type="button" class="btn btn-outline-light">Yes</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection