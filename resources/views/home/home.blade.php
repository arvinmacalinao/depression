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

            //---------------Sectors---------------------------//
            if(value.sec_id == '1' ){ //Food Processing
                 icon2 = "{{ asset('images/markers/sec_0.png') }}"
            }

            if(value.sec_id == '2' ){ //Furniture
                 icon2 = "{{ asset('images/markers/sec_1.png') }}"
            }

            if(value.sec_id == '3' ){ //Gifts / Decors / Handicrafts
                 icon2 = "{{ asset('images/markers/sec_2.png') }}"
            }

            if(value.sec_id == '4' ){ //Metals & Engineering
                 icon2 = "{{ asset('images/markers/sec_3.png') }}"
            }

            if(value.sec_id == '5' ){ //Agriculture / Marine / Agriculture / Forestry / Livestock
                 icon2 = "{{ asset('images/markers/sec_4.png') }}"
            }

            if(value.sec_id == '6' ){ //Health & Wellness Products
                 icon2 = "{{ asset('images/markers/sec_5.png') }}"
            }

            if(value.sec_id == '7' ){ //ICT
                 icon2 = "{{ asset('images/markers/sec_6.png') }}"
            }

            if(value.sec_id == '8' ){ //Halal Products & Service
                 icon2 = "{{ asset('images/markers/sec_7.png') }}"
            }

            if(value.sec_id == '9' ){ //Other Regional Insdustry Priorites
                 icon2 = "{{ asset('images/markers/sec_8.png') }}"
            }

            //---------------Status---------------------------//
            if(value.stat_id == '1' ){ //Completed
                 icon3 = "{{ asset('images/markers/stat_0.png') }}"
            }

            if(value.stat_id == '2' ){ //On-going
                 icon3 = "{{ asset('images/markers/stat_1.png') }}"
            }

            if(value.stat_id == '3' ){ //New
                 icon3 = "{{ asset('images/markers/stat_2.png') }}"
            }

            if(value.stat_id == '4' ){ //Graduated
                 icon3 = "{{ asset('images/markers/stat_3.png') }}"
            }

            if(value.stat_id == '5' ){ //Widthdrawn
                 icon3 = "{{ asset('images/markers/stat_4.png') }}"
            }

            if(value.stat_id == '6' ){ //Terminated
                 icon3 = "{{ asset('images/markers/stat_5.png') }}"
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


            mymap.addMarker({ // Marker for Status Type
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
        });
    </script>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary"><h4 class="text-light">Legends</h4></nav>
@endsection()