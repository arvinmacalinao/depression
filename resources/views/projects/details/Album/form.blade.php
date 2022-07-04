@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@if(Session::has('message'))
<div class="alert alert-success mt-2" role="alert">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>{{ Session::get('message') }}</strong>
</div>
@endif
@include('projects.details.details')
<div class="card">
    <div class="card-header">
        <h3>Projects Packaging & Labeling (Add)
            <div class="pull-right">
                <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Project Album Save', ['id' => $id, 'album_id' => $album_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group form-group-sm">
                <label for="album_type_id" class="control-label">Category</label>
                <select class="form-control input-sm" id="album_type_id" name="album_type_id">
                    @foreach ($sel_types as $type)
                        <option value="{{ $type->album_type_id }}" {{ old('album_type_id', $album->album_type_id) == $type->album_type_id ? 'selected' : '' }}>{{ $type->album_type_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="album_name" class="control-label">Album Name *</label>
                <input class="form-control input-sm" placeholder="Album Name" required="required" name="album_name" id="album_name" type="text" value="{{ old('album_name', $album->album_name) }}">
            </div>
            <div class="form-group">
                <label for="album_desc" class="control-label">Description *</label>
                <textarea class="form-control input-sm" placeholder="Description" required="required" name="album_desc" id="album_desc" cols="50" rows="4">{{ old('album_desc', $album->album_desc) }}</textarea>
            </div>
            <div class="form-group">
                <label for="album_event_date" class="control-label">Date *</label>
                <input class="form-control input-sm date-picker" placeholder="Date" maxlength="10" required="required" name="album_event_date" id="album_event_date" type="text" value="{{ old('album_event_date', $album->album_event_date) }}">
            </div>
            <div class="form-group">
                <label for="album_photos" class="control-label">Photos *</label><br>
                <input class="form-control input-sm" placeholder="Photos" name="album_photos[]" id="album_photos" type="file" accept="image/*" multiple="multiple">
            </div>
            @if ($album_id != 0)
            <div class="card">
                <div class="card-header"><label>Current Photos</label></div>
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        @foreach ($photos as $photo)
                            <div class="img_box_wrapper clearfix">
                                <div class="img_box text-center">
                                    <div class="img_box_clipper">
                                            <img class="img_box_thumbnail" href="" src="{{ $photo->albumphotos() }}" alt="">
                                    </div>      
                                </div>           
                            </div>&nbsp;
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
           
            <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">
        </form>
    </div>
</div>
<script type="text/javascript"> 
    $(document).ready(function() {

    $('.date-picker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayBtn: true,
        todayHighlight: true
    });
});


</script>
@endsection