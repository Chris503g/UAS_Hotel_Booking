@extends('layouts.adminlte')
@section('title', 'Edit Hotel')

@section('content')
<form action="/hotel/edit/submit{{ $hotel->id }}" method="post" enctype="multipart/form-data">
    
    @csrf
    {{-- @crsf is equivalent to --}}
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

    <div class="col-6">
      

    <div class="form-group">
        <label for="id"> Hotel ID : </label>
        <input type="text" name="id" 
        class="form-control @error('id') is-invalid @enderror"
        value="{{ $hotel->id }}">
        <div class="invalid-feedback">
        @error('id'){{ $message }}@enderror
        </div>
    </div>

    <div class="form-group">
        <label for="hotel_name"> Hotel Name : </label>
        <input type="text" name="hotel_name" 
        class="form-control @error('hotel_name') is-invalid @enderror"
        value="{{ $hotel->hotel_name }}">
        <div class="invalid-feedback">
        @error('hotel_name'){{ $message }}@enderror
        </div>
    </div>


    <div class="form-group">
        <label for="rating"> Rating : </label>
        <input type="text" name="rating" 
        class="form-control @error('rating') is-invalid @enderror"
        value="{{ $hotel->rating }}">
        <div class="invalid-feedback">
        @error('rating'){{ $message }}@enderror
        </div>
    </div>
    

    <div class="form-group">
        <label for="facility"> Facility : </label>
        <input type="text" name="facility" 
        class="form-control @error('facility') is-invalid @enderror"
        value="{{$hotel->facility }}">
        <div class="invalid-feedback">
        @error('facility'){{ $message }}@enderror
        </div>
    </div>


    <div class="form-group">
        <label for="description">Hotel Description: </label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
        rows="4" cols="50"
        maxlength="255">{{ $hotel->description }}</textarea>
        <div class="invalid-feedback">
          @error('description'){{ $message }}@enderror
        </div>
    </div>


    <div class="radio-btn">
        <p>Select Hotel City:</p>
            <input type="radio" name="city" value="Jakarta"
            @if ($hotel->city === "Jakarta") 
                checked
            @endif required/>
            <label for="city">Jakarta</label><br>
            <input type="radio" name="city" value="Bogor"
            @if ($hotel->city === "Bogor") 
                checked
            @endif required/>
            <label for="city">Bogor</label><br>
            
            <input type="radio" name="city" value="Bekasi"
            @if ($hotel->city === "Bekasi") 
                checked
            @endif required/>
            <label for="city">Bekasi</label><br>

            <input type="radio" name="city" value="Tangerang"
            @if ($hotel->city === "Tangerang") 
                checked
            @endif required/>
            <label for="city">Tangerang</label><br>

            <input type="radio" name="city" value="Bandung"
            @if ($hotel->city === "Bandung") 
                checked
            @endif required/>
            <label for="city">Bandung</label><br>

            <input type="radio" name="city" value="Jogjakarta"
            @if ($hotel->city === "Jogjakarta") 
                checked
            @endif required/>
            <label for="city">Jogjakarta</label><br>

            <input type="radio" name="city" value="Surabaya"
            @if ($hotel->city === "Surabaya") 
                checked
            @endif required/>
            <label for="city">Surabaya</label><br>

            <input type="radio" name="city" value="Medan"
            @if ($hotel->city === "Medan") 
                checked
            @endif required/>
            <label for="city">Medan</label><br>

            <input type="radio" name="city" value="Semarang"
            @if ($hotel->city === "Semarang") 
                checked
            @endif required/>
            <label for="city">Semarang</label><br>

            <input type="radio" name="city" value="Bali"
            @if ($hotel->city === "Bali") 
                checked
            @endif required/>
            <label for="city">Bali</label><br>
    </div>
    <div class="text-danger">
        @error('city'){{ $message }}@enderror
    </div>

    <div class="form-group">
        <label for="picture">Change Hotel Picture: </label>
        
        <div class="row mb-2">
            <img src="{{ asset('hotel_images/' . $hotel->picture) }}" width="150px">
        </div>
        <div class="row">
          <input type="file" name="picture" 
          class="form-control-file @error('picture') is-invalid @enderror">
          <div class="invalid-feedback">
            @error('picture'){{ $message }}@enderror
          </div>
        </div>            
      </div>


    <div class="form-group">
        <button class="btn btn-primary btn-md" type="submit">Submit</button>
        <a href="/hotel" class="btn btn-primary btn-md">Back</a>
    </div>

    </div>
</form>
@endsection