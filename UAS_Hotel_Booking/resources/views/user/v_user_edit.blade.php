@extends('layouts.adminlte')
@section('title', 'Edit User')

@section('content')
<form action="/user/edit/submit{{ $user->id }}" method="post" enctype="multipart/form-data">
    
    @csrf
    {{-- @crsf is equivalent to --}}
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

    <div class="col-6">

    <div class="form-group">
        <label for="user_full_name"> User's Name: </label>
        <input type="text" name="user_full_name"
        class="form-control @error('user_full_name') is-invalid @enderror"
        value="{{ $user->user_full_name }}">
        <div class="invalid-feedback">
        @error('user_full_name'){{ $message }}@enderror
        </div>
    </div>


    <div class="form-group">
        <label for="email"> Email : </label>
        <input type="text" name="email" 
        class="form-control @error('email') is-invalid @enderror"
        value="{{ $user->email }}">
        <div class="invalid-feedback">
        @error('email'){{ $message }}@enderror
        </div>
    </div>

    
    <div class="form-group">
        <label for="birthdate">Birth Date: </label>
        <input type="date" name="birthdate" 
        class="form-control @error('birthdate') is-invalid @enderror"
        value="{{ $user->birthdate }}">
        <div class="invalid-feedback">
        @error('birthdate'){{ $message }}@enderror
        </div>
    </div>


    <div class="form-group">
        <label for="phone_number"> Phone Number : </label>
        <input type="text" name="phone_number" 
        class="form-control @error('phone_number') is-invalid @enderror"
        value="{{ $user->phone_number }}">
        <div class="invalid-feedback">
        @error('phone_number'){{ $message }}@enderror
        </div>
    </div>


    <img src="{{ asset('/user_images/' . $user->photo) }}" width="150px">

    <div class="form-group">
      <label for="photo">Change User Photo: </label>
      <input type="file" name="photo" 
      class="form-control-file @error('photo') is-invalid @enderror">
      <div class="invalid-feedback">
        @error('photo'){{ $message }}@enderror
    </div>
    </div>



    <div class="form-group">
        <label for="role"> User Role : </label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="option_user" 
            value="user" 
            @if ($user->role === "user") 
                checked
            @endif>
            <label class="form-check-label" for="option_user">
            User
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="option_admin" 
            value="admin" 
            @if ($user->role === "admin") 
                checked
            @endif>
            <label class="form-check-label" for="option_admin">
            Admin
            </label>
        </div>
        <div class="text-danger" style="font-size: 13px">
            @error('role'){{ $message }}@enderror
        </div>
    </div>   
    

    <div class="form-group">
        <button class="btn btn-primary btn-md" type="submit">Submit</button>
        <a href="/user" class="btn btn-primary btn-md">Back</a>
    </div>

    </div>
</form>
@endsection