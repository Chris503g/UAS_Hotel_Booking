
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Invoice Booking Hotel</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('template')}}/plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('template')}}/dist/css/adminlte.min.css">
</head>
<body>
    <br><br>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-globe"></i> Invoice
                <small class="float-right"><strong> Date: </strong> {{ date('d-D-M-Y') }}</small>
            </div>
            
            @foreach($hotel as $hotelData)
                @if($hotelData->id == $booking->hotel_id)
                    @foreach($user as $userData)
                        @if($userData->id == $booking->user_id)
            
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <h6 class="mb-3">From : </h6>
                                    <div>
                                        <strong> HotelLog.com </strong>
                                    </div>
                                </div>
                                                    
                                <div class="col-sm-6">
                                    <h6 class="mb-3"> To : </h6>
                                    <div>
                                        <strong> {{ $userData->user_full_name }} </strong>
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                </div>

                            </div>

                            @if(session()->has('LoggedUser'))
                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="center">User's Name</th>
                                            <th class="center">Phone Number</th>
                                            <th class="center">Email</th>
                                            <th class="center">Hotel Name</th>
                                            <th class="center">Room Quantity</th>
                                            <th class="center">Date Check In</th>
                                            <th class="center">Date Check Out</th>
                                            <th class="center">Grand Total Pice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $userData->user_full_name }}</td>
                                            <td>{{ $userData->phone_number }}</td>
                                            <td>{{ $userData->email }}</td>
                                            <td>{{ $hotelData->hotel_name }}</td>
                                            <td>{{ $booking->room_qty }}</td>
                                            <td>{{ $booking->date_check_in }}</td>
                                            <td>{{ $booking->date_check_out }}</td>
                                            <td>Rp. {{ $booking->grand_total_price }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                            @if(!session()->has('LoggedUser'))
                                <h1> Please Log in to see your booking </h1>
                            @endif
                            <br><br>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
            
    <script>
    window.addEventListener("load", window.print());
    </script>

</body>
</html>
