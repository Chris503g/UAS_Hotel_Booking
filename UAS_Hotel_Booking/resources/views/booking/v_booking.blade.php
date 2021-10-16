@extends('layouts.adminlte')
@section('title', 'Bookings')

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

    <div class="float-right" style="margin-bottom: 10px">
        <a href="/booking/printpdf" target="_blank" class="btn btn-primary">
            <span class="fas fa-plus-circle" style="margin-right: 4px;"></span> 
            Invoice
        </a>
        <a href="/booking/add" class="btn btn-primary btn-md">
            <span class="fas fa-plus-circle" style="margin-right: 4px;"></span>
            Add Booking
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
                <th> Booking ID </th>
                <th> User ID </th>
                <th> Hotel ID </th>
                <th> Room ID </th>
                <th> Room Quantity </th>
                <th> Date Check In </th>
                <th> Date Check Out </th>
                <th> Grand Total Price </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
                @foreach($booking as $data)
                    <tr>
                        <td>{{ $data->booking_id }}</td>
                        <td>{{ $data->user_id }}</td>
                        <td>{{ $data->hotel_id }}</td>
                        <td>{{ $data->room_id }}</td>
                        <td>{{ $data->room_qty }}</td>
                        <td>{{ $data->date_check_in }}</td>
                        <td>{{ $data->date_check_out }}</td>
                        <td>{{ $data->grand_total_price }}</td>
                        <td>
                            <a href="/booking/detail/{{ $data->booking_id }}" class="btn btn-sm btn-success">Detail</a>
                            <a href="/booking/edit/{{ $data->booking_id }}" class="btn btn-sm btn-warning">Edit</a>
                            <a type="button" class="btn btn-sm btn-danger" data-toggle="modal" 
                            data-target="#del-confirm{{ $data->booking_id }}">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <thead class="thead-dark">
                <tr>
                    <th> Booking ID </th>
                    <th> User ID </th>
                    <th> Hotel ID </th>
                    <th> Room ID </th>
                    <th> Room Quantity </th>
                    <th> Date Check In </th>
                    <th> Date Check Out </th>
                    <th> Grand Total Price </th>
                    <th> Action </th>
                </tr>
            </thead>
        </table>
        {{ $booking->links() }}
    </div>

    @foreach ($booking as $data)
    <div class="modal fade" id="del-confirm{{ $data->booking_id }}">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title"> Booking ID : {{ $data->booking_id }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this data?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                    <a href="/booking/delete/{{ $data->booking_id }}" type="button" class="btn btn-outline-light">Yes</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection