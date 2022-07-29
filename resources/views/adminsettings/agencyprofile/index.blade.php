@extends('./layouts.app', ['title' => 'Agency Profile'])

@section('content')
<div class="container-fluid">
    <div class="card mt-3">
    @foreach($sel_profiles as $sel_profile)
    <div class="card-header">
        <h2>Agency Profile</h2>
        <h2 class="text-primary">{!! $sel_profile->agency_name !!}</h2>
    </div>
    <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    </div>
    @endforeach
</div>
@endsection