@extends('./layouts.app')

@section('content')
    <div id="map" style="height: 660px; width: 100%;"></div>

    <script type="text/javascript">

        var locations = <?php print_r(json_encode($locations)) ?>;


        var mymap = new GMaps({
        el: '#map',
        lat: 14.170240,
        lng: 121.831061,
        zoom:10,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        });

        
        $.each( locations, function( index, value ){

            var icon1;
            var icon2;
            var icon3;
            var icon4;
            

            if(value.prj_id == '1' ){ //Setup Icon
                 icon1 = "{{ asset('images/markers/prj_0.png') }}"
            }

            if(value.prj_id == '2' ){ //Roll-out Icon
                 icon1 = "{{ asset('images/markers/prj_1.png') }}"
            }

            if(value.prj_id == '3' ){ //Tapi Assisted Icon
                 icon1 = "{{ asset('images/markers/prj_2.png') }}"
            }

            if(value.prj_id == '4' ){ //GIA Community Based Icon
                 icon1 = "{{ asset('images/markers/prj_3.png') }}"
            }

            if(value.prj_id == '5' ){ //GIA Internally Funded
                 icon1 = "{{ asset('images/markers/prj_4.png') }}"
            }

            if(value.prj_id == '6' ){ //GIA Externally Funded
                 icon1 = "{{ asset('images/markers/prj_5.png') }}"
            }

            
            
            mymap.addMarker({
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

            mymap.addMarker({
                lat: value.prj_lat,
                lng: value.prj_long,
                icon: "{{ asset('images/markers/reg_5.png') }}",
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

            mymap.addMarker({
                lat: value.prj_lat,
                lng: value.prj_long,
                icon: "{{ asset('images/markers/sec_4.png') }}",
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

            mymap.addMarker({
                lat: value.prj_lat,
                lng: value.prj_long,
                icon: "{{ asset('images/markers/stat_0.png') }}",
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

        });
    </script>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary"><h4 class="text-light">Legends</h4></nav>
@endsection()