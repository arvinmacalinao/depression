@extends('./layouts.app')

@section('content')
<div class="container-fluid">
    @if(Session::has('message'))
    <div class="alert alert-warning mt-2" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ Session::get('message') }}</strong>
    </div>
    @endif
@include('projects.details.details')
<div class="card">
    <div class="card-header mb-0 pb-0" >
        <div class="pull-right">
            <a class="upload-btn" href="{{ route('New Design', ['id' => $project->prj_id, 'pack_id' => $packaging->pkg_id]) }}" title="Edit"><span class="fa fa-upload"></span> Upload Designs</a>
            <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
        </div>
        <h3><strong>Projects Packaging & Labeling Details</strong></h3>
        <h4 class="m-0">
            <strong>Product Name : </strong><span class="project-title"><strong>{{ $packaging->pkg_product_name }}</strong></span><br>
            <strong>Brand Name : </strong><span class="project-title"><strong>{{ $packaging->pkg_brand_name }}</strong></span><br>
        </h4>
        <p> 
            Encoded on {{ date('m/d/Y h:i:s a',strtotime($packaging->date_encoded))  }} by {{ $packaging->encoder }} <br>
            Last updated {{ date('m/d/Y h:i:s a',strtotime($packaging->date_encoded))  }} by {{ $packaging->encoder }}   
        </p>
    </div>
    <div class="card-body">
        @foreach ($designs as $design) 
        <div class="card">
            <div class="card-header">
                <div class="pull-right">
                    <a class="design-btn" href="{{ route('Edit Design', ['id' => $project->prj_id, 'pack_id' => $packaging->pkg_id, 'des_id' => $design->design_id]) }}" title="Edit"><span class="fa fa-pencil"></span></a>
                    <a class="design-danger-btn" href="{{ route('Delete Design', ['id' => $project->prj_id, 'pack_id' => $packaging->pkg_id, 'des_id' => $design->design_id]) }}" title="Delete"><span class="fa fa-times-circle"></span></a>
                </div>
                <h4><strong>{{ $design->draftlevels->draftlevel_name }} </strong><small>({{ date('m/d/Y h:i:s a',strtotime($design->design_date)) }})</small></h4>
                
                <div>
                    <small>{{ $design->design_description }}</small>
                </div>
            </div>
            <div class="card-body">
                <div class="img_box_wrapper clearfix">
                    @if($design->design_image1 != NULL)
                    <div class="img_box text-center">
                        Original
                        <div class="img_box_clipper">
                            <a href="{{ $design->photo1() }}" target="_blank" title="View {{ $design->design_filename1 }}">
                                <img class="img_box_thumbnail" href="" src="{{ $design->photo1() }}" alt="">
                            </a>
                        </div>                        
                        <a class="design-btn" href="{{ $design->photo1() }}" target="_blank" title="View {{ $design->design_filename1 }}"><span class="fa fa-eye"></span> View</a>
                        {{-- <a class="design-btn" href="{{ $design->photo1() }}" target="_blank" title="View {{ $design->design_filename1 }}"><span class="fa fa-eye"></span> View</a> --}}
                        {{-- <a class="design-btn" href="{{ $design->photo1() }}" target="_blank" title="View {{ $design->design_filename1 }}"><span class="fa fa-eye"></span> View</a> --}}
                    </div>
                    @endif
                    @if($design->design_image2 != NULL)
                    <div class="img_box text-center">
                        Commented
                        <div class="img_box_clipper">
                            <a href="{{ $design->photo2() }}" target="_blank" title="View {{ $design->design_filename2 }}">
                                <img class="img_box_thumbnail" src="{{ $design->photo2() }}" alt="">
                            </a>
                        </div>
                        <a class="design-btn" href="{{ $design->photo2() }}" target="_blank" title="View {{ $design->design_filename2 }}"><span class="fa fa-eye"></span> View</a>
                    </div>
                    @endif
                </div>
                

                
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
</script>
@endsection