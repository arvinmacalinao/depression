@extends('./layouts.app')

@section('content')
<form>
<div class="container-fluid">
    <div class="card">
        <h3 class="card-header">Add Project</h3>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Project Code *</label>
                        <input class="form-control input-sm" placeholder="Project Code" maxLength="255" required="required"></input>
                    </div>
                    <div class="col-sm-3">
                        <label>Project Type</label>
                        <select class="form-control input-sm project-type-select">
                            <option>SETUP</option>
                            <option>Roll-out</option>
                            <option>TAPI-assisted</option>
                            <option>GIA (Community Based)</option>
                            <option>GIA (Region-initiated Projects) Internally Funded</option>
                            <option>GIA (Region-initiated Projects) Externally Funded</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label>Year Approved *</label>
                        <input class="form-control input-sm" placeholder="Year Approved" maxLength="4" min="1958" max="2022" required="required" type="number" defaultValue="2022"></input>
                    </div>
                    <div class="col-sm-2 mt-3">
                        <div >
                            <input type="checkbox"/> Startup Assistance
                        </div>
                    </div>
                    <div class="col-sm-2 mt-3">
                        <div >
                        <input type="checkbox"/> DRRM Related
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container-fluid">
                        <label class="control-label">Project Title *</label>
                        <input class="form-control" placeholder="Project Title" maxLength="255" required="required"></input>
                    </div>
                </div>
                <div class="row">
                <div class="form-group col-sm-6">
                    <label class="control-label">Project Duration From *</label>
                    <input class="form-control input-sm" placeholder="Project Duration From" maxLength="10" required="required" name="prj_duration_from" id="prj_duration_from" type="text" value="02/21/2022"></input>
                </div>

                <div class="form-group col-sm-6">
                    <label class="control-label">Project Duration To *</label>
                    <input class="form-control input-sm" placeholder="Project Duration To" maxLength="10"  required="required" name="prj_duration_to" id="prj_duration_to" type="text" value="02/21/2023"></input>
                </div>

                </div>
            </div>
    </div>
</div>
</form>





@endsection()