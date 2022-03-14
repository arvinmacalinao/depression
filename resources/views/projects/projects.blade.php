@extends('./layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header container-fluid">
            <h3>Projects</h3>
            <div class="pull-right">
            <a id="print-list-btn" name="print-list-btn" class="btn btn-success btn-sm" href="" title="Print List"><span class="fa fa-print"></span> Print</a>
            <a id="download-list-btn" name="download-list-btn" class="btn btn-success btn-sm" href="" title="Download List"><span class="fa fa-floppy-o"></span> Download</a>
            <a class="btn btn-primary btn-sm" href="./addproject" title="Add Projects"><span class="fa fa-plus"></span> Add Projects</a>
            </div>
        </div>
        <div class="card-body">
            <form action="">
                <div class="form-row">
                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Project Type</div>
                          </div>
                        <select class="form-control input-sm" id="qtype" name="qtype">
                            <option>{{ $psi_projects->project_type_name }}</option>
                            
                        </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Status</div>
                          </div>
                          <select class="form-control input-sm" id="qstatus" name="qstatus">
                            <option>All</option>
                            <option>Completed</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Year Approved</div>
                          </div>
                          <select class="form-control input-sm" id="qyear" name="qyear">
                            <option>All</option>
                            <option>2011</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Province</div>
                          </div>
                          <select class="form-control input-sm region_provinces_select" id="qprovince" name="qprovince">
                            <option>All</option>
                            <option>2011</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Disctrict</div>
                          </div>
                          <select class="form-control input-sm" id="qdistrict" name="qdistrict">
                            <option>All</option>
                            <option>2011</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Sector</div>
                          </div>
                          <select class="form-control input-sm" id="qsector" name="qsector">
                            <option>All</option>
                            <option>Agriculture / Marine / Aquaculture / Forestry / Livestock</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Implementor</div>
                          </div>
                          <select class="form-control input-sm region_groups_select" id="qusergroup" name="qusergroup">
                            <option>All</option>
                            <option>RO-Document Custodian</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Search text..">
                            <button type="button" class="btn search-btn">Search</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-3">
                    Total No of Projects: {{ $psi_project->total() }}
                </div>
                <div class="col-sm-5"></div>
                <div class="col-sm-4">
                    {{ $psi_project }}
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-proj">
                            <tr class="">
                                <th></th>
                                <th>#</th>
                                <th>Code</th>
                                <th>Project</th>
                                <th>Type</th>
                                <th>Year Approved</th>
                                <th>Beneficiaries</th>
                                <th>Collaborators</th>
                                <th>Sector</th>
                                <th>Region</th>
                                <th>Province</th>
                                <th>District</th>
                                <th>Status</th>
                                <th>Project Cost</th>
                                <th>Amount Due</th>
                                <th>Refunded</th>
                                <th>Refund Rate</th>
                                <th>Implementor </th>
                            </tr>
                    </thead>
                            @foreach($psi_project as $data)
                            <tr>
                                <td></td>
                                <td class="counterCell"></td>
                                <td>{{$data->prj_id}}</td>
                                <td>{{$data->prj_title}}</td>
                                <td>{{$data->prj_type_name}}</td>
                                <td>{{$data->prj_year_approved}}</td>
                                <td>{{$data->coop_names}}</td>
                                <td>{{$data->collaborator_names}}</td>
                                <td>{{$data->sector_name}}</td>
                                <td>{{$data->region_code}}</td>
                                <td>{{$data->province_name}}</td>
                                <td>{{$data->city_name}}</td>
                                <td>{{$data->district_name}}</td>
                                <td>{{$data->prj_status_name}}</td>
                                <td>Php {{ $data->prj_cost_setup}}</td>
                                <td>{{$data->rep_total_due}}</td>
                                <td>{{$data->rep_refund_rate}}</td>
                                <td>{{$data->ug_name}}</td>
                            </tr>
                            @endforeach
                        </table>
                </div>
            </div>
            
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-3">
                    Total No of Projects: {{ $psi_project->total() }}
                </div>
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    {{ $psi_project }}
                </div>
            </div>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th class="text-center">Total Project Cost</th>
                <th class="text-center">Total Amount Due</th>
                <th class="text-center">Total Amount Refunded</th>
                <th class="text-center">Refund Rate</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
            <tr>
            </tbody>
        </table>
        </div>
    </div>
    </div>



@endsection()