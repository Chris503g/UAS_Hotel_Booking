@extends('layouts.adminlte')
@section('title', 'Add Booking')

@section('content')
<form action="/booking/add/submit" method="post" enctype="multipart/form-data">
    
    @csrf
    {{-- @crsf is equivalent to --}}
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

    <div class="col-6">

        <div class="form-group">
            <label for="user_id">User ID: </label>
    
            @foreach ($user as $data)
            @if ($data->role == "user")
                <div class="form-check">
                <input class="form-check-input" type="radio" name="user_id"
                value="{{ $data->id }}" 
                @if (old('user_id') === $data->id) 
                    checked
                @endif>
                <label class="form-check-label" for="user_{{ $data->id }}"">
                    {{ $data->id }} - {{ $data->user_full_name }}
                </label>
                </div>
            @endif
            @endforeach
            
            <div class="text-danger" style="font-size: 13px">
            @error('user_id'){{ $message }}@enderror
            </div>
        </div> 


        <div class="form-group">
            <label for="hotel_id"> Hotel ID: </label>
            
            @foreach ($hotel as $data)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="hotel_id" 
                value="{{ $data->id }}" 
                @if (old('hotel_id') === $data->id) 
                    checked
                @endif>
                <label class="form-check-label" for="hotel_{{ $data->id }}">
                {{ $data->id }} -  {{ $data->hotel_name }}
                </label>
            </div>
            @endforeach
    
            <div class="text-danger" style="font-size: 13px">
            @error('hotel_id'){{ $message }}@enderror
            </div>
        </div>   
    
    
        <div class="form-group">
            <label for="room_id"> Room ID: </label>
            
            @foreach ($room as $data)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="room_id" 
                value="{{ $data->room_id }}" 
                @if (old('room_id') === $data->room_id) 
                    checked
                @endif>
                <label class="form-check-label" for="room_{{ $data->room_id }}">
                {{ $data->room_id }}
                </label>
            </div>
            @endforeach
    
            <div class="text-danger" style="font-size: 13px">
            @error('room_id'){{ $message }}@enderror
            </div>
        </div>   
        
    
        <div class="form-group">
            <label for="room_qty"> Room Quantity : </label>
            <input type="text" name="room_qty" 
            class="form-control @error('room_qty') is-invalid @enderror"
            value="{{ old('room_qty') }}">
            <div class="invalid-feedback text-danger">
            @error('room_qty'){{ $message }}@enderror
            </div>
        </div>
    
        
        <div class="form-group">
            <label for="date_check_in"> Date Check In: </label>
            <input type="date" name="date_check_in" 
            class="form-control @error('date_check_in') is-invalid @enderror"
            value="{{ old('date_check_in') }}">
            <div class="invalid-feedback">
            @error('date_check_in'){{ $message }}@enderror
            </div>
        </div>
    
    
        <div class="form-group">
            <label for="date_check_out"> Date Check Out: </label>
            <input type="date" name="date_check_out" 
            class="form-control @error('date_check_out') is-invalid @enderror"
            value="{{ old('date_check_out') }}">
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