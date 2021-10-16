<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/form.css') }}">
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
			<img src="{{ ('/assets/images/icons/menu.svg') }}" alt="open menu icon" onclick="openNav()">
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
							<h1>Login</h1>
						</div>
						<form class="login-form validate-form" action="{{ route('loginUser') }}" method="post">
							@csrf

							<div class="results">
								@if(Session::get('fail'))
								<div class="alert alert-danger">
									{{ Session::get('fail') }}
								</div>
								@endif
		
								 @if(Session::get('success'))
									<div class="alert alert-success">
										{{ Session::get('success') }}
									</div>
								@endif
							</div>

							<div class="form-group">
								<input class="form-control" name="email" type="text" placeholder="Email"
								value="{{ old('email') }}">
								<span class="form-label">Email</span>
							</div>
							<span class="text-danger">@error('email') {{ $message }} @enderror</span>


							<div class="form-group">
								<input class="form-control" name="password" type="password" placeholder="Password">
								<span class="form-label">Password</span>
							</div>
							<span class="text-danger">@error('password') {{ $message }} @enderror</span>

							<div class="form-group">
								<div 
									class="g-recaptcha" 
									data-sitekey="6LcyxSAbAAAAALiD3HMmlcHQ37gIdN3I-DyiUaYL"
									data-theme="dark"
									style="margin-top: 10px;">
								</div>
							</div>


							<div class="form-btn">
								<button class="submit-btn">Log in</button>
							</div>
							<div class="span">
								<span>Don't have an account?<a href="/register"> Sign up</a></span>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="./assets/js/jquery.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
	</script>
    

</body>
</html>