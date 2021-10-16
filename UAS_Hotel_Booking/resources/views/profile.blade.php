<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ ('/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ ('/assets/css/form.css') }}">
</head>
<body>
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
    <!-- HARUS ADA NAMA, EMAIL, NOMOR TELEPON, FOTO, Tnggal lahir SAMA TOMBOL KE HALAMAN EDIT   -->
    <main class="container">
        <div class="row">
            <div class="profile-container">
                <div class="profile-item profile-picture">
                    <img src="{{ asset('user_images/' . $LoggedUserInfo->photo) }}" alt="" width="300px" height="auto">
                </div>
                <div class="profile-item name">
                    <span>Name</span>
                    <p>
                        {{ $LoggedUserInfo->user_full_name }}
                    </p>
                </div>
                <div class="profile-item profile-email">
                    <span>Email</span>
                    <p>
                        {{ $LoggedUserInfo->email }}
                    </p>
                </div>
                <div class="profile-item icon icon-email">
                    <img src="./assets/images/icons/envelope-simple.svg" alt="email-icon">
                </div>

                <div class="profile-item profile-phone_num">
                    <span>Phone Number</span>
                    <p>{{ $LoggedUserInfo->phone_number }}</p>
                </div>
                <div class="profile-item icon icon-phone">
                    <img src="./assets/images/icons/phone.svg" alt="phone-icon">
                </div>

                <div class="profile-item profile-birth_date">
                    <span>Birth Date</span>
                    <p>{{ $LoggedUserInfo->birthdate }}</p>
                </div>
                <div class="profile-item icon icon-calender">
                    <img src="./assets/images/icons/calendar.svg" alt="calendar-icon">
                </div>
                
                <div class="profile-edit_btn">
                    <a href="/profile-edit/{{ $LoggedUserInfo->id }}"><button>Edit my profile</button></a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>

