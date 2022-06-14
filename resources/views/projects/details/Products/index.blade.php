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
                <a href="{{ route('New Product', $project->prj_id) }}" class="projectdetails-btn pr"><span class="fa fa-plus"></span> Add Products</a>
                
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="" method="GET" autocomplete="off">
            <div class="form-row">
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Unit</span>
                        </div>
                        <select class="form-control input-sm" id="qunit" name="qunit">
                            <option value="">ALL</option>
                            @foreach ($sel_units as $unit)
                            <option value="{{ $unit->unit_id }}">{{ $unit->unit_name }}</option>
                            
                            @endforeach
                        </select>
                      </div>
                </div>
                <div class="col-sm-auto mb-2">
                    <div class="input-group input-group-sm">
                        <input class="form-control input-sm" placeholder="Products..." type="text" maxlength="255" name="qsearch" id="qsearch" value="{{ old('qsearch', $prod_search) }}">
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
                    <th width="6%">&nbsp;</th>
                    <th width="40%">Product</th>
                    <th width="30%">Unit</th>
                    <th >Encoded</th>
                    <th >Updated</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <a href="{{ route('Edit Product', ['id' => $project->prj_id, 'prod_id' => $product->prod_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('Delete Product', ['id' => $project->prj_id, 'prod_id' => $product->prod_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                        <td>{{ $product->prod_name }}</td>
                        <td class="text-center">{{ $product->units->unit_name }}</td>
                        <td>{{ date('m/d/Y h:i:s a',strtotime($product->date_encoded))  }} <br> by {{ $product->encoder }}</td>
                        <td>{{ date('m/d/Y h:i:s a',strtotime($product->last_updated))  }} <br> by {{ $product->updater }}</td>
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
        order: [[ 1, 'asc' ]]
    }); 
</script>
@endsection