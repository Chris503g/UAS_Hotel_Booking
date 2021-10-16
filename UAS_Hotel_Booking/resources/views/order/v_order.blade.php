<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Booking</title>
	<link type="text/css" rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('/assets/css/form.css') }}" />
</head>
<body>

	<!-- alert if needed
	@if (session('success'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-check"></i> Success!!!</h4>
		{{ session('success') }}
	</div>
	@endif
-->

	<header>
		<div class="header-item logo">
			<a href="v_home.html">
				<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#ffffff" viewBox="0 0 256 256">
					<rect width="256" height="256" fill="none"></rect>
					<circle cx="128" cy="128" r="96" fill="none" stroke="#ffffff" stroke-miterlimit="10"
						stroke-width="16">
					</circle>
					<polyline points="121.941 161.941 88 128 121.941 94.059" fill="none" stroke="#ffffff"
						stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline>
					<line x1="88" y1="128" x2="168" y2="128" fill="none" stroke="#ffffff" stroke-linecap="round"
						stroke-linejoin="round" stroke-width="16"></line>
				</svg>
			</a>
			<a href="/">
				<img src="{{ asset('assets/images/logo/logohotelog.png') }}" alt="logo hotelog">
			</a>
		</div>
		<div class="header-item navIcon">
			<img src="{{ asset('/assets/images/icons/menu.svg') }}" alt="open menu icon" onclick="openNav()">
		</div>

		<nav class="header-item nav">
			<ul>
				@if (!session()->has('LoggedUser'))
				<li><a href="login" class="navButton login"><button>Log in</button></a></li>
				<li><a href="register" class="navButton register"><button>Register</button></a></li>
				@endif

				@if (session()->has('LoggedUser'))
				<li><a href="/logout" class="navButton log out"><button>Logout</button> </a></li> 
				@endif

				<li><a href="order" class="navButton bookings"><button>Reservations</button></a></li>
			</ul>
		</nav>
	</header>

	<div class="reservation-header">
        <h1>Your reservations</h1>
    </div>
	@foreach($booking as $data)

		@if($data->user_id == session('LoggedUser'))

			@foreach($hotel as $hotelData)

				@if($hotelData->id == $data->hotel_id)

					<div class="card">
						<div class="card-item card-img">
							<img class="hotel-img" src="{{ asset('/hotel_images/' . $hotelData->picture) }}" alt="{{ $hotelData->hotel_name }}">
						</div>		
						<div class="card-item hotel-label">
							<h3 class="label-item hotel-name">{{ $hotelData->hotel_name }}
								<span class="star-value" style="display: none;">{{ $hotelData->rating }}</span>
								<span class="stars"></span>

							</h3>
							<span class="label-item hotel-location">{{ $hotelData->city }}</span>
							<div class="label-item hotel-description reservation">
								<ul>
									<li>Check-in date: {{ $data->date_check_in }}</li>
									<li>Check-out date: {{ $data->date_check_out }}</li>
								</ul>
							</div>
							<div class="label-item hotel-facilities">
								<p>TOTAL </p>
								<span class="hotel-price">{{ $data->grand_total_price }}</span>
							</div>
							<div class="label-item button-item">
								<a href="/order/printpdf/{{ $data->booking_id }}" target="_blank"><button class="book-btn-style">details</button></a>
							</div>
						</div>
					</div>

				@endif

			@endforeach

		@endif

	@endforeach

	@if(!session()->has('LoggedUser'))
		<h1> Please Log in to see your booking </h1>
	@endif
    <script src="{{ asset('/assets/js/general.js') }}"></script>

</body>
</html>