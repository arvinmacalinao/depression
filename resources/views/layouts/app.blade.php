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
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/map_style.css') }}" rel="stylesheet"/>
        <script src="{{ asset('js/map.js') }}"></script>
    </head>
    <body>
<nav class="navbar navbar-expand-md navbar-dark bg-primary">
  <!-- Brand -->
    <a class="navbar-brand" href="#">
      <img src="{{URL::asset('/images/brand_white.png')}}" width="30" height="30" alt="">
    </a>
 
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
 
  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
 
      <li class="nav-item">
        <a class="nav-link" href="#" style="color: #FFFFFF"><i class="fa-solid fa-chart-column"></i>   Project Summaries</a>
      </li>
 
      <li class="nav-item">
        <a class="nav-link" href="#" style="color: #FFFFFF"><i class="fa-solid fa-list"></i>  Projects</a>
      </li>
    </ul>
 
    <form class="form-inline my-2 my-lg-0 ml-3">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
      </div>
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    </form>
      </div>
  </div>
</nav>
        @yield('content')
    </body>

    <footer id="footer" style="font-family: 'Roboto Condensed', sans-serif;">
     <div class="bg-light py-2">
         <div class="text-center">
              <a href="https://impression.dostcalabarzon.ph/privacy_policy.php" class="btn btn-danger mb-2" title="Privacy Policy">Privacy Policy</a>
              <a href="https://www.privacy.gov.ph/data-privacy-act/" class="btn btn-danger mb-2" title="Republic Act 10173 - Data Privacy Act of 2012">Republic Act 10173 - Data Privacy Act of 2012</a>
              <br>
               <p>Information & Monitoring of Projects, Services and S&T Interventions</p> 
              <br>
               <p>Powered by DOST CALABARZON - MIS Unit</p>
         </div>
     </div>
 </footer>
</html>