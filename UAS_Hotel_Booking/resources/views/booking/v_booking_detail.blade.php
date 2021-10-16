@extends('layouts.adminlte')
@section('title', 'Booking Details')
@section('content')

<table class="table">
    <tr>
        <th width="150px"> Booking ID </th>
        <th width="30px">:</th>
        <th>{{ $booking->booking_id }}</th>
    </tr>
    <tr>
        <th width="150px"> User ID </th>
        <th width="30px">:</th>
        <th>{{ $booking->user_id }}</th>
    </tr>
    <tr>
        <th width="150px"> Room ID </th>
        <th width="30px">:</th>
        <th>{{ $booking->room_id }}</th>
    </tr>
    <tr>
        <th width="150px"> Room Quantity </th>
        <th width="30px">:</th>
        <th>{{ $booking->room_qty }}</th>
    </tr>
    <tr>
        <th width="150px"> Date Check In </th>
        <th width="30px">:</th>
        <th>{{ $booking->date_check_in }}</th>
    </tr>
    <tr>
        <th width="150px"> Date Check Out </th>
        <th width="30px">:</th>
        <th>{{ $booking->date_check_out }}</th>
    </tr>
    <tr>
        <th width="150px"> Grand Total Price </th>
        <th width="30px">:</th>
        <th>{{ $booking->grand_total_price }}</th>
    </tr>

    <tr>
        <th colspan="3"><a href="/booking" class="btn btn-success btn-sm">Back</a></th>
    </tr>
</table>

@endsection