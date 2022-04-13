@extends('./layouts.app')

@section('content')
@foreach ($project_views as $project_view)
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="m-0">
                <strong>PIN: </strong><span class="project-title">{{ $project_view->prj_code }}</span><br>
                <strong>Project Title: </strong><span class="project-title">{{ $project_view->prj_title }}</span><br>
                <small class="project-type" style="margin-top: 0%">({{ $prj_title }} Project)</small>
            </h4>
            <p> 
                Beneficiaries: @foreach ($get_benefeciaries as $get_benefeciary)
                {{ $get_benefeciary->coop_name }}
                            @endforeach
                <br>
                Project Encoded on {{ $project_view->date_encoded  }} by {{ $project_view->encoder }}            
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>Project Details
                <div class="pull-right">
                    <a href="" class="projectdetails-btn pr"><i class="fa fa-pencil-square-o"></i> Edit Details</a>
                </div>
            </h3>
                
        </div>
        <div class="card-body">
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-3 pl-1">
                    <label for="prj_code" class="control-label"><strong>Project</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_code" readonly value="{{ $project_view->prj_code }}">
                </div>
                <div class="form-group col-3 pl-1">
                    <label for="qsector" class="control-label"><strong>Sector</strong></label>
                    <input type="text" class="form-control-viewproj" id="qsector" readonly value="{{ $get_sector_name }}">
                </div>
                <div class="form-group col-3 pl-1">
                    <label for="prj_year_approved" class="control-label"><strong>Year Approved</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_year_approved" readonly value="{{ $project_view->prj_year_approved }}">
                </div>
                <div class="form-group col-3 pl-1">
                    <label for="prj_status_id" class="control-label"><strong>Status</strong></label>
                    <input type="text" class="form-control-viewproj" id="prj_status_id" readonly value="{{ $get_status_name }}">
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-6 pl-1">
                    <label for="coop_names" class="control-label"><strong>Benefeciaries</strong></label>
                    <input type="text" class="form-control-viewproj" id="coop_names" readonly value="{{ $project_view->coop_names }}">
                </div>
                <div class="form-group col-6 pl-1">
                    <label for="collaborator_names" class="control-label"><strong>Collaborating Agencies</strong></label>
                    <input type="text" class="form-control-viewproj" id="collaborator_names" readonly value="{{ $project_view->collaborator_names }}">
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-6 pl-1">
                    <label for="prj_objective" class="control-label"><strong>Expected Output</strong></label>
                    <textarea class="form-control-viewproj" rows="5" id="prj_objective" readonly>{{ $project_view->prj_objective }}</textarea>
                </div>
                <div class="form-group col-6 pl-1">
                    <label for="prj_expected_output" class="control-label"><strong>Objectives</strong></label>
                    <textarea class="form-control-viewproj"  rows="5" id="prj_expected_output" readonly>{{ $project_view->prj_expected_output }}</textarea>
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-12 pl-1">
                    <label for="ug_name" class="control-label"><strong>Implementor</strong></label>
                    <input type="text" class="form-control-viewproj" rows="5" id="ug_name" readonly value="{{ $get_ug_name }}">
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <div class="form-group col-12 pl-1">
                    <label for="prj_fund_release_date" class="control-label"><strong>Date Funds Released To The Beneficiary</strong></label>
                    <input type="text" class="form-control-viewproj" rows="5" id="prj_fund_release_date" readonly value="{{ $project_view->prj_fund_release_date }}">
                </div>
            </div>
            <div class="row ml-0 pl-0 mb-3">
                <h5>Pre-PIS</h5>
            </div>
            
            
            
        </div>
    </div>
</div>
@endforeach
@endsection