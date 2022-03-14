<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content=" {{ csrf_token() }} ">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/map_style.css') }}" rel="stylesheet"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link href="{{ asset('css/form.css') }}" rel="stylesheet"/>
        <script src="{{ asset('js/map.js') }}"></script>
        <script src="http://maps.google.com/maps/api/js?key=AIzaSyCMDx-ejfVStxIBhfqtBuLj98OV79kqbdY"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Varela&display=swap" rel="stylesheet">
        <link rel="stylesheet" href=https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css>
        <script src="https://unpkg.com/merge-images"></script>
        <title>Depression</title>
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
        <a class="nav-link" href="#" style="color: #FFFFFF"><i class="fa fa-bar-chart" aria-hidden="true"></i>   Project Summaries</a>
      </li>
 
      <li class="nav-item">
        <a class="nav-link" href="#" style="color: #FFFFFF"><i class="fa fa-list" aria-hidden="true"></i>  Projects</a>
      </li>
    </ul>
 
    <form class="form-inline my-2 my-lg-0 ml-3">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
      </div>
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    </form>
      </div>
  </div>
</nav>
        @yield('content')

        <div class="footer">
        <a href="https://impression.dostcalabarzon.ph/privacy_policy.php" class="btn btn-danger mb-2" title="Privacy Policy">Privacy Policy</a>
        <a href="https://www.privacy.gov.ph/data-privacy-act/" class="btn btn-danger mb-2" title="Republic Act 10173 - Data Privacy Act of 2012">Republic Act 10173 - Data Privacy Act of 2012</a>
        <br>
        Information & Monitoring of Projects, Services and S&T Interventions
        <br>
        Powered by DOST CALABARZON - MIS Unit
        </div>
</body>
</html>