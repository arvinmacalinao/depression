$( document ).ready(function() {
    
    document.getElementById("mpFilter").style.display = "none";

    $("#mf_close").on('click', function(event){
        document.getElementById("mpFilter").style.display = "none";
    });
});
// Initialize and add the map
function initMap() {
    // The location of Uluru
    const uluru = { lat: 14.171, lng: 121.223 };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 16,
      center: uluru,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
      position: uluru,
      map: map,
    });
  }
