<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content=" {{ csrf_token() }} ">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.usebootstrap.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
        <title>Depression</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:500,900,100,300,700,400' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        
        
        {{-- CSS --}}
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/map_style.css') }}" rel="stylesheet"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link href="{{ asset('css/form.css') }}" rel="stylesheet"/>


        {{-- Map JS --}}
        <script src="{{ asset('js/map.js') }}"></script>

        {{-- Datatable --}}
        <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> 
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.11.5/api/sum().js"></script>
        
        {{-- Chosen --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- Date Picker --}}
      

    

        

      </head>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Depression</title>
    </head>

    <body>
    <!--Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark">
          <a class="navbar-brand" href="./" style="margin-right: 0%">
            <img src="{{URL::asset('/images/brand_white.png')}}" width="25" height="25" alt="">
          </a>
          
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link disabled" href="#"> </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fa fa-bar-chart"></i> Project Summaries</span></a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="./projects"><i class="fa fa-list"></i> Projects</span></a>
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
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link disabled" href="#"> </a>
            </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-signal"></i>
                BSC
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Customer Perspective</a>
                  <a class="dropdown-item" href="#">Financial Perspective</a>
                  <a class="dropdown-item" href="#">Internal Process Perspective</a>
                  <a class="dropdown-item" href="#">Learning & Growth Perspective</a>
                </div>
              </li>
            
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-industry"></i>
                Projects
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">All Projects</a>
                  <a class="dropdown-item" href="#">Status Reports</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Project Gallery</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Project Data Quality Monitoring</a>
                  <a class="dropdown-item" href="#">Project Document Files Monitoring</a>
                  <a class="dropdown-item" href="#">Project Liquidation Monitoring</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">SETUP Projects Productivity Information</a>
                  
                </div>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i>
                Others
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Possible Problematic SETUP Projects March 2022</a>
                  <a class="dropdown-item" href="#">User Activity 2022</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Equipment Suppliers</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Consultancies</a>
                  <a class="dropdown-item" href="#">CSF Ratings</a>
                  <a class="dropdown-item" href="#">DRR-CCAM</a>
                  <a class="dropdown-item" href="#">Fora/Training/Seminars</a>
                  <a class="dropdown-item" href="#">Innovatiove Hubs</a>
                  <a class="dropdown-item" href="#">International Collaborations</a>
                  <a class="dropdown-item" href="#">ISO Accreditation</a>
                  <a class="dropdown-item" href="#">Library Monitoring</a>
                  <a class="dropdown-item" href="#">Packaging & Labeling</a>
                  <a class="dropdown-item" href="#">R & D Agenda</a>
                  <a class="dropdown-item" href="#">R & D Projects</a>
                  <a class="dropdown-item" href="#">Regional Communications Plan</a>
                  <a class="dropdown-item" href="#">S & T Fairs & Promotional Activities</a>
                  <a class="dropdown-item" href="#">S & T Information and Referal</a>
                  <a class="dropdown-item" href="#">Scholarship Monitoring</a>
                  <a class="dropdown-item" href="#">SUC Assistance</a>
                  <a class="dropdown-item" href="#">Testing & Calibration</a>
                  <a class="dropdown-item" href="#">Technology Promotion</a>
                  <a class="dropdown-item" href="#">Technology Adaption</a>
                </div>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-address-card"></i>
                Contacts
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Cooperators</a>
                  <a class="dropdown-item" href="#">Service Providers</a>
                </div>
              </li>
            
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Collaborating Agencies</a>
                  <a class="dropdown-item" href="#">Collaborating Agency Categories</a>
                  <a class="dropdown-item" href="#">Colsultancy Categories</a>
                  <a class="dropdown-item" href="#">Document Categories</a>
                  <a class="dropdown-item" href="#">Equipment Names</a>
                  <a class="dropdown-item" href="#">Location Listings</a>
                  <a class="dropdown-item" href="#">Organization Categories</a>
                  <a class="dropdown-item" href="#">Product Units</a>
                  <a class="dropdown-item" href="#">Project Categories</a>
                  <a class="dropdown-item" href="#">S&T Activity Categories</a>
                  <a class="dropdown-item" href="#">Sectors</a>
                  <a class="dropdown-item" href="#">Technology</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Course Categories</a>
                  <a class="dropdown-item" href="#">Courses</a>
                  <a class="dropdown-item" href="#">Scholarship Programs</a>
                  <a class="dropdown-item" href="#">Schools</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Users</a>
                  <a class="dropdown-item" href="#">User Groups</a>
                  <a class="dropdown-item" href="#">User Logs</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Agency Profile</a>
                </div>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Project Data Quality Monitoring</a>
                  <a class="dropdown-item" href="#">Project Document Files Monitoring</a>
                  <a class="dropdown-item" href="#">Project Liquidation Monitoring</a>
                </div>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#"><i class="fa fa-user"></i>Profile</a>
                  <a class="dropdown-item" href="#"><i class="fa fa-power-off"></i>Logout</a>
                </div>
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
               <p>Information & Monitoring of Projects, Services and S&T Interventions</p> 
               <p>Powered by DOST CALABARZON - MIS Unit</p>
         </div>
     </div>
    </footer>
     <script
         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMDx-ejfVStxIBhfqtBuLj98OV79kqbdY&callback=initMap&libraries=&v=weekly"
         async
    ></script>
</html>


