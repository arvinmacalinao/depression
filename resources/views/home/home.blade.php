@extends('./layouts.app')

@section('content')
<div id="map_canvas">
    <div id="map" style="height: 660px; width: 100%;"></div>
</div>
<nav class="navbar navbar-expand-md navbar-dark bg-primary"><h4 class="text-light">Legends</h4></nav>

<script>

let map;
google.maps.event.addDomListener(window, 'load', initialize);
var markers = {!! json_encode($markers->toArray()) !!};
var m1 = [];
var m2 = [];
var m3 = [];
var m4 = [];

function initialize() { // Initialize Google Maps

    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 14.1724416, lng: 121.2234637 },
        zoom: 11,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false
    });

    $.each( markers, function( index, value ){

        var icon1;
        var icon2;
        var icon3;
        var icon4;
        var imagePath = "../images/markers/"
        if(value.prj_id == '1' ){ //Setup Icon
        icon1 = imagePath + "prj_0.png"
        }

        if(value.prj_id == '2' ){ //Roll-out Icon
            icon1 = imagePath + "prj_1.png"
        }

        if(value.prj_id == '3' ){ //Tapi Assisted Icon
            icon1 = imagePath + "prj_2.png"
        }

        if(value.prj_id == '4' ){ //GIA Community Based Icon
            icon1 = imagePath + "prj_3.png"
        }

        if(value.prj_id == '5' ){ //GIA Internally Funded
            icon1 = imagePath + "prj_4.png"
        }

        if(value.prj_id == '6' ){ //GIA Externally Funded
            icon1 = imagePath + "prj_5.png"
        }

        //---------------Sectors---------------------------//
        if(value.sec_id == '1' ){ //Food Processing
            icon2 = imagePath + "sec_0.png"
        }

        if(value.sec_id == '2' ){ //Furniture
            icon2 = imagePath + "sec_1.png"
        }

        if(value.sec_id == '3' ){ //Gifts / Decors / Handicrafts
            icon2 = imagePath + "sec_2.png"
        }

        if(value.sec_id == '4' ){ //Metals & Engineering
            icon2 = imagePath + "sec_3.png"
        }

        if(value.sec_id == '5' ){ //Agriculture / Marine / Agriculture / Forestry / Livestock
            icon2 = imagePath + "sec_4.png"
        }

        if(value.sec_id == '6' ){ //Health & Wellness Products
            icon2 = imagePath + "sec_5.png"
        }

        if(value.sec_id == '7' ){ //ICT
            icon2 = imagePath + "sec_6.png"
        }

        if(value.sec_id == '8' ){ //Halal Products & Service
            icon2 = imagePath + "sec_7.png"
        }

        if(value.sec_id == '9' ){ //Other Regional Insdustry Priorites
            icon2 = imagePath + "sec_8.png"
        }

        //---------------Status---------------------------//
        if(value.stat_id == '1' ){ //Completed
            icon3 = imagePath + "stat_0.png"
        }

        if(value.stat_id == '2' ){ //On-going
            icon3 = imagePath + "stat_1.png"
        }

        if(value.stat_id == '3' ){ //New
            icon3 = imagePath + "stat_2.png"
        }

        if(value.stat_id == '4' ){ //Graduated
            icon3 = imagePath + "stat_3.png"
        }

        if(value.stat_id == '5' ){ //Widthdrawn
            icon3 = imagePath + "stat_4.png"
        }

        if(value.stat_id == '6' ){ //Terminated
            icon3 = imagePath + "stat_5.png"
        }

        //---------------Regional---------------------------//
        if(value.reg_id == '1' ){ //NCR
            icon4 = imagePath + "reg_0.png"
        }

        if(value.reg_id == '2' ){ //CAR
            icon4 = imagePath + "reg_1.png"
        }

        if(value.reg_id == '3' ){ //REGION 1
            icon4 = imagePath + "reg_2.png"
        }

        if(value.reg_id == '4' ){ //REGION 2
            icon4 = imagePath + "reg_3.png"
        }

        if(value.reg_id == '5' ){ //REGION 3
            icon4 = imagePath + "reg_4.png"
        }

        if(value.reg_id == '6' ){ //REGION 4A
            icon4 = imagePath + "reg_5.png"
        }

        if(value.reg_id == '7' ){ //REGION 4B
            icon4 = imagePath + "reg_6.png"
        }

        if(value.reg_id == '8' ){ //REGION 5
            icon4 = imagePath + "reg_7.png"
        }

        if(value.reg_id == '9' ){ //REGION 6
            icon4 = imagePath + "reg_8.png"
        }

        if(value.reg_id == '10' ){ //REGION 7
            icon4 = imagePath + "reg_9.png"
        }

        if(value.reg_id == '11' ){ //REGION 8
            icon4 = imagePath + "reg_10.png"
        }

        if(value.reg_id == '12' ){ //REGION 9
            icon4 = imagePath + "reg_11.png"
        }

        if(value.reg_id == '13' ){ //REGION 10
            icon4 = imagePath + "reg_12.png"
        }

        if(value.reg_id == '14' ){ //REGION 11
            icon4 = imagePath + "reg_13.png"
        }

        if(value.reg_id == '15' ){ //REGION 12
            icon4 = imagePath + "reg_14.png"
        }

        if(value.reg_id == '16' ){ //CARAGA 
            icon4 = imagePath + "reg_15.png"
        }

        if(value.reg_id == '17' ){ //ARMM
            icon4 = imagePath + "reg_16.png"
        }


        const infowindow = new google.maps.InfoWindow({
            content: value.project_name,
        });


        //-----------------MARKERS-----------------------------------------------------//
        setTimeout(() => {  
           var p1 = new google.maps.Marker({
                position: { lat: parseFloat(value.prj_lat), lng: parseFloat(value.prj_long) },
                map,
                icon: icon1,
            });
            m1.push(p1);
        }, 500);

        setTimeout(() => {  
            var p2 = new google.maps.Marker({
                position: { lat: parseFloat(value.prj_lat), lng: parseFloat(value.prj_long) },
                map,
                icon: icon2,
            });
            m2.push(p2);
        }, 550);

        setTimeout(() => {  
            var p3 = new google.maps.Marker({
                position: { lat: parseFloat(value.prj_lat), lng: parseFloat(value.prj_long) },
                map,
                icon: icon3,
            });
            m3.push(p3);
        }, 600);

        setTimeout(() => {  
            const marky = new google.maps.Marker({
                position: { lat: parseFloat(value.prj_lat), lng: parseFloat(value.prj_long) },
                map,
                icon: icon4,
            });

            marky.addListener("mouseover", () => {
                infowindow.open({
                anchor: marky,
                map,
                shouldFocus: false,
            });
            });

            marky.addListener('mouseout', function() {
                infowindow.close();
            });

            m4.push(marky);

        }, 700);
        //-----------------MARKERS-----------------------------------------------------//




        });

    const centerControlDiv = document.createElement("div");
    CenterControl(centerControlDiv, map);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(centerControlDiv);
    }

function CenterControl(controlDiv, map) {
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
    
    });
}

function removeMarkers(){
    for(i=0; i<m1.length; i++){
        m1[i].setMap(null);
    }

    for(i=0; i<m2.length; i++){
        m2[i].setMap(null);
    }

    for(i=0; i<m3.length; i++){
        m3[i].setMap(null);
    }

    for(i=0; i<m4.length; i++){
        m4[i].setMap(null);
    }
}
   
</script>
@endsection()