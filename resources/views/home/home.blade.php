@extends('./layouts.app')

@section('content')
<div id="map_canvas">
    <div id="map" style="height: 720px; width: 100%;"></div>
<nav class="navbar navbar-expand-md navbar-dark bg-primary"><h4 class="text-light">Legends</h4></nav>
<div>
    <img src="" id="lugo" />
</div>
<!-- Legends Div -->
<small>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 mt-2">
                <h5><b>Project Type</b></h5>
                <ul class="list-group">
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/t1.png')}}">   Setup</li>
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/t2.png')}}">   Roll-out</li>
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/t3.png')}}">   Tapi Assisted</li>
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/t4.png')}}">   GIA Community Based</li>
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/t5.png')}}">   GIA Internally Funded</li>
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/t6.png')}}">   GIA Externally Funded</li>
                </ul>                
            </div>
            
            <div class="col-sm-4 mt-2">
                <h5><b>Sectors</b></h5>
                <ul class="list-group">
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/sec1.png')}}">  Food Processing</li>
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/sec2.png')}}">  Furniture</li>
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/sec3.png')}}">  Gifts / Decors / Handicrafts</li>
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/sec4.png')}}">  Metals & Engineering</li>
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/sec5.png')}}">  Agriculture / Marine / Aquaculture / Forestry / Livestock</li>
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/sec6.png')}}">  Health & Wellness Products</li>
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/sec7.png')}}">  ICT</li>
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/sec8.png')}}">  Halal Products & Service</li>
                <li class="list-group-item"><img src="{{URL::asset('/images/legends/sec9.png')}}">  Other Regional Industry Priorities</li>
                </ul>
            </div>

            <div class="col-sm-4 mt-2">
                <h5><b>Status</b></h5>
                <ul class="list-group">
                    <li class="list-group-item"><img src="{{URL::asset('/images/legends/sta1.png')}}">  Completed</li>
                    <li class="list-group-item"><img src="{{URL::asset('/images/legends/sta2.png')}}">  On-going</li>
                    <li class="list-group-item"><img src="{{URL::asset('/images/legends/sta3.png')}}">  New</li>
                    <li class="list-group-item"><img src="{{URL::asset('/images/legends/sta4.png')}}">  Graduated</li>
                    <li class="list-group-item"><img src="{{URL::asset('/images/legends/sta5.png')}}">  Widthdrawn</li>
                    <li class="list-group-item"><img src="{{URL::asset('/images/legends/sta6.png')}}">  Terminated</li>
                </ul>                
            </div>
        </div>

    </div>
</small>
<!-- End of Legends Div -->

<!-- Map Filter Div -->
<form id="mp_Form">
<div class="map-filter w3-animate-left" id="mpFilter">
    <div class="container">
        Map Filters<span class="close">x</span>
    <small>
        <div class="form-group input-group-sm">
            <label><b>Search</b></label>
            <input type="text" class="form-control" id="mf_search" placeholder="Keyword">
        </div>
    
        <div class="form-group input-group-sm">
            <label><b>Region</b></label>
            <select class="form-control" id="mf_cmb_region">
                    <option>All</option>
                @foreach($mf_regions as $mf_region)
                    <option>{{$mf_region->region_code}} ({{$mf_region->region_name}})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group input-group-sm">
            <label><b>Province</b></label>
            <select class="form-control" id="mf_cmb_province">
                <option>All</option>
                @foreach($mf_provinces as $mf_province)
                    <option id="{{$mf_province->province_id}}">{{$mf_province->province_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group input-group-sm">
            <label><b>District</b></label>
            <select class="form-control" id="mf_cmb_district">
                <option>All</option>
                @foreach($mf_districts as $mf_district)
                    <option>{{$mf_district->district_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group input-group-sm">
            <label><b>Project Type</b></label>
            <select class="form-control" id="mf_cmb_prjtype">
                <option>All</option>
                @foreach($mf_projtypes as $mf_projtype)
                    <option>{{$mf_projtype->prj_type_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group input-group-sm">
            <label><b>Equipment</b></label>
            <select class="form-control" id="mf_cmb_equipment">
                <option>All</option>
                @foreach($mf_equipments as $mf_equipment)
                    <option>{{$mf_equipment->brand_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group input-group-sm">
            <label><b>Sector</b></label>
            <select class="form-control" id="mf_cmb_sector">
                <option>All</option>
                @foreach($mf_sectors as $mf_sector)
                    <option>{{$mf_sector->sector_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group input-group-sm">
            <label><b>Status</b></label>
            <select class="form-control" id="mf_cmb_status">
                <option>All</option>
                @foreach($mf_status as $mf_statu)
                    <option>{{$mf_statu->prj_status_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group input-group-sm">
            <div class="row">
                <div class="col-sm-6">
                    <label for="exampleFormControlSelect1"><b>Year From</b></label>
                    <select class="form-control" id="exampleFormControlSelect1">
                    <option>--</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="exampleFormControlSelect1"><b>Year To</b></label>
                    <select class="form-control" id="exampleFormControlSelect1">
                    <option>--</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group float-right">
            <button type="button" class="btn btn-danger btn-sm" id="mf_close">Close</button>
            <button type="button" class="btn btn-primary btn-sm" id="mf_apply">Apply</button>
        </div>

    </small>
    </div>
</div>
</form>
<
<!-- End of Map Filter Div -->

<script>

let map;
google.maps.event.addDomListener(window, 'load', initialize);

m1 = [];
imagePath = "../images/markers/"

function initialize() { // Initialize Google Maps
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 14.1724416, lng: 121.2234637 },
        zoom: 11,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false
    });

    const centerControlDiv = document.createElement("div");
    CenterControl(centerControlDiv, map);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(centerControlDiv);

    setIcons();
}

function CenterControl(controlDiv, map) { // Adding Mapfilter button to google maps
    // Set CSS for the control border.
    const controlUI = document.createElement("div");
  
    controlUI.style.backgroundColor = "#fff";
    controlUI.style.border = "2px solid #fff";
    controlUI.style.borderRadius = "4px";
    controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
    controlUI.style.cursor = "pointer";
    controlUI.style.marginTop = "8px";
    controlUI.style.marginBottom = "22px";
    controlUI.style.marginLeft = "8px";
    controlUI.style.textAlign = "center";
    controlDiv.appendChild(controlUI);
  
    // Set CSS for the control interior.
    const controlText = document.createElement("div");
  
    controlText.style.color = "rgb(25,25,25)";
    controlText.style.fontFamily = "Roboto,Arial,sans-serif";
    controlText.style.fontSize = "16px";
    controlText.style.lineHeight = "38px";
    controlText.style.paddingLeft = "5px";
    controlText.style.paddingRight = "5px";
    controlText.innerHTML = "Map Filters";
    controlUI.appendChild(controlText);
    controlUI.addEventListener("click", () => {
        document.getElementById("mpFilter").style.display = "block";
    });
}

function setIcons(){ // Setting and Placing Icons

    @foreach($icons as $icon)
        iCon = {{$icon->prj_type_id}}
        iConTwo = {{$icon->sector_id}}
        iConThree = {{$icon->prj_status_id}}
        iConFour = {{$icon->region_id}}

        if( iCon == '6' ){ //Setup Icon
            icon1 = imagePath + "prj_0.png"
        }

        if(iCon  == '8' ){ //Roll-out Icon
            icon1 = imagePath + "prj_1.png"
        }

        if(iCon  == '9' ){ //Tapi Assisted Icon
            icon1 = imagePath + "prj_2.png"
        }

        if(iCon  == '12' ){ //GIA Community Based Icon
            icon1 = imagePath + "prj_3.png"
        }

        if(iCon  == '13' ){ //GIA Internally Funded
            icon1 = imagePath + "prj_4.png"
        }

        if(iCon  == '14' ){ //GIA Externally Funded
            icon1 = imagePath + "prj_5.png"
        }

        //Sector Icons---------------------------------------

        if(iConTwo == '1' ){ //Food Processing
            icon2 = imagePath + "sec_0.png"
        }

        if(iConTwo == '2' ){ //Furniture
            icon2 = imagePath + "sec_1.png"
        }

        if(iConTwo == '3' ){ //Gifts / Decors / Handicrafts
            icon2 = imagePath + "sec_2.png"
        }

        if(iConTwo == '4' ){ //Metals & Engineering
            icon2 = imagePath + "sec_3.png"
        }

        if(iConTwo == '5' ){ //Agriculture / Marine / Agriculture / Forestry / Livestock
            icon2 = imagePath + "sec_4.png"
        }

        if(iConTwo == '7' ){ //Health & Wellness Products
            icon2 = imagePath + "sec_5.png"
        }

        if(iConTwo == '8' ){ //ICT
            icon2 = imagePath + "sec_6.png"
        }

        if(iConTwo == '21' ){ //Halal Products & Service
            icon2 = imagePath + "sec_7.png"
        }

        if(iConTwo == '18' ){ //Other Regional Insdustry Priorites
            icon2 = imagePath + "sec_8.png"
        }

        //---------------Status---------------------------//
        if(iConThree == '8' ){ //Completed
            icon3 = imagePath + "stat_0.png"
        }
        if(iConThree == '1' ){ //On-going
            icon3 = imagePath + "stat_1.png"
        }
        if(iConThree == '3' ){ //New
            icon3 = imagePath + "stat_2.png"
        }
        if(iConThree == '4' ){ //Graduated
            icon3 = imagePath + "stat_3.png"
        }
        if(iConThree == '7' ){ //Widthdrawn
            icon3 = imagePath + "stat_4.png"
        }
        if(iConThree == '6' ){ //Terminated
            icon3 = imagePath + "stat_5.png"
        }

        //---------------Regional---------------------------//
        if(iConFour == '1' ){ //NCR
            icon4 = imagePath + "reg_0.png"
        }
        if(iConFour == '2' ){ //CAR
            icon4 = imagePath + "reg_1.png"
        }
        if(iConFour == '3' ){ //REGION 1
            icon4 = imagePath + "reg_2.png"
        }
        if(iConFour == '4' ){ //REGION 2
            icon4 = imagePath + "reg_3.png"
        }
        if(iConFour == '5' ){ //REGION 3
            icon4 = imagePath + "reg_4.png"
        }
        if(iConFour == '6' ){ //REGION 4A
            icon4 = imagePath + "reg_5.png"
        }
        if(iConFour == '7' ){ //REGION 4B
            icon4 = imagePath + "reg_6.png"
        }
        if(iConFour == '8' ){ //REGION 5
            icon4 = imagePath + "reg_7.png"
        }
        if(iConFour == '9' ){ //REGION 6
            icon4 = imagePath + "reg_8.png"
        }
        if(iConFour == '10' ){ //REGION 7
            icon4 = imagePath + "reg_9.png"
        }
        if(iConFour == '11' ){ //REGION 8
            icon4 = imagePath + "reg_10.png"
        }
        if(iConFour == '12' ){ //REGION 9
            icon4 = imagePath + "reg_11.png"
        }
        if(iConFour == '13' ){ //REGION 10
            icon4 = imagePath + "reg_12.png"
        }
        if(iConFour == '14' ){ //REGION 11
            icon4 = imagePath + "reg_13.png"
        }
        if(iConFour == '15' ){ //REGION 12
            icon4 = imagePath + "reg_14.png"
        }
        if(iConFour == '16' ){ //CARAGA 
            icon4 = imagePath + "reg_15.png"
        }
        if(iConFour == '17' ){ //ARMM
            icon4 = imagePath + "reg_16.png"
        }

        mergeImages([icon1, icon2, icon3, icon4])
        .then(b64 => {
                const p1 = new google.maps.Marker({
                position: { lat: parseFloat({{$icon->prj_latitude}}), lng: parseFloat({{$icon->prj_longitude}}) },
                map,
                icon: b64
            });

            const infowindow = new google.maps.InfoWindow({
                content: "{{$icon->prj_title}}",
            });

            m1.push(p1);
            p1.addListener("mouseover", () => {
                infowindow.open({
                anchor: p1,
                map,
                shouldFocus: false,
                });
            });

            p1.addListener('mouseout', function() {
                infowindow.close();
            });  
        });


    @endforeach
}

function removeMarkers(){ // Removes markers
    for(i=0; i<m1.length; i++){
        m1[i].setMap(null);
    }
}
</script>

@endsection()