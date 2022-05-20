@extends('./layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header container-fluid">
            <h3>Projects</h3>
            <div class="pull-right">
            <a id="print-list-btn" name="print-list-btn" class="btn btn-success btn-sm" href="" title="Print List"><span class="fa fa-print"></span> Print</a>
            
            <a id="download-list-btn" id="" name="download-list-btn" class="btn btn-success btn-sm" title="Download List"><span class="fa fa-floppy-o"></span> Download</a>
            
            <a class="btn btn-primary btn-sm" href="{{ route('New Project') }}" title="Add Projects"><span class="fa fa-plus"></span> Add Projects</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('Projects') }}" method="GET" autocomplete="off">
                <div class="form-row">
                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Project Type</div>
                          </div>
                            
                                <select class="form-control input-sm type-select" id="type" name="type">
                                    <option value="">ALL</option>
                                    @foreach ($sel_project_types as $sel_project_type)
                                    <option value="{{ $sel_project_type->prj_type_id}}">{{ $sel_project_type->prj_type_name }}</option>
                                    @endforeach
                                </select>
                            
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Status</div>
                          </div>
                          <select class="filter-select form-control input-sm" id="qstatus" name="qstatus">
                            <option value="">ALL</option>
                            @foreach ($sel_project_statuses as $sel_project_status)
                            <option value="{{ $sel_project_status->prj_status_id }}">{{ $sel_project_status->prj_status_name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Year Approved</div>
                          </div>
                          <select class="form-control input-sm" id="qyear" name="qyear">
                            <option value="">ALL</option>
                            @foreach ($sel_project_years as $sel_project_year)
                            <option value="{{ $sel_project_year->prj_year_approved }}">{{ $sel_project_year->prj_year_approved }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Province</div>
                          </div>
                          <select class="form-control input-sm region_provinces_select" id="qprovince" name="qprovince">
                            <option value="">All</option>
                            @foreach ($sel_project_provinces as $sel_project_province)
                            <option value="{{ $sel_project_province->province_id }}">{{ $sel_project_province->province_name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Disctrict</div>
                          </div>
                          <select class="form-control input-sm" id="qdistrict" name="qdistrict">
                            <option value="">All</option>
                            @foreach ($sel_project_districts as $sel_project_district)
                            <option value="{{ $sel_project_district->district_id }}">{{ $sel_project_district->district_name }}</option>
                            @endforeach
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
                            <option value="">All</option>
                            @foreach ($sel_project_sectors as $sel_project_sector)
                            <option value="{{ $sel_project_sector->sector_id }}">{{ $sel_project_sector->sector_name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Implementor</div>
                          </div>
                          <select class="form-control input-sm region_groups_select" id="qusergroup" name="qusergroup">
                            <option value="">All</option>
                            @foreach ($sel_project_implementors as $sel_project_implementor)
                            <option value="{{ $sel_project_implementor->ug_id }}">{{ $sel_project_implementor->ug_name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group ml-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" name="search" id="search" class="form-control" value ="{{ old('search', $project_search) }}" placeholder="Search...">
                            <input type="Submit" class="btn btn-primary btn-sm rounded-0">
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-12">
                    <div class="pull-right mt-2">{{  $psi_projects->appends(Request::all())->links() }}</div>
                    
                    {{-- {{ $psi_projects->appends(Request::only('search'))->links('vendor.pagination.bootstrap-4') }} --}}
                </div>
                <div class="col-sm-12">
                    <p>Total No. of Records: <Strong>{{ $psi_projects->total() }}</Strong></p>
                </div>
            </div>
        </div>
        <div class="alert alert-warning" role="alert">
            <p class="mt-2">Please don't enclose the project title with single or double quotes.<br>Please update the project duration dates.</p>
        </div>
        <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="mydatatable" style="width: 100%" class="table table-bordered table-hover pb-0 mb-0">
                            <thead>
                            <tr>
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
                                <th>City</th>
                                <th>District</th>
                                <th>Status</th>
                                <th>Project Cost</th>
                                <th>Amount Due</th>
                                <th>Refunded</th>
                                <th>Refund Rate</th>
                                <th>Implementor </th>
                            </tr>
                            </thead>
                            @foreach($psi_projects as $psi_project)
                            <tr>
                                <td>
                                    <a href="{{ route('View Project', $psi_project->prj_id) }}" class="project-btn mr-1" title="View"><i class="fa fa-folder-open-o"></i></a>
                                    <a href="{{ route('Edit Project', $psi_project->prj_id) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="{{ route('Delete Project', $psi_project->prj_id) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                </td>
                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                <td>{{ ++$i }}</td>
                                <td>{{$psi_project->prj_code}}</td>
                                <td class="text-wrap">{{$psi_project->prj_title}}</td>
                                <td class="text-wrap">{{$psi_project->type->prj_type_name}}</td>
                                <td>{{$psi_project->prj_year_approved}}</td>
                                <td class="text-wrap">
                                @foreach ($psi_project->ProjectBeneficiary as $coop)
                                {{$coop->cooperator->coop_name}}, 
                                @endforeach
                                </td>
                                <td class="text-wrap">
                                @foreach ($psi_project->ProjectCollaborator as $col)
                                {{$col->collaborator->col_name}}, 
                                @endforeach
                                </td>
                                <td class="text-wrap">{{$psi_project->sector->sector_name}}</td>
                                <td>{{$psi_project->region->region_code}}</td>
                                
                                <td>{{$psi_project->province->province_name}}</td>
                                <td class="text-wrap">{{$psi_project->city->city_name}}</td>
                                <td class="text-wrap">{{$psi_project->city->district->district_name}}</td>
                                <td>{{$psi_project->status->prj_status_name}}</td>
                                <td>Php {{ number_format($psi_project->prj_cost_setup, 2) }}</td>
                                <td>Php {{ number_format($psi_project->rep_total_due, 2) }}</td>
                                <td>Php {{ number_format($psi_project->rep_total_paid, 2) }}</td>
                                <td>{{$psi_project->rep_refund_rate}}</td>
                                <td>{{$psi_project->usergroup->ug_name}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>    
        </div>
    <div class="card-footer">
            <div class="row">
                <div class="col-sm-12">
                    <div class="pull-right">{{  $psi_projects->appends(Request::all())->links() }}</div>
                    
                    {{-- {{ $psi_projects->appends(Request::only('search'))->links('vendor.pagination.bootstrap-4') }} --}}
                </div>
                <div class="col-sm-12">
                    <p>Total No. of Records: <Strong>{{ $psi_projects->total() }}</Strong></p>
                </div>
                    {{-- {{ $psi_projects->appends(Request::only('search'))->links('vendor.pagination.bootstrap-4') }} --}}
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
                <td class="text-center">Php {{ number_format($sum_prj_cost_setup,2) }}</td>
                <td class="text-center" id="rep_amount">Php {{ number_format($sum_rep_total_due,2) }}</td>
                <td class="text-center" id="rep_paid">Php {{ number_format($sum_rep_total_paid,2) }}</td>
                <td class="text-center" id="percent_yeah">{{($sum_rep_refund_rate) }}</td>
            <tr>
            </tbody>
        </table>
        </div>
    </div>
    </div>
<script>
var t =  $('#mydatatable').DataTable({
        deferRender:    true,
        searching:      false,
        paging:         false,
        orderable:      false,
        targets:        0,
        
        
    });
    $(document).ready( function () {
    $t_rep_paid = $("#rep_paid").text();
    $t_rep_amount = $("#rep_amount").text();

    $ref_rate = ($t_rep_paid / $t_rep_amount) * 100;

    $total_percent = Math.round($ref_rate)

    document.getElementById('percent_yeah').innerText= $total_percent + '%';

     
    $('.type-select').on('change', function(){
    var selectedValue=$('.type-select').val();  
    table.column(98).search( selectedValue ).draw(); 
    
    console.log(selectedValue);
    });

        // Row 1 Counter cell
    table.on( 'draw.dt', function () {
            var PageInfo = $('#mydatatable').DataTable().page.info();
            table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
            });
    }).draw();
});
</script>


@endsection()