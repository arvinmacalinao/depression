@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header mb-0 pb-0" >
        <div class="pull-right">
            <a href="{{ route('New Project Album', $project->prj_id) }}" class="projectdetails-btn pr"><span class="fa fa-plus"></span> Add Album</a>
            <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
        </div>
        <h3><strong>Project Photos</strong></h3>
        <h4 class="m-0">
            <span class="project-title"><strong>{{ $album->album_name }}</strong></span><br>
        </h4>
        <p>
            <small>
                <span class="label label-success">{{ $album->type->album_type_name }}</span><br>
                Encoded on {{ date('m/d/Y h:i:s a',strtotime($album->date_encoded))  }} by {{ $album->encoder }} <br>
                Last updated {{ date('m/d/Y h:i:s a',strtotime($album->date_encoded))  }} by {{ $album->encoder }} 
            </small>
        </p>
        <p> {!!  nl2br(e($album->album_desc))  !!}</p>
       
    </div>                
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-wrap">
                @foreach ($photos as $photo)
                    <div class="img_box_wrapper clearfix">
                        <div class="img_box text-center">
                            <div class="img_box_clipper">
                                <a href="{!! Storage::url('uploads/images/'.$photo->photo_file) !!}" target="_blank"><img class="img_box_thumbnail" src="{{ $photo->albumphotos() }}" alt=""></a>
                            </div>      
                        </div>           
                    </div>&nbsp;
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
   
</script>
@endsection