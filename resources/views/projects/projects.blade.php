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
                            
                                <select class="form-control input-sm" id="table-filter" name="">
                                    <option value="">ALL</option>
                                    @foreach ($sel_project_types as $sel_project_type)
                                    <option value="{{ $sel_project_type->prj_type_id }}">{{ $sel_project_type->prj_type_name }}</option>
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
                            <option>All</option>
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
                            <option>All</option>
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
                            <option>All</option>
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
                            <option>All</option>
                            @foreach ($sel_project_implementors as $sel_project_implementor)
                            <option value="{{ $sel_project_implementor->ug_id }}">{{ $sel_project_implementor->ug_name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control mb-2 filter-input" id="" placeholder="Search text..">
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-3">
                    {{-- Total No of Projects: {{ $psi_projects->total() }} --}}
                </div>
                <div class="col-sm-5"></div>
                <div class="col-sm-4">
                    {{-- {{ $psi_projects }} --}}
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-md-12">
                    
                   <table id="project_datatable" class="table responsive protable-bordered">
                        <thead>
                            <tr>
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
                                {{-- <th>Refund Rate</th> --}}
                                <th>Implementor </th>
                            </tr>
                    </thead>
                            {{-- @foreach($psi_projects as $psi_project)
                            <tr>
                                <td></td>
                                <td class="counterCell"></td>
                                <td>{{$psi_project->prj_id}}</td>
                                <td>{{$psi_project->prj_title}}</td>
                                <td>{{$psi_project->prj_type_name}}</td>
                                <td>{{$psi_project->prj_year_approved}}</td>
                                <td>{{$psi_project->coop_names}}</td>
                                <td>{{$psi_project->collaborator_names}}</td>
                                <td>{{$psi_project->sector_name}}</td>
                                <td>{{$psi_project->region_code}}</td>
                                <td>{{$psi_project->province_name}}</td>
                                <td>{{$psi_project->city_name}}</td>
                                <td>{{$psi_project->district_name}}</td>
                                <td>{{$psi_project->prj_status_name}}</td>
                                <td>Php&nbsp;{{$psi_project->prj_cost_setup}}</td>
                                <td>Php{{$psi_project->rep_total_due}}</td>
                                <td>Php{{$psi_project->rep_total_paid}}</td>
                                <td>{{$psi_project->rep_refund_rate}}</td>
                                <td>{{$psi_project->ug_name}}</td>
                            </tr>
                            @endforeach --}}
                        </table>
                </div>
            </div>
            
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-3">
                    {{-- Total No of Projects: {{ $psi_projects->total() }} --}}
                </div>
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    {{-- {{ $psi_projects }} --}}
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
<script>
  $(document).ready( function () {
    let _token   = $('meta[name="csrf-token"]').attr('content');
    var table = $('#project_datatable').DataTable({
        processing: true,
        pageLength: 25,
        pagingType: 'first_last_numbers',
        autoWidth: true, 
        serverSide: true,
        sDom: 'ltipr',
        ajax: {
            url:"{{ url('project-list') }}",
                }, 
        columnDefs: [ {
            searchable: false,
            orderable: false,
            targets: 0
        } ],
        order: [1, 'asc'],
        
        
        columns: [  
                    { data: 'row', name:'row'},
                    { data:'prj_id' , name:'prj_id' },
                    { data:'prj_title' , name:'prj_title' },
                    { data:'prj_type_name' , name:'prj_type_name'},
                    { data:'prj_year_approved' , name:'prj_year_approved' },
                    { data:'coop_names' , name:'coop_names' },
                    { data:'collaborator_names' , name:'collaborator_names' },
                    { data:'sector_name' , name:'sector_name' },
                    { data:'region_code' , name:'region_code' },
                    { data:'province_name' , name:'province_name' },
                    { data:'city_name' , name:'city_name' },
                    { data:'district_name' , name:'district_name' },
                    { data:'prj_status_name' , name:'prj_status_name' },
                    { data:'prj_cost_setup', render: $.fn.dataTable.render.number(",", ".", 2), name:'prj_cost_setup' },
                    { data:'rep_total_due' , render: $.fn.dataTable.render.number(",", ".", 2), name:'rep_total_due' },
                    { data:'rep_total_paid' , render: $.fn.dataTable.render.number(",", ".", 2), name:'rep_total_paid' },
                    // { data:'rep_refund_rate' , name:'rep_refund_rate' },
                    { data:'ug_name' , name:'ug_name' }
                 ]
        });

        $('.filter-select').on( 'change', function () {
        table.column(1).search($(this).val()).draw();

        });
        

        $('#table-filter').on('change', function(){
        table.search(this.value).draw();   
        });
        

        // Row 1 Counter cell
        table.on( 'draw.dt', function () {
            var PageInfo = $('#project_datatable').DataTable().page.info();
            table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
            });
        }).draw();
    
});
</script>


@endsection()