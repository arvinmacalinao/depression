function initialize() { // Initialize Google Maps
    mymap = new GMaps({
    el: '#map',
    lat: 14.170240,
    lng: 121.831061,
    zoom:11,
    streetViewControl: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControl: false,
    controls: google.maps.ControlPosition.TOP_CENTER
    });  
    
    addMarkers();

}

function addMarkers(){ // Adding Customized Markers after google maps initialization
    $.each( locations, function( index, value ){

    var icon1;
    var icon2;
    var icon3;
    var icon4;
    var imagePath = "./images/markers/"


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


    mymap.addMarker({ // Marker for Project Type
        lat: value.prj_lat,
        lng: value.prj_long,
        icon: icon1,
        infoWindow: {
            content: value.project_name,
        },
        mouseover: function() {
            this.infoWindow.open(this.mymap, this);
        },
        mouseout: function() {
            this.infoWindow.close();
        }
    });

    setTimeout(() => {
        mymap.addMarker({ // Marker for Sector Type
        lat: value.prj_lat,
        lng: value.prj_long,
        icon: icon2,
        infoWindow: {
            content: value.project_name,
        },
        mouseover: function() {
            this.infoWindow.open(this.mymap, this);
        },
        mouseout: function() {
            this.infoWindow.close();
        }
    });             
    }, 500);




    setTimeout(() => {
        mymap.addMarker({ // Marker for Sector Type
        lat: value.prj_lat,
        lng: value.prj_long,
        icon: icon3,
        infoWindow: {
            content: value.project_name,
        },
        mouseover: function() {
            this.infoWindow.open(this.mymap, this);
        },
        mouseout: function() {
            this.infoWindow.close();
        }
    });             
    }, 600);

    setTimeout(() => {
        mymap.addMarker({ // Marker for Sector Type
        lat: value.prj_lat,
        lng: value.prj_long,
        icon: icon4,
        infoWindow: {
            content: value.project_name,
        },
        mouseover: function() {
            this.infoWindow.open(this.mymap, this);
        },
        mouseout: function() {
            this.infoWindow.close();
        }
    });             
    }, 650);
});
}