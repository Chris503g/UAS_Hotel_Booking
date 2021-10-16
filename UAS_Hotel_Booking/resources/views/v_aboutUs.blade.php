<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile Member</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/css/aboutus_styling.css') }}" />

</head>

<body>
  <header>
    <div class="header-item logo">
      <a href="/">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#ffffff" viewBox="0 0 256 256">
          <rect width="256" height="256" fill="none"></rect>
          <circle cx="128" cy="128" r="96" fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="16">
          </circle>
          <polyline points="121.941 161.941 88 128 121.941 94.059" fill="none" stroke="#ffffff" stroke-linecap="round"
            stroke-linejoin="round" stroke-width="16"></polyline>
          <line x1="88" y1="128" x2="168" y2="128" fill="none" stroke="#ffffff" stroke-linecap="round"
            stroke-linejoin="round" stroke-width="16"></line>
        </svg>
      </a>
    </div>
    <div class="header-item logo2">
      <img src="{{ asset('assets/images/logo/logohotelog.png') }}" alt="">
    </div>
  </header>
  <div class="main-header">
    <h1>Meet our team!</h1>
  </div>
  <main>
    <div class="container">
      <div class="card" id="card-1">
        <div class="card-item profile-image">
          <img src="{{ asset('assets/images/avatar/ChrisA.jpg') }}" alt="Avatar" class="image" />
        </div>
        <div class="card-item profile-name">
          <h2>Christofer Alexander</h2>
        </div>
        <div class="card-item profile-nim">
          <p>00000034802</p>
        </div>
        <div class="card-item profile-role">
          <p>Back-end</p>
        </div>
        <div class="card-item profile-social_icon">
          <a href="https://www.instagram.com/christo_alx/" target="_blank" rel="noopener"><i
              class="fa fa-instagram"></i></a>
          <a href="https://www.linkedin.com/" target="_blank" rel="noopener"><i
              class="fa fa-linkedin"></i></a>
          <a href="https://www.facebook.com/" target="_blank" rel="noopener"><i
              class="fa fa-facebook-f"></i></a>
          <a href="https://github.com/Chris503g" target="_blank" rel="noopener"><i class="fa fa-github"></i></a>
        </div>
      </div>

      <div class="card" id="card-2">
        <div class="card-item profile-image">
          <img src="{{ asset('assets/images/avatar/DavidP.jpg') }}" alt="Avatar" class="image" />
        </div>
        <div class="card-item profile-name">
          <h2>David Petersen</h2>
        </div>
        <div class="card-item profile-nim">
          <p>00000036966</p>
        </div>
        <div class="card-item profile-role">
          <p>Front-end</p>
        </div>
        <div class="card-item profile-social_icon">
          <a href="https://www.instagram.com/davidptrsen/" target="_blank" rel="noopener"><i
              class="fa fa-instagram"></i></a>
          <a href="https://www.linkedin.com/in/david-petersen-5062a1211/" target="_blank" rel="noopener"><i
              class="fa fa-linkedin"></i></a>
          <a href="https://www.facebook.com/Davidp432" target="_blank" rel="noopener"><i
              class="fa fa-facebook-f"></i></a>
          <a href="https://github.com/DavidPetersenZZZ" target="_blank" rel="noopener"><i class="fa fa-github"></i></a>
        </div>
      </div>

      <div class="card" id="card-3">
        <div class="card-item profile-image">
          <img src="{{ asset('assets/images/avatar/DennS.jpg') }}" alt="Avatar" class="image" />
        </div>
        <div class="card-item profile-name">
          <h2>Denn Sebastian</h2>
        </div>
        <div class="card-item profile-nim">
          <p>00000036981</p>
        </div>
        <div class="card-item profile-role">
          <p>Back-end</p>
        </div>
        <div class="card-item profile-social_icon">
          <a href="" target="_blank" rel="noopener"><i class="fa fa-instagram"></i></a>
          <a href="" target="_blank" rel="noopener"><i class="fa fa-linkedin"></i></a>
          <a href="" target="_blank" rel="noopener"><i class="fa fa-facebook-f"></i></a>
          <a href="" target="_blank" rel="noopener"><i class="fa fa-github"></i></a>
        </div>
      </div>

      <div class="card" id="card-4">
        <div class="card-item profile-image">
          <img src="{{ asset('assets/images/avatar/StefanD.jpg') }}" alt="Avatar" class="image" />
        </div>
        <div class="card-item profile-name">
          <h2>Stefan Dharmawan</h2>
        </div>
        <div class="card-item profile-nim">
          <p>00000034182</p>
        </div>
        <div class="card-item profile-role">
          <p>Front-end</p>
        </div>
        <div class="card-item profile-social_icon">
          <a href="https://www.instagram.com/stefan_dharmawan/" target="_blank" rel="noopener"><i
              class="fa fa-instagram"></i></a>
          <a href="https://www.linkedin.com/in/stefan-dharmawan-713287210" target="_blank" rel="noopener"><i
              class="fa fa-linkedin"></i></a>
          <a href="https://www.facebook.com/Stefan.Dharmawan.T/" target="_blank" rel="noopener"><i
              class="fa fa-facebook-f"></i></a>
          <a href="https://github.com/TepanD" target="_blank" rel="noopener"><i class="fa fa-github"></i></a>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
