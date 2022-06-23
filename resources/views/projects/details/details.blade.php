<div class="card">
    <div class="card-header">
        <h4 class="m-0">
            <strong>PIN: </strong><span class="project-title">{{ $project->prj_code }}</span><br>
            <strong>Project Title: </strong><span class="project-title">{{ $project->prj_title }}</span><br>
            <small class="project-type" style="margin-top: 0%">({{ $project->type->prj_type_name }} Project)</small>
        </h4>
        <p> 
            Beneficiaries: @foreach ($project->ProjectBeneficiary as $get_beneficiaries)
            {!! $get_beneficiaries->cooperator->coop_name !!}, 
                        @endforeach
            <br>
            Project Encoded on {{ date('m/d/Y h:i:s a',strtotime($project->date_encoded))  }} by {{ $project->encoder }}            
        </p>
        <div class="project_nav">
            <a class="projectdetails-btn pr" href="{{ route('View Project', $project->prj_id) }}">Project Details</a>
            <a class="projectdetails-btn pr" href="{{ route('PIS', $project->prj_id) }}">PIS</a>
            <a class="projectdetails-btn pr" href="{{ route('Product', $project->prj_id) }}">Products</a>
            @if ($project->prj_type_id == 6 || $project->prj_type_id == 12)
            <a class="projectdetails-btn pr" href="">Monitoring*</a>
            @endif
            @if($project->prj_type_id == 8 || $project->prj_type_id == 9 || $project->prj_type_id == 13 || $project->prj_type_id == 14)
            <a class="projectdetails-btn pr" href="">Monitoring*</a>
            @endif
            <a class="projectdetails-btn pr" href="{{ route('Equipment', $project->prj_id) }}">Equipment</a>
            <a class="projectdetails-btn pr" href="{{ route('Calibration', $project->prj_id) }}">Testings & Calibrations</a>
            <a class="projectdetails-btn pr" href="{{ route('Packaging', $project->prj_id) }}">Packaging & Labeling</a>
            <a class="projectdetails-btn pr" href="{{ route('Consultancy', $project->prj_id) }}">Consultancies</a>
            <a class="projectdetails-btn pr" href="{{ route('Project Training', $project->prj_id) }}">Fora/Trainings/Seminars</a>
            <a class="projectdetails-btn pr" href="">Repayment*</a>
            <a class="projectdetails-btn pr" href="">Liquidation*</a>
            <a class="projectdetails-btn pr" href="{{ route('SATS', $project->prj_id) }}">S & T Interventions</a>
            <a class="projectdetails-btn pr" href="{{ route('Project Documentation', $project->prj_id) }}">Documentation</a>
            <a class="projectdetails-btn pr" href="">Photos*</a>
            <a class="projectdetails-btn pr" href="">Legal*</a>
        </div>
    </div>
</div>
