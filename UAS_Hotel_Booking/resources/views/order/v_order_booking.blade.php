<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Reservation</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{  asset('/assets/css/form.css') }}" />
</head>
<body>
    
    @if(session('alert'))
    <div class="alert alert-warning" role="alert">
        {{ session('alert') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <header>
		<div class="header-item logo">
			<a href="/">
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

				<img src="{{ asset('/assets/images/logo/logohotelog.png') }}" alt="logo hotelog">
			</a>
		</div>
		<div class="header-item navIcon">
			<img src="{{ asset('/assets/images/icons/menu.svg') }}" alt="open menu icon" onclick="openNav()">
		</div>

		<nav class="header-item nav">
			<ul>
                <!-- 
                    @if (!session()->has('LoggedUser'))
                    <li><a href="login" class="navButton login"><button>Log in</button></a></li>
                    <li><a href="register" class="navButton register"><button>Register</button></a></li>
                    @endif

                    @if (session()->has('LoggedUser'))
                    <li><a href="/logout" class="navButton log out"><button>Logout</button> </a></li> 
                    @endif

                    <li><a href="order" class="navButton bookings"><button>Bookings</button></a></li>
                -->
			</ul>
		</nav>
	</header>
        
        <div class="card">
            <div class="card-item card-img">
                <img class="hotel-img" src="{{ asset('/hotel_images/' . $hotel->picture) }}" alt="{{ $hotel->hotel_name }}">
            </div>

            <div class="card-item hotel-label">
                <h3 class="label-item hotel-name">{{ $hotel->hotel_name }}
                    <span class="star-value" style="display: none;">{{ $hotel->rating }}</span>
                    <span class="stars"></span>

                </h3>
                <span class="label-item hotel-location">{{ $hotel->city }}</span>
                <div class="label-item hotel-description">
                    <p>{{ $hotel->description }}</p>
                </div>
                <div class="label-item hotel-facilities">
                    <ul>
                        <?php 
                            $var = $hotel->facility;

                            $pieces = explode(" ",$var);
                            foreach($pieces as $element)
                            {
                                echo "<li>" . $element . "</li>";
                            }    
                        ?>
                    </ul>
                </div>
                <div class="label-item button-item">
                    @foreach($room as $roomData)
                        @if($roomData->hotel_id == $hotel->id)
                            <span class="hotel-price">{{ trim($roomData->price_per_day) }}</span>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>


	<div id="order" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="order-form">
						<div class="form-header">
							<h1>Hotel Reservation</h1>
						</div>
						<form action="/order-booking/submit{{ $hotel->id }}" method="post" enctype="multipart/form-data">
                            @csrf
							<!-- NAMA LENGKAP, NOMOR TELEPON, EMAIL, JUMLAH KAMAR, TANGGAL CHECK IN CHECK OUT, HARGA -->

							<div class="form-group">
								<input class="form-control" type="number" id="room-number" name="room_qty" placeholder="Room quantity"
                                class="form-control @error('room_qty') is-invalid @enderror"
                                value="{{ old('room_qty') }}">
								<span class="form-label">Rooms</span>
							</div>
                            <span class="invalid-feedback text-danger">
                                @error('room_qty'){{ $message }}@enderror
                            </span>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control @error('date_check_in') is-invalid @enderror" required
                                        value="{{ old('date_check_in') }}" type="date" id="check-in-date" name="date_check_in">
										<span class="form-label">Check In</span>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control @error('date_check_out') is-invalid @enderror" required
                                        value="{{ old('date_check_out') }}" type="date" id="check-out-date" name="date_check_out">
										<span class="form-label">Check out</span>
									</div>
								</div>
							</div>

							<div class="form-group total">
								<h2>TOTAL</h2>
								<h2 id="total-price"></h2>
							</div>
							<div class="form-btn">
								<button class="submit-btn">Book Now</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="{{ asset('assets/js/general.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script type="text/javascript">
		$('.form-control').each(function () {
			floatedLabel($(this));
		});

		$('.form-control').on('input', function () {
			floatedLabel($(this));
		});

		function floatedLabel(input) {
			var $field = input.closest('.form-group');
			if (input.val()) {
				$field.addClass('input-not-empty');
			} else {
				$field.removeClass('input-not-empty');
			}
		}

		const calculateTotalPrice = (value1, value2, value3) => {
			//const checkInDate = document.getElementById("check-in-date");
			//const checkOutDate = document.getElementById("check-out-date");
			const hotelPrice = document.querySelector(".hotel-price").textContent;

			//let hotelPriceText = hotelPrice[i].textContent;

			let hotelPriceTextStripped = hotelPrice.split(" ");
			hotelPriceTextStripped = hotelPriceTextStripped.splice(-1, 1).toString();

			hotelPriceTextStripped = hotelPriceTextStripped.split(".");
			hotelPriceTextStripped = hotelPriceTextStripped.join("").toString();
			hotelPriceTextStripped = hotelPriceTextStripped.split(",");
			hotelPriceTextStripped = hotelPriceTextStripped.splice(0, 1).toString();
			//console.log(hotelPriceTextStripped);
			let hotelPriceInteger = parseInt(hotelPriceTextStripped);

            if(value1 >= value2){
                document.getElementById("total-price").innerHTML = "...";
            }
			else if (value1 === undefined && value2 === undefined || value3  <= 0) {
                document.getElementById("total-price").innerHTML = "...";
            } else if (value1 !== undefined && value2 !== undefined && value3 !== undefined) {
                
                let nights = (new Date(value2) - new Date(value1)) / (1000 * 60 * 60 * 24);
                

                let totalPrice = (nights * hotelPriceInteger * value3).toString();
                let totalPriceFormatted;
                if (totalPrice === NaN || totalPrice === 0) {
                    document.getElementById("total-price").innerHTML = "...";
                } else if (totalPrice.length > 6) {
                    totalPriceFormatted = Array.from(totalPrice);
                    totalPriceFormatted = ["Rp", " ", ...totalPriceFormatted, ",00"];

                    totalPriceFormatted.splice(-4, 0, ".");
                    totalPriceFormatted.splice(-8, 0, ".");
                    console.log(totalPriceFormatted);
                    totalPriceFormatted = totalPriceFormatted.join("");
                } else {
                    totalPriceFormatted = Array.from(totalPrice);
                    totalPriceFormatted = ["Rp", " ", ...totalPriceFormatted, ",00"];
                    totalPriceFormatted.splice(-4, 0, ".");
                    totalPriceFormatted = totalPriceFormatted.join("");
                }
                

                if (totalPrice === 0 || totalPrice === NaN) {
                    document.getElementById("total-price").innerHTML = "...";
                } else {
                    document.getElementById("total-price").innerHTML = totalPriceFormatted;
                }
			}
		};

        let quantity;
        let checkInDate;
        let checkOutDate;
        document.getElementById("room-number").addEventListener("input", (eventRoomNum) => {
            quantity = eventRoomNum.target.value;
            calculateTotalPrice(checkInDate, checkOutDate, quantity);
        });

        document.getElementById("check-in-date").addEventListener("change", (eventCheckIn) => {
            checkInDate = eventCheckIn.target.value;
            calculateTotalPrice(checkInDate, checkOutDate, quantity);
        });
        document.getElementById("check-out-date").addEventListener("change", (eventCheckOut) => {
            checkOutDate = eventCheckOut.target.value;
            calculateTotalPrice(checkInDate, checkOutDate, quantity);

        });

		window.onloadeddata = calculateTotalPrice();

	</script>

</body>
</html>