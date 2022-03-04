@extends('./layouts.app')

@section('content')
<div id="map_canvas">
    <div id="map" style="height: 660px; width: 100%;"></div>
</div>
<script type="text/javascript">
        var locations = <?php print_r(json_encode($locations)) ?>;
        google.maps.event.addDomListener(window, 'load', initialize);
        var mymap
</script>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary"><h4 class="text-light">Legends</h4></nav>
@endsection()