<div class="card">
    <div class="card-header">
        <h4 class="m-0">
            <strong>PIN: </strong><span class="project-title">{{ $project->prj_code }}</span><br>
            <strong>Project Title: </strong><span class="project-title">{{ $project->prj_title }}</span><br>
            <small class="project-type" style="margin-top: 0%">({{ $project->type->prj_type_name }} Project)</small>
        </h4>
        <p> 
            Beneficiaries: @foreach ($project->ProjectBeneficiary as $get_beneficiaries)
            {{ $get_beneficiaries->cooperator->coop_name }}, 
                        @endforeach
            <br>
            Project Encoded on {{ date('m/d/Y h:i:s a',strtotime($project->date_encoded))  }} by {{ $project->encoder }}            
        </p>
        <div class="project_nav">
            <a class="projectdetails-btn pr" href="{{ route('View Project', $project->prj_id) }}">Project Details</a>
            <a class="projectdetails-btn pr" href="{{ route('PIS', $project->prj_id) }}">PIS</a>
        </div>
    </div>
</div>