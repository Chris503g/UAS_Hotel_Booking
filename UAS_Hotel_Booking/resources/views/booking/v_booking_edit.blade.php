@extends('layouts.adminlte')
@section('title', 'Edit Booking')

@section('content')
<form action="/booking/edit/submit{{ $booking->booking_id }}" method="post" enctype="multipart/form-data">
    
    @csrf
    {{-- @crsf is equivalent to --}}
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

    <div class="col-6">


        <div class="form-group">
            <label for="booking_id"> Booking ID : </label>
            <input type="text" name="booking_id" 
            class="form-control @error('booking_id') is-invalid @enderror"
            value="{{ $booking->booking_id }}">
            <div class="invalid-feedback">
            @error('booking_id'){{ $message }}@enderror
            </div>
        </div>

        <div class="form-group">
            <label for="hotel_id"> Hotel ID : </label>
            <input type="text" name="hotel_id" 
            class="form-control @error('hotel_id') is-invalid @enderror"
            value="{{ $booking->hotel_id }}">
            <div class="invalid-feedback">
            @error('hotel_id'){{ $message }}@enderror
            </div>
        </div>


        <div class="form-group">
            <label for="user_id"> User ID : </label>
            <input type="text" name="user_id" 
            class="form-control @error('user_id') is-invalid @enderror"
            value="{{ $booking->user_id }}">
            <div class="invalid-feedback">
            @error('user_id'){{ $message }}@enderror
            </div>
        </div>
    
    
        <div class="form-group">
            <label for="room_id"> Room ID : </label>
            <input type="text" name="room_id" 
            class="form-control @error('room_id') is-invalid @enderror"
            value="{{ $booking->room_id }}">
            <div class="invalid-feedback">
            @error('room_id'){{ $message }}@enderror
            </div>
        </div>
        
    
        <div class="form-group">
            <label for="room_qty"> Room Quantity : </label>
            <input type="text" name="room_qty" 
            class="form-control @error('room_qty') is-invalid @enderror"
            value="{{ $booking->room_qty }}">
            <div class="invalid-feedback">
            @error('room_qty'){{ $message }}@enderror
            </div>
        </div>
    
        
        <div class="form-group">
            <label for="date_check_in"> Date Check In: </label>
            <input type="date" name="date_check_in" 
            class="form-control @error('date_check_in') is-invalid @enderror"
            value="{{ $booking->date_check_in }}">
            <div class="invalid-feedback">
            @error('date_check_in'){{ $message }}@enderror
            </div>
        </div>
    
    
        <div class="form-group">
            <label for="date_check_out"> Date Check Out: </label>
            <input type="date" name="date_check_out" 
            class="form-control @error('date_check_out') is-invalid @enderror"
            value="{{ $booking->date_check_out }}">
            <div class="invalid-feedback">
            @error('date_check_out'){{ $message }}@enderror
            </div>
        </div>
    

    <div class="form-group">
        <button class="btn btn-primary btn-md" type="submit">Submit</button>
        <a href="/booking" class="btn btn-primary btn-md">Back</a>
    </div>

    </div>
</form>
@endsection