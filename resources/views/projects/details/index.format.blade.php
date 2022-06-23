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
        <h3>Project Products
            <div class="pull-right">
                <a href="" class="projectdetails-btn pr"><span class="fa fa-plus"></span> Add Products</a>
                {{-- {{ route('New Product', $project->prj_id) }} --}}
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="" method="GET" autocomplete="off">
            <div class="form-row">
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Category</span>
                        </div>
                        <select class="form-control input-sm mr-2" id="qlab" name="qlab">
                            <option value="">ALL</option>
                            
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Implementor</span>
                        </div>
                        <select class="form-control input-sm mr-2" id="qimp" name="qimp">
                            <option value="">ALL</option>
                            
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Year</span>
                        </div>
                        <select class="form-control input-sm" id="qyear" name="qyear">
                            <option value="">ALL</option>
                            
                        </select>
                    </div>
                </div>
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <input class="projectdetails-btn btn-sm" type="submit" name="search" id="search" value="Search">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
            <thead>
                <tr>
                    <th width="6%">&nbsp;</th>
                    <th >Product</th>
                    <th >Semester</th>
                    <th >Volume of Production Local</th>
                    <th >Volume of Production Export</th>
                    <th >Gross Sales Local</th>
                    <th >Gross Sales Export</th>
                    <th >Remarks</th>
                    <th >Encoded</th>
                    <th >Updated</th>
                </tr>
            </thead> 
            <tbody>
                {{-- @foreach ($project->PIS as $get_pis)
                                <tr>
                                    <td>
                                        <a href="{{ route('Edit PIS', ['id' => $project->prj_id, 'pis_id' => $get_pis->prjpis_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('Delete PIS', ['id' => $project->prj_id, 'pis_id' => $get_pis->prjpis_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td>{{ $get_pis->prjpis_year }}</td>
                                    <td>{{ $get_pis->semester->sem_name }}</td>
                                    <td class="text-right">Php {{ number_format($get_pis->prjpis_volume_production_local,2) }}</td>
                                    <td class="text-right">Php {{ number_format($get_pis->prjpis_volume_production_export,2) }}</td>
                                    <td class="text-right">Php {{ number_format($get_pis->prjpis_gross_sales_local,2) }}</td>
                                    <td class="text-right">Php {{ number_format($get_pis->prjpis_gross_sales_export,2) }}</td>
                                    <td>{{ $get_pis->prjpis_remarks }}</td>
                                    <td>{{ date('m/d/Y h:i:s a',strtotime($get_pis->date_encoded))  }} <br> by {{ $get_pis->encoder }}</td>
                                    <td>{{ date('m/d/Y h:i:s a',strtotime($get_pis->last_updated))  }} <br> by {{ $get_pis->updater }}</td>
                                </tr>
                @endforeach --}}
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