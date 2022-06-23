@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header mb-0 pb-0" >
        <div class="pull-right">
            {{-- {{ route('Designs', ['id' => $project->prj_id, 'pack_id' => $packaging->pkg_id]) }} --}}
            <a class="projectdetails-btn" href="{{ route('Edit Project Training', ['id' => $project->prj_id, 'fr_id' => $training->fr_id]) }}" title="Edit"><span class="fa fa-pencil-square-o"></span> Edit Training</a>
            <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
        </div>
        <h3><strong>Project Fora/Trainings/Seminars Details</strong></h3>
        <h4 class="m-0">
            <span class="project-title"><strong>{{ $training->fr_title }}</strong></span><br>
        </h4>
        <p class="pt-2">
            Encoded on {{ date('m/d/Y h:i:s a',strtotime($training->date_encoded))  }} by {{ $training->encoder }}<br>
            Last updated {{ date('m/d/Y h:i:s a',strtotime($training->date_encoded))  }} by {{ $training->encoder }} 
        </p>
    </div>
    <div class="card-body">
        <div class="row ml-0 pl-0">
            <div class="form-group col-6 pl-1">
                <label for="fr_requesting_party" class="control-label"><strong>Requesting Party/Address</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_requesting_party" readonly value="{{ $training->fr_requesting_party }}">
            </div>
            <div class="form-group col-6 pl-1">
                <label for="collaborator_names" class="control-label"><strong>Cooperating Agencies</strong></label>
                <input type="text" class="form-control-viewproj" id="collaborator_names" readonly value="{{ $training->collaborator_names }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="fr_sectors" class="control-label"><strong>Sector</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_sectors" readonly value="{{ $training->fr_sectors }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-6 pl-1">
                <label for="fr_start" class="control-label"><strong>Forum Start</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_start" readonly value="{{ date('m/d/Y h:i a',strtotime($training->fr_start))  }}">
            </div>
            <div class="form-group col-6 pl-1">
                <label for="fr_end" class="control-label"><strong>Forum End</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_end" readonly value="{{ date('m/d/Y h:i a',strtotime($training->fr_end))  }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="fr_location" class="control-label"><strong>Venue</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_location" readonly value="{{ $training->fr_location }}">
                {{-- {!!  nl2br(e($equipment->eqp_specs)) !!} --}}
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-6 pl-1">
                <label for="fr_csf" class="control-label"><strong>Overall CSF Rating</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_csf" readonly value="{{ $training->fr_csf }}">
            </div>
            <div class="form-group col-6 pl-1">
                <label for="fr_cost" class="control-label"><strong>Forum Cost</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_cost" readonly value="Php {{ number_format($training->fr_cost,2) }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="ug_id" class="control-label"><strong>Implementor</strong></label>
                <input type="text" class="form-control-viewproj" id="ug_id" readonly value="{{ $training->usergroup->ug_name }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-group col-12 pl-1">
                <label for="eqp_amount_acquired" class="control-label"><strong>Remarks</strong></label>
                <textarea class="form-control-viewproj" name="fr_remarks" id="fr_remarks" readonly>{{ $training->fr_remarks }}</textarea>
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-groupd col-12 pl-1">
                <p class="font-weight-bold text-light bg-secondary p-1"> Participant Demographics</p>
            </div>
        </div>
        <div class="row ml-3 mr-3 pl-0">
            <div class="form-group col-6 pl-1">
                <label for="fr_no_feminine" class="control-label"><strong>No. of Female Participants</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_no_feminine" readonly value="{{ $training->fr_no_feminine }}">
            </div>
            <div class="form-group col-6 pl-1">
                <label for="fr_no_masculine" class="control-label"><strong>No. of Male Participants</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_no_masculine" readonly value="{{ $training->fr_no_masculine }}">
            </div>
        </div>
        <div class="row ml-3 mr-3 pl-0">
            <div class="form-group col-6 pl-1">
                <label for="fr_no_pwd" class="control-label"><strong>No. of PWD Participants</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_no_pwd" readonly value="{{ $training->fr_no_pwd }}">
            </div>
            <div class="form-group col-6 pl-1">
                <label for="fr_no_seniors" class="control-label"><strong>No. of Senior Participants</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_no_seniors" readonly value="{{ $training->fr_no_seniors }}">
            </div>
        </div>
        <div class="row ml-3 mr-3 pl-0">
            <div class="form-group col-6 pl-1">
                <label for="fr_no_participants" class="control-label"><strong>No. of Participating Firms</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_no_participants" readonly value="{{ $training->fr_no_participants }}">
            </div>
            <div class="form-group col-6 pl-1">
                <label for="fr_no_participants" class="control-label"><strong>Total No. of Participants</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_no_participants" readonly value="{{ $training->fr_no_participants }}">
            </div>
        </div>
        <div class="row ml-0 pl-0">
            <div class="form-groupd col-12 pl-1">
                <p class="font-weight-bold text-light bg-secondary p-1"> Forum Map Coordinates</p>
            </div>
        </div>
        <div class="row ml-3 mr-3 pl-0">
            <div class="form-group col-4 pl-1">
                <label for="fr_longitude" class="control-label"><strong>Longitude</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_longitude" readonly value="{{ $training->fr_longitude }}">
            </div>
            <div class="form-group col-4 pl-1">
                <label for="fr_latitude" class="control-label"><strong>Latitude</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_latitude" readonly value="{{ $training->fr_latitude }}">
            </div>
            <div class="form-group col-4 pl-1">
                <label for="fr_elevation" class="control-label"><strong>Elevation</strong></label>
                <input type="text" class="form-control-viewproj" id="fr_elevation" readonly value="{{ $training->fr_elevation }}">
            </div>
        </div>
    </div>
    <div class="card-footer">

    </div>
</div>
<script>
   
</script>
@endsection