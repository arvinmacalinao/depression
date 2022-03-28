// Initialize and add the map
function initMap() {
    const myLatlng = { lat: 14.171, lng: 121.223 };
    const myOptions = { 
        zoom: 16,
  
        center: myLatlng,
      }
    map = new google.maps.Map(document.getElementById("map"), myOptions);
    
    // marker refers to a global variable
    marker = new google.maps.Marker({
          map: map
  
    });
  
    google.maps.event.addListener(map, "click", function(event) {
      if (marker && marker.setMap) {
        marker.setMap(null);
      }
        // get lat/lon of click
        
        clickLat = event.latLng.lat();
        clickLon = event.latLng.lng();
        
        // show in input box
        document.getElementById("lat").value = clickLat.toFixed(10);
        document.getElementById("lon").value = clickLon.toFixed(10);
  
        
                marker = new google.maps.Marker({
                position: new google.maps.LatLng(clickLat,clickLon),
                icon: 'images/icon_projects.png',
                map: map
             });
    });
    
  }   
  
  window.onload = function () { initMap() }