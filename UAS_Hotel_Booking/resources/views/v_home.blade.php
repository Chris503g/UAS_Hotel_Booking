<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('./assets/css/webhotel.css')}}" />
    <title>Home IF430</title>
</head>
<body>
    
  <!-- //alert if needed
    @if(session('alert'))
    <div class="alert alert-warning" role="alert">
        {{ session('alert') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-warning" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
  -->

    <header>
        <div class="header-item logo">
          <a href="/">
            <img src="{{ asset('assets/images/logo/logohotelog.png') }}" alt="logo hotelog">
          </a>
        </div>
        <div class="header-item navIcon">
          <img src="{{ asset('assets/images/icons/menu.svg') }}" alt="open menu icon" onclick="openNav()">
        </div>
    
        <nav class="header-item nav">
          <ul>

            <!-- HALAMAN ABOUT US -->
            <li><a href="aboutUs" class="navButton"><button>About us</button></a></li>

            <!-- button untuk melihat reservasi -->
            <li><a href="order" class="navButton bookings"><button>Reservations</button></a></li>

            <!-- button untuk sign up  dan login -->
            @if (!session()->has('LoggedUser'))
            <li><a href="login" class="navButton login"><button>Log in</button></a></li>
            <li><a href="register" class="navButton register"><button>Register</button></a></li>
            @endif

             <!-- button untuk logout -->
            @if (session()->has('LoggedUser'))
            <li><a href="/logout" class="navButton log out"><button>Logout</button> </a></li> 
            @endif
            
            <!-- button untuk melihat reservasi -->
            @if (session()->has('LoggedUser'))
             <li>
              @foreach($user as $userData)
                @if($userData->id == session('LoggedUser'))
                  <a href="profile" class="navButton user-profile">
                    <div class="profile-picture">
                          <img src="{{ asset('user_images/' . $userData->photo) }}" alt="" width="300px" height="auto">
                    </div>
                    <span>{{ $userData->user_full_name}}</span>
                  </a>
                @endif
              @endforeach
            </li> 
            @endif

          </ul>
        </nav>
    
        <aside class="sideBar" id="Sidebar">
          <div class="closeIcon" onclick="closeNav()">
            <img src="{{ asset('./assets/images/icons/x.svg') }}" alt="closemenuicon" />
          </div>
          <div class="sidebarMenu">

            <!-- HALAMAN ABOUT US -->
            <a href="aboutUs" class="sidebarButton"><button>About Us</button></a>

            <!-- button untuk melihat reservasi -->
            @if (session()->has('LoggedUser'))
            <a href="order" class="sidebarButton "><button>Reservations</button> </a>
            @endif
            
            <!-- button untuk register dan login -->
            @if (!session()->has('LoggedUser'))
            <a href="login" class="sidebarButton "><button> Login</button></a>
            <a href="register" class="sidebarButton "><button>Sign up</button> </a>
            @endif

            <!-- button untuk logout -->
            @if (session()->has('LoggedUser'))
            <a href="/logout" class="sidebarButton"><button> Log out</button></a>
            @endif 

          </div>
        </aside>
      </header>
    
      <main>
        <div class="main-container">
          <aside class="main-item filter-container" id="filterContainer">
            <div class="filter-item filter-header">
              <h2>Filter</h2>
            </div>
    
            <div class="filter-item filter-location">
              <label for="location">Location</label><br>
              <input type="text" id="filter-location" name="location" placeholder="search location..." autocomplete="off">
            </div>
    
            <div class="filter-item filter-price">
              <label for="price">Price budget <small>*min 100K/night</small></label><br>
              <input type="text" id="filter-price" name="price" placeholder="input price..." autocomplete="off">
            </div>
    
            <div class="filter-item filter-star">
              <form action="/action_page.php">
                <label class="checkbox-container" for="star-1">1-star
                  <input type="checkbox" id="star-1" name="star-1" value="1">
                  <span class="checkmark"></span>
                </label>
                <label class="checkbox-container" for="star-2">2-star
                  <input type="checkbox" id="star-2" name="star-2" value="2">
                  <span class="checkmark"></span>
                </label>
                <label class="checkbox-container" for="star-3">3-star
                  <input type="checkbox" id="star-3" name="star-3" value="3">
                  <span class="checkmark"></span>
                </label>
                <label class="checkbox-container" for="star-4">4-star
                  <input type="checkbox" id="star-4" name="star-4" value="4">
                  <span class="checkmark"></span>
                </label>
                <label class="checkbox-container" for="star-5">5-star
                  <input type="checkbox" id="star-5" name="star-5" value="5">
                  <span class="checkmark"></span>
                </label>
              </form>
            </div>
          </aside>

            <div class="main-item card-container">
                @foreach ($hotel as $data)

                    <div class="card">
                    <div class="card-item card-img">
                        <img class="hotel-img" src="{{ asset('hotel_images/' . $data->picture) }}" alt="{{ $data->hotel_name }}">
                    </div>
                    <div class="card-item hotel-label">
                        <h3 class="label-item hotel-name">{{ $data->hotel_name }}
                        <span class="star-value" style="display: none;">{{ $data->rating }}</span>
                        <span class="stars"></span>
                        </h3>
                        <span class="label-item hotel-location">{{ $data->city }}</span>
                        <div class="label-item hotel-description">
                        <p>{{ $data->description }}</p>
                        </div>
                        <div class="label-item hotel-facilities">
                        <ul>
                            <?php 
                                $var = $data->facility;

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
                          @if($roomData->hotel_id == $data->id)
                            <span class="hotel-price">{{ $roomData->price_per_day }}</span>
                          @endif
                        @endforeach
                       <a href="/order-booking/{{ $data->id }}"><button class="book-btn-style">Book</button></a>
                        </div>
                    </div>
                    </div>

                @endforeach
                
                <div class="card noresult" id="no-result-card" style="display:none;">
                <h1 class="card-item text">No result!</h1>
                </div>
            </div>

            

        </div>
      </main>
    
      <footer>
        <h4>Copyright &#169; 2021 by Kelompok 7-IF430_A</h4>
      </footer>
      <script src="{{ asset('./assets/js/sidebarMenu.js') }}"></script>
      <script src="{{ asset('./assets/js/general.js') }}"></script>
      <!--add stars and format hotel price-->
      <script src="{{ asset('./assets/js/homeScript.js') }}"></script>

</body>
</html>