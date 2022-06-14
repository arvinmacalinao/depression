@extends('./layouts.app')

@section('content')
<div class="container-fluid">
    @if(Session::has('message'))
    <div class="alert alert-success mt-2" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ Session::get('message') }}</strong>
    </div>
    @endif
@include('projects.details.details')
<div class="card">
    <div class="card-header">                  
        <h3>Project Equipment
            <div class="pull-right">
                <a href="{{ route('New Equipment', $project->prj_id) }}" class="projectdetails-btn pr"><span class="fa fa-plus"></span> Add Equipment</a>
                
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="" method="GET" autocomplete="off">
            <div class="form-row">
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Brand</span>
                        </div>
                        <select class="form-control input-sm" id="qbrand" name="qbrand">
                            <option value="">ALL</option>
                            @foreach ($sel_brands as $sel_brand)
                            <option value="{{ $sel_brand->brand_id }}">{{ $sel_brand->brand_name }}</option>
                            @endforeach
                        </select>
                      </div>
                </div>
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <input class="form-control input-sm" placeholder="Equipment..." type="text" maxlength="255" name="qsearch" id="qsearch" value="">
                        <input class="projectdetails-btn btn-sm" type="submit"  value="Search">
                    </div>
                    {{-- {{ old('search', $project_search) }} --}}
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
            <thead>
                <tr>
                    <th width="7%">&nbsp;</th>
                    <th width="9%">Property No.</th>
                    <th width="25%">Equipment Specs</th>
                    <th >Name</th>
                    <th >Improvement</th>
                    <th width="3%">Qty</th>
                    <th >Amount Approved</th>
                    <th >Provider</th>
                    <th >Remarks</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($equipments as $equipment)
                                <tr>
                                    <td>
                                        <a href="{{ route('View Equipment', ['id' => $project->prj_id, 'eq_id' => $equipment->eqp_id]) }}" class="project-btn mr-1" title="View"><i class="fa fa-folder-open-o"></i></a>
                                        <a href="{{ route('Edit Equipment', ['id' => $project->prj_id, 'eq_id' => $equipment->eqp_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('Delete Equipment', ['id' => $project->prj_id, 'eq_id' => $equipment->eqp_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                    <td>{{ $equipment->eqp_property_no }}</td>
                                    <td class="text-wrap">
                                        {!!  nl2br(e($equipment->eqp_specs))  !!}
                                    </td>
                                    <td>{{ $equipment->brands->brand_name }}</td>
                                    <td>{{ $equipment->improvements->imp_name }}</td>
                                    <td>{{ $equipment->eqp_qty }}</td>
                                    <td>Php {{ number_format($equipment->eqp_amount_approved,2) }}</td>
                                    <td>Php {{ number_format($equipment->eqp_amount_acquired,2) }}</td>
                                    <td>{{ $equipment->eqp_remarks }}</td>
                                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
<script>
    var t =  $('#mydatatable').DataTable({
        deferRender:    true,
        searching:      false,
        paging:         false,
        orderable:      false,
        targets:        0,
        order: [[ 1, 'desc' ]]
    }); 
</script>
@endsection