@extends('layouts.adminlte')
@section('title', 'User Details')
@section('content')

<table class="table">
    <tr>
        <th width="150px"> User ID </th>
        <th width="30px">:</th>
        <th>{{ $user->id }}</th>
    </tr>
    <tr>
        <th width="150px"> User's Name </th>
        <th width="30px">:</th>
        <th>{{ $user->user_full_name }}</th>
    </tr>
    <tr>
        <th width="150px"> Email </th>
        <th width="30px">:</th>
        <th>{{ $user->email }}</th>
    </tr>
    <tr>
        <th width="150px"> Password </th>
        <th width="30px">:</th>
        <th>{{ $user->password }}</th>
    </tr>
    <tr>
        <th width="150px"> Birth Date </th>
        <th width="30px">:</th>
        <th>{{ $user->birthdate }}</th>
    </tr>
    <tr>
        <th width="150px"> Phone Number </th>
        <th width="30px">:</th>
        <th>{{ $user->phone_number }}</th>
    </tr>
    <tr>
        <th width="150px"> Photo </th>
        <th width="30px">:</th>
        <th><img src="{{ asset('user_images/' . $user->photo) }}" width="400px"></th>
    </tr>
    <tr>
        <th width="150px"> Role </th>
        <th width="30px">:</th>
        <th>{{ $user->role }}</th>
    </tr>

    <tr>
        <th colspan="3"><a href="/user" class="btn btn-success btn-sm">Back</a></th>
    </tr>
</table>

@endsection