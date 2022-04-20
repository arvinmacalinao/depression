<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content=" {{ csrf_token() }} ">
        
        <!-- JavaScript Bundle with Popper -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
        <title>Depression</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:500,900,100,300,700,400' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        
        {{-- CSS --}}
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/map_style.css') }}" rel="stylesheet"/>
        <link href="{{ asset('css/form.css') }}" rel="stylesheet"/>


        {{-- Map JS --}}
        <script src="{{ asset('js/map.js') }}"></script>
        <script src="{{ asset('js/map_2.js') }}"></script>
        <script src="{{ asset('js/vendor.js') }}"></script>
        <script src="http://maps.google.com/maps/api/js?key=AIzaSyCMDx-ejfVStxIBhfqtBuLj98OV79kqbdY"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/merge-images"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.6/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        {{-- Datatable --}}
        <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> 
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.11.5/api/sum().js"></script>
        
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-print-2.2.2/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.2/sp-2.0.0/sl-1.3.4/sr-1.1.0/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-print-2.2.2/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.2/sp-2.0.0/sl-1.3.4/sr-1.1.0/datatables.min.js"></script> -->
        
        {{-- Chosen --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- Date Picker --}}
    </head>

    <body>
    <!--Navbar -->
    <nav class="navbar navbar-expand-md navbar">
          <a class="navbar-brand" href="/" style="margin-right: 0%">
            <img src="{{URL::asset('/images/brand_white.png')}}" width="25" height="25" alt="">
          </a>
          
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link disabled" href="#"> </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/summary"><i class="fa fa-bar-chart"></i> Project Summaries</span></a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="/projects"><i class="fa fa-list"></i> Projects</span></a>
            </li>

            <li class="nav-item">
              <form class="form-inline my-2 my-lg-0 ml-3">
              <div class="input-group ">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Search">
                  <div class="input-group-append">
                    <button class="btn btn-success btn-sm" type="button" id="button-addon2">Search</button>
                  </div>
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
                  <a class="dropdown-item" href="/statreport">Status Reports</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/project-collage">Project Gallery</a>
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
    
     <script src="{{ asset('js/charts.js') }}"></script>
    <footer class="footer">
         <div class="text-center">
              <a href="https://impression.dostcalabarzon.ph/privacy_policy.php" class="btn btn-danger mb-2" title="Privacy Policy">Privacy Policy</a>
              <a href="https://www.privacy.gov.ph/data-privacy-act/" class="btn btn-danger mb-2" title="Republic Act 10173 - Data Privacy Act of 2012">Republic Act 10173 - Data Privacy Act of 2012</a>
              <br>
               <p>Information & Monitoring of Projects, Services and S&T Interventions</p> 
               <p>Powered by DOST CALABARZON - MIS Unit</p>
          </div>
    </footer>
     <script
         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMDx-ejfVStxIBhfqtBuLj98OV79kqbdY&callback=initMap&libraries=&v=weekly"
         async
    ></script>
</html>
