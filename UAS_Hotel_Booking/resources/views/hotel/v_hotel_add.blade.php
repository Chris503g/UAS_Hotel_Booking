@extends('layouts.adminlte')
@section('title', 'Add Hotel')

@section('content')
<form action="/hotel/add/submit" method="post" enctype="multipart/form-data">
    
    @csrf
    {{-- @crsf is equivalent to --}}
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}

    <div class="col-6">
        

    <div class="form-group">
        <label for="hotel_name"> Hotel Name : </label>
        <input type="text" name="hotel_name" 
        class="form-control @error('hotel_name') is-invalid @enderror"
        value="{{ old('hotel_name') }}">
        <div class="invalid-feedback">
        @error('hotel_name'){{ $message }}@enderror
        </div>
    </div>


    <div class="form-group">
        <label for="rating"> Rating : </label>
        <input type="text" name="rating" 
        class="form-control @error('rating') is-invalid @enderror"
        value="{{ old('rating') }}">
        <div class="invalid-feedback">
        @error('rating'){{ $message }}@enderror
        </div>
    </div>


    <div class="form-group">
        <label for="facility"> Facility : </label>
        <input type="text" name="facility" 
        class="form-control @error('facility') is-invalid @enderror"
        value="{{ old('facility') }}">
        <div class="invalid-feedback">
        @error('facility'){{ $message }}@enderror
        </div>
    </div>


    <div class="form-group">
        <label for="description">Hotel Description: </label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
        rows="4" cols="50"
        maxlength="255">{{ old('description') }}</textarea>
        <div class="invalid-feedback">
          @error('description'){{ $message }}@enderror
        </div>
    </div>
    

    <div class="radio-btn">
        <p>Select Hotel City:</p>
            <input type="radio" name="city" value="Jakarta"
            @if (old('city') === "Jakarta") 
                checked
            @endif required/>
            <label for="city">Jakarta</label><br>
            <input type="radio" name="city" value="Bogor"
            @if (old('city') === "Bogor") 
                checked
            @endif required/>
            <label for="city">Bogor</label><br>
            
            <input type="radio" name="city" value="Bekasi"
            @if (old('city') === "Bekasi") 
                checked
            @endif required/>
            <label for="city">Bekasi</label><br>

            <input type="radio" name="city" value="Tangerang"
            @if (old('city') === "Tangerang") 
                checked
            @endif required/>
            <label for="city">Tangerang</label><br>

            <input type="radio" name="city" value="Bandung"
            @if (old('city') === "Bandung") 
                checked
            @endif required/>
            <label for="city">Bandung</label><br>

            <input type="radio" name="city" value="Jogjakarta"
            @if (old('city') === "Jogjakarta") 
                checked
            @endif required/>
            <label for="city">Jogjakarta</label><br>

            <input type="radio" name="city" value="Surabaya"
            @if (old('city') === "Surabaya") 
                checked
            @endif required/>
            <label for="city">Surabaya</label><br>

            <input type="radio" name="city" value="Medan"
            @if (old('city') === "Medan") 
                checked
            @endif required/>
            <label for="city">Medan</label><br>

            <input type="radio" name="city" value="Semarang"
            @if (old('city') === "Semarang") 
                checked
            @endif required/>
            <label for="city">Semarang</label><br>

            <input type="radio" name="city" value="Bali"
            @if (old('city') === "Bali") 
                checked
            @endif required/>
            <label for="city">Bali</label><br>
    </div>
    <div class="text-danger">
        @error('city'){{ $message }}@enderror
    </div>

    <div class="form-group">
        <label for="picture">Hotel Picture: </label>
        <input type="file" name="picture" 
        class="form-control-file @error('picture') is-invalid @enderror">
        <div class="invalid-feedback">
            @error('picture'){{ $message }}@enderror
        </div>
      </div>

    <div class="form-group">
        <button class="btn btn-primary btn-md" type="submit">Submit</button>
        <a href="/hotel" class="btn btn-primary btn-md">Back</a>
    </div>

    </div>
</form>
@endsection