$( document ).ready(function() {
    
    document.getElementById("mpFilter").style.display = "none";

    $(".close").on('click', function(event){
        document.getElementById("mpFilter").style.display = "none";
    });
});