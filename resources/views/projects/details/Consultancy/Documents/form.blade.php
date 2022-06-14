@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header"><div class="pull-right">
                <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
            </div>
            <div class="pull-left">
                <h3>Packaging & Labeling Designs (Upload)</h3>
                <h3>
                    Product Name : {{ $packaging->pkg_product_name }}
                    @if ($packaging->pkg_product_name > 0){
                        <br>
                        Brand Name :  {{ $packaging->pkg_brand_name }}
                    }    
                    @endif
                </h3>
                <p> 
                    Encoded on {{ date('m/d/Y h:i:s a',strtotime($packaging->date_encoded))  }} by {{ $packaging->encoder }} <br>
                    Last updated {{ date('m/d/Y h:i:s a',strtotime($packaging->date_encoded))  }} by {{ $packaging->encoder }}   
                </p>
            </div>
        <h3>Packaging & Labeling Designs (Upload)
            
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Design Save', ['id' => $id, 'pack_id' => $pack_id, 'des_id' => $des_id]) }}" method="POST" files="true" enctype="multipart/form-data">
            @csrf
            <div class="form-group form-group-sm">
                    <label for="draftlevel_id" class="control-label"><strong>Draft Level</strong></label>
                    <select class="form-control input-sm" id="draftlevel_id" name="draftlevel_id">
                    @foreach ($sel_drafts as $draft)
                        <option value="{{ $draft->draftlevel_id }}" {{ old('draftlevel_id', $design->draftlevel_id) == $draft->draftlevel_id ? 'selected' : '' }}>{{ $draft->draftlevel_name }}</option>           
                    @endforeach
                    </select>
            </div>
            <div class="form-group form-group-sm">
                <label for="design_image1" class="control-label"><strong>Design (Original)</strong></label>
                @if ($design->design_image1 != NULL)
                    <a href="{{ $design->photo1() }}" target="_blank" title="Current Design"><span class="fa fa-file-image-o"></span> Current Design</a><br>
                @endif
                <input class="form-control input-sm" placeholder="Design (Original)" name="design_image1" id="design_image1" type="file" accept="">
            </div>
            <div class="form-group form-group-sm">
                <label for="design_image2" class="control-label"><strong>Design (Commented)</strong></label>
                @if ($design->design_image2 != NULL)
                    <a href="{{ $design->photo2() }}" target="_blank" title="Current Design"><span class="fa fa-file-image-o"></span> Current Design</a><br>
                @endif
                <input class="form-control input-sm" placeholder="Design (Commented)" name="design_image2" id="design_image2" type="file" accept="">
            </div>
            <div class="form-group form-group-sm">
                <label for="design_description" class="control-label"><strong>Description</strong></label>
                <textarea class="form-control input-sm" placeholder="Description" name="design_description" id="design_description" cols="50" rows="10">{{ old('design_description', $design->design_description) }}</textarea>
            </div>
            <input class="save-btn" type="submit" name="save" id="save" value="Save">
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