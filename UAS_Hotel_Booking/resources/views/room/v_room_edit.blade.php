@extends('layouts.adminlte')
@section('title', 'Edit Room')

@section('content')
<form action="/room/edit/submit{{ $room->room_id }}" method="post" enctype="multipart/form-data">
    
    @csrf
    {{-- @crsf is equivalent to --}}
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

    <div class="col-6">
        

        <div class="form-group">
            <label for="hotel_id"> Hotel ID : </label>
            <input type="text" name="hotel_id" 
            class="form-control @error('hotel_id') is-invalid @enderror"
            value="{{ $room->hotel_id }}">
            <div class="invalid-feedback">
            @error('hotel_id'){{ $message }}@enderror
            </div>
        </div>
        

        <div class="form-group">
            <label for="price_per_day"> Price Per Day : </label>
            <input type="text" name="price_per_day" 
            class="form-control @error('price_per_day') is-invalid @enderror"
            value="{{ $room->price_per_day }}">
            <div class="invalid-feedback">
            @error('price_per_day'){{ $message }}@enderror
            </div>
        </div>


        <div class="form-group">
            <label for="available_room_qty"> Avaliable Room Quantity : </label>
            <input type="text" name="available_room_qty" 
            class="form-control @error('available_room_qty') is-invalid @enderror"
            value="{{ $room->available_room_qty }}">
            <div class="invalid-feedback">
            @error('available_room_qty'){{ $message }}@enderror
            </div>
        </div>


        <div class="form-group">
            <button class="btn btn-primary btn-md" type="submit">Submit</button>
            <a href="/room" class="btn btn-primary btn-md">Back</a>
        </div>

    </div>
</form>
@endsection