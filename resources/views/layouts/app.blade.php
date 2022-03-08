<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content=" {{ csrf_token() }} ">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="http://maps.google.com/maps/api/js?key=AIzaSyCMDx-ejfVStxIBhfqtBuLj98OV79kqbdY"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
        <title>Depression</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/form.css') }}" rel="stylesheet"/>
        <script src="{{ asset('js/map.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar navbar-expand-md navbar-dark">
          <a class="navbar-brand" href="#"></a>
          <img src="{{URL::asset('/images/brand_white.png')}}" width="25" height="25" alt="">
      
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link disabled" href="#"> </a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="#"><i class="bi bi-bar-chart-steps"></i> Project Summaries</span></a>
            </li>
            
            <li class="nav-item active">
              <a class="nav-link" href="#">Projects</span></a>
            </li>

            <li class="nav-item">
              <form class="form-inline my-2 my-lg-0 ml-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                    </div>
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                    </div>
                </form>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link disabled" href="#"> </a>
            </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-bar-chart-line-fill"></i>
                BSC
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
            
            <li class="nav-item active">
              <a class="nav-link" href="#">Projects</span></a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="#">Others</span></a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="#">Contacts</span></a>
            </li>
            
            <li class="nav-item active">
              <a class="nav-link" href="#">Contacts</span></a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="#"></span></a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="#"></span></a>
            </li>

            

          </ul>
          
  </nav>
        @yield('content')
    </body>
    <footer class="page-footer" id="footer" style="font-family: 'Roboto Condensed', sans-serif;">
     <div class="bg-light py-2">
         <div class="text-center">
              <a href="https://impression.dostcalabarzon.ph/privacy_policy.php" class="btn btn-danger mb-2" title="Privacy Policy">Privacy Policy</a>
              <a href="https://www.privacy.gov.ph/data-privacy-act/" class="btn btn-danger mb-2" title="Republic Act 10173 - Data Privacy Act of 2012">Republic Act 10173 - Data Privacy Act of 2012</a>
              <br>
              Information & Monitoring of Projects, Services and S&T Interventions
              <br>
              Powered by DOST CALABARZON · MIS Unit
         </div>
     </div>
    </footer>
     <script
         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMDx-ejfVStxIBhfqtBuLj98OV79kqbdY&callback=initMap&libraries=&v=weekly"
         async
    ></script>
</html>


