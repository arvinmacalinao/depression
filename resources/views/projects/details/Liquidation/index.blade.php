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
        <div class="pull-right">
            <a class="projectdetails-btn" href="{{ route('New Project Liquidation', ['id' => $project->prj_id]) }}" title="Add"><span class="fa fa-plus"></span> Add Document</a>
        </div>
        <h3><strong>Project Liquidation</strong></h3>
    </div>
    <div class="card-body">
        <div class="row">
            <form action="" method="GET" autocomplete="off">
                <div class="form-row ml-2">
                    <div class="col-sm-auto mb-2 ">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">Document Type</span>
                            </div>
                            <select class="form-control input-sm" id="qtype" name="qtype">
                                <option value="">ALL</option>
                                @foreach ($sel_types as $type)
                                <option value="{{ $type->liqtype_id }}">{{ $type->liqtype_name }}</option>
                                @endforeach
                            </select>
                          </div>
                    </div>
                    <div class="col-sm-auto mb-2">
                        <div class="input-group input-group-sm">
                            <input class="form-control input-sm" placeholder="Filename..." type="text" maxlength="255" name="qsearch" id="qsearch" value="{{ old('qsearch', $liq_search) }}">
                           
                            <input class="projectdetails-btn btn-sm" type="submit"  value="Search">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
            <thead>
                <tr>
                    <th width="6%">&nbsp;</th>
                    <th width="3%" style="text-align: center">#</th>
                    <th width="30%">Document</th>
                    <th>Type</th>
                    <th>Remarks</th>
                    <th>Encoded</th>
                    <th>Updated</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($liquidations as $liquidation)
                    <tr>
                        <td>               
                            <a href="{{ $liquidation->document1() }}" target="_blank" class="project-btn mr-1" title="View"><i class="fa fa-folder-open"></i></a>
                            <a href="{{ route('Edit Project Liquidation', ['id' => $project->prj_id, 'liq_id' => $liquidation->liq_id]) }}" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="{{ route('Delete Project Liquidation', ['id' => $project->prj_id, 'liq_id' => $liquidation->liq_id]) }}" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td><a href="{{ $liquidation->document1() }}" target="_blank" title="View">{{ $liquidation->liq_filename }}</a></td>
                        <td>{{ $liquidation->liqtype->liqtype_name }}</td>
                        <td>{{ $liquidation->liq_remarks }}</td>
                        <td>{{ date('m/d/Y h:i:s a',strtotime($liquidation->date_encoded))  }} <br> by {{ $liquidation->encoder }}</td>
                        <td>{{ date('m/d/Y h:i:s a',strtotime($liquidation->date_encoded))  }} <br> by {{ $liquidation->encoder }}</td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-12">
                <div class="d-flex justify-content-center">{{  $liquidations->appends(Request::all())->links() }}</div>
            </div>
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
        order: [[ 1, 'asc' ]]
    }); 

//     var min = 2000;
//     max = new Date().getFullYear();
//     select = document.getElementById('qyear');

//     for (var i = min; i<=max; i++){
//         var opt = document.createElement('option');
//         opt.value = i;
//         opt.innerHTML = i;
//         select.appendChild(opt);
//     }

// select.value = new Date().getFullYear();
// $("#qyear").prop("selectedIndex", 0);
</script>
@endsection