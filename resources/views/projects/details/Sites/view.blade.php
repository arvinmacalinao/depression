@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header">                  
        <h3>Equipment View
            <div class="pull-right">
                <a href="" class="projectdetails-btn pr"><span class="fa fa-plus"></span> Edit</a>
                {{-- {{ route('New Product', $project->prj_id) }} --}}
            </div>
        </h3>
    </div>
    
</div>
<script>
   
</script>
@endsection