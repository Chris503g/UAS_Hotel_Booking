
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
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                    <i class="fas fa-globe"></i> Invoice
                    <small class="float-right">Date: {{ date('d-D-M-Y') }}</small>
                    </h2>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th> Booking ID </th>
                            <th> User ID </th>
                            <th> Hotel ID </th>
                            <th> Room ID </th>
                            <th> Room Quantity </th>
                            <th> Date Check In </th>
                            <th> Date Check Out </th>
                            <th> Grand Total Price </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($booking as $data)
                                <tr>
                                    <td>{{ $data->booking_id }}</td>
                                    <td>{{ $data->hotel_id }}</td>
                                    <td>{{ $data->user_id }}</td>
                                    <td>{{ $data->room_id }}</td>
                                    <td>{{ $data->room_qty }}</td>
                                    <td>{{ $data->date_check_in }}</td>
                                    <td>{{ $data->date_check_out }}</td>
                                    <td>{{ $data->grand_total_price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <thead>
                            <tr>
                                <th> Booking ID </th>
                                <th> User ID </th>
                                <th> Hotel ID </th>
                                <th> Room ID </th>
                                <th> Room Quantity </th>
                                <th> Date Check In </th>
                                <th> Date Check Out </th>
                                <th> Grand Total Price </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <script>
    window.addEventListener("load", window.print());
    </script>
</body>
</html>
