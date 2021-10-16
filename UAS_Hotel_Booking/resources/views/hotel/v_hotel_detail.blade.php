@extends('layouts.adminlte')
@section('title', 'Hotel Details')
@section('content')

<table class="table">
    <tr>
        <th width="150px"> Hotel ID </th>
        <th width="30px">:</th>
        <th>{{ $hotel->id }}</th>
    </tr>
    <tr>
        <th width="150px"> Hotel Name </th>
        <th width="30px">:</th>
        <th>{{ $hotel->hotel_name }}</th>
    </tr>
    <tr>
        <th width="150px"> Rating </th>
        <th width="30px">:</th>
        <th>{{ $hotel->rating}}</th>
    </tr>
    <tr>
        <th width="150px">City </th>
        <th width="30px">:</th>
        <th>{{ $hotel->city }}</th>
    </tr>
    <tr>
        <th width="150px"> Picture </th>
        <th width="30px">:</th>
        <th><img src="{{ asset('hotel_images/' . $hotel->picture) }}" width="400px"></th>
    </tr>

    <tr>
        <th colspan="3"><a href="/hotel" class="btn btn-success btn-sm">Back</a></th>
    </tr>
</table>

@endsection