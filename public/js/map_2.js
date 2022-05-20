// Initialize and add the map
function initMap() {
    const myLatlng = { lat: 14.171, lng: 121.223 };
    const lat =  parseFloat(document.getElementById("prj_latitude").value);
    const lng =  parseFloat(document.getElementById("prj_longitude").value);
    const proj_latlng = { lat:lat , lng: lng }
    const myOptions = { 
      zoom: 16,
      center: myLatlng,
    }
    const myOptions2 = { 
      zoom: 16,
      center: proj_latlng,
    }
    
    if(isNaN(lat) == true || isNaN(lat) == true){
      map = new google.maps.Map(document.getElementById("map"), myOptions);
    }
    else{
      map = new google.maps.Map(document.getElementById("map"), myOptions2);
    }
    
    
    
    // marker refers to a global variable
    
    marker = new google.maps.Marker({
          position: { lat: parseFloat(document.getElementById("prj_latitude").value), lng: parseFloat(document.getElementById("prj_longitude").value) },
          map: map,
          icon: '/images/icon_projects.png',
    });

    google.maps.event.addListener(map, "click", function(event) {
      if (marker && marker.setMap) {
        marker.setMap(null);
      }
        // get lat/lon of click
        
        clickLat = event.latLng.lat();
        clickLon = event.latLng.lng();
        
        // show in input box
        document.getElementById("prj_latitude").value = clickLat.toFixed(10);
        document.getElementById("prj_longitude").value = clickLon.toFixed(10);
  
        
                marker = new google.maps.Marker({
                position: new google.maps.LatLng(clickLat,clickLon),
                icon: '/images/icon_projects.png',
                map: map
             });
    });
  }   
  
  



  