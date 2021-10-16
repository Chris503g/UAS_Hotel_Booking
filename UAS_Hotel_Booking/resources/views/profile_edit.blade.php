<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/form.css') }}">
</head>

<body>
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
    <div id="order" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="order-form login">
                        <div class="form-header">
                            <h1>Edit profile</h1>
                        </div>
                        <form action="/profile-edit/submit{{ $user->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <!-- Nama, email, password, confirm password, tanggal lahir, nomor telepon, foto -->
                            <div class="profile-picture edit-page">
                                <img src="{{ asset('user_images/' . $user->photo) }}" alt="" width="300px" height="auto">
                            </div>
                            <div class="form-group image-form">
                                <span>PROFILE PICTURE</span>
                                <span class="file_name" style="padding-left: 10px;color:white; display: block;"></span>
                                <input name="photo" id="profile_picture" type="file" style="display: none;">
                                <label for="profile_picture">upload image</label>
                            </div>
                            <div class="form-group">
                                <input class="form-control  @error('phone_number') is-invalid @enderror"
                                value="{{ $user->phone_number }}" name="phone_number" type="text" placeholder="Phone Number">
                                <span class="form-label">Phone Number</span>
                            </div>
                            <div class="form-group">
                                <input class="form-control @error('birthdate') is-invalid @enderror"
                                value="{{ $user->birthdate }}" name="birthdate" type="date" placeholder="Birth Date">
                                <span class="form-label">Birth Date</span>
                            </div>
                            <div class="form-btn">
                                <button class="submit-btn">Update my profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script>
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

        document.getElementById("profile_picture").addEventListener("change", (event) => {
            document.querySelector("span.file_name").innerHTML = event.target.value;
        });
    </script>


</body>

</html>