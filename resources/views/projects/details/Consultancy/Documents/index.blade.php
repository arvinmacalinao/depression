@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header">                  
                <div class="pull-right">
                    <a class="projectdetails-btn" href="" title="Edit"><span class="fa fa-plus"></span> Add Document</a>
                    <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
                </div>
                <h3><strong>Project Consultancy Documents</strong></h3>
                <p> 
                    Service Provider : {{ $consultancy->serviceprovider->sp_name }}<br>
                    Category : {{ $consultancy->consultancytype->con_type_name }}<br>
                    Consultancy Start : {{ $consultancy->con_start }}<br>
                    Consultancy End : {{ $consultancy->con_end }}<br>
                    Consultancy Encoded on {{ date('m/d/Y h:i:s a',strtotime($consultancy->date_encoded))  }} by {{ $consultancy->encoder }} <br>
                    Consultancy Last updated {{ date('m/d/Y h:i:s a',strtotime($consultancy->date_encoded))  }} by {{ $consultancy->encoder }} 
                </p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-auto">
                <div class="input-group input-group-sm">
                    <input class="form-control input-sm" placeholder="Filename ..." type="text" maxlength="255" name="q" id="q" value="">
                    <input class="projectdetails-btn btn-sm" type="submit" name="search" id="search" value="Search">
                </div>
                {{-- {{ old('search', $project_search) }} --}}
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
            <thead>
                <tr>
                    <th width="6%">&nbsp;</th>
                    <th >#</th>
                    <th >Document</th>
                    <th >Remarks</th>
                    <th >Date Uploaded</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($ducuments as $ducument)
                    <tr>
                        <td>
                            {{-- 
                                {{ route('Consultancy Documents', ['id' => $project->prj_id, 'con_id' => $consultancy->con_id]) }}
                                {{ route('Edit Consultancy', ['id' => $project->prj_id, 'con_id' => $consultancy->con_id]) }}
                                {{ route('Delete Consultancy', ['id' => $project->prj_id, 'con_id' => $consultancy->con_id]) }}
                                --}}
                            <a href="" class="project-btn mr-1" title="View"><i class="fa fa-folder-open-o"></i></a>
                            <a href="" class="project-btn mr-1" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="" class="project-btn mr-1" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td>{{ $ducument->condoc_filename }}</td>
                        <td>{{ $ducument->condoc_remarks }}</td>
                        <td>{{ date('m/d/Y',strtotime($ducument->date_encoded)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>
    <div class="card-footer">
        
    </div>
</div>
<script>
   
</script>
@endsection