@extends('layouts.adminlte')
@section('title', 'Room Details')
@section('content')

<table class="table">
    <tr>
        <th width="150px">Room ID </th>
        <th width="30px">:</th>
        <th>{{ $room->room_id }}</th>
    </tr>
    <tr>
        <th width="150px" >Hotel ID </th>
        <th width="30px">:</th>
        <th>{{ $room->hotel_id }}</th>
    </tr>
    <tr>
        <th width="150px">Price Per Day </th>
        <th width="30px">:</th>
        <th>{{ $room->price_per_day }}</th>
    </tr>
    <tr>
        <th width="150px"> Available Room Quantity </th>
        <th width="30px">:</th>
        <th>{{ $room->available_room_qty }}</th>
    </tr>

    <tr>
        <th colspan="3"><a href="/room" class="btn btn-success btn-sm">Back</a></th>
    </tr>
</table>

@endsection