@extends('./layouts.app', ['title' => 'Edit'])

@section('content')
<div class="container-fluid mt-3">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('status') }}
        </div>
        @elseif(session('failed'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('failed') }}
        </div>
    @endif  
    
<form action = "{{route('usergroups.update', $show->ug_id)}}" method = "post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h2>User Groups (Edit)</h2>
                <div></div>
                <div id="buttonz">
                    <a href="{{ URL::to('usergroups') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                </div>
            </div> 
        </div> 
            <div class="card-body">
                <div class="form-group">
                    <label for="ug_name" class="control-label"><b>Group Name *</b></label>   
                    <input class="form-control input-sm @error('ug_name') is-invalid @enderror" placeholder="Group Name" name="ug_name" id="ug_name" type="text" value="{{ $show->ug_name }}">
                    @error('ug_name')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ug_display_name" class="control-label"><b>Short Display Name * (Used in Buttons)</b></label>
                    <span class="text-danger"><small></small></span>
                    <input class="form-control input-sm @error('ug_display_name') is-invalid @enderror" placeholder="Short Display Name" name="ug_display_name" id="ug_display_name" type="text" value="{{ $show->ug_display_name }}">
                    @error('ug_display_name')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div> 

                <div class="form-group form-group-sm">
                    <label for="region_id" class="control-label"><b>Region</b></label>
                    <select class="form-control input-sm regions_select @error('region_id') is-invalid @enderror" id="region_id" name="region_id">
                        @foreach($sel_regions as $sel_region)
                            <option value="{{ $sel_region->region_id }}">{{ $sel_region->region_text }}</option>
                        @endforeach
                    </select>
                    @error('region_id')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group-sm">
                    <label for="province_id" class="control-label"><b>Province</b></label>
                    <select class="form-control input-sm region_provinces_select @error('province_id') is-invalid @enderror" id="province_id" name="province_id">
                        @foreach($sel_provinces as $sel_province)
                            <option value="{{ $sel_province->province_id }}">{{ $sel_province->province_name }}</option>
                        @endforeach                   
                    </select>
                    @error('province_id')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group-sm">
                    <label for="ug_parent_id" class="control-label"><b>Parent</b></label>
                    <select class="form-control input-sm @error('ug_parent_id') is-invalid @enderror" id="ug_parent_id" name="ug_parent_id">
                        <option value="0">None</option>
                        @foreach($d_usergroups as $d_usergroup)
                            <option value="{{ $d_usergroup->ug_id }}">{{ $d_usergroup->ug_name }}</option>
                        @endforeach 
                    </select>
                    @error('ug_parent_id')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group-sm">
                <label for="ug_unit_head" class="control-label"><b>Unit Head</b></label>
                <select class="form-control input-sm @error('ug_unit_head') is-invalid @enderror" id="ug_unit_head" name="ug_unit_head">
                    @foreach($ug_users as $ug_user)
                        <option value="{{ $ug_user->u_id }}">{{ $ug_user->u_name }}</option>
                    @endforeach 
                </select>
                    @error('ug_unit_head')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="checkbox">
                    <label>
                        @if($show->ug_is_admin == '1')
                        <input type="checkbox" name="ug_is_admin" id="ug_is_admin" value="1" checked> Is Administrator Group
                        @else
                        <input type="checkbox" name="ug_is_admin" id="ug_is_admin" value="0"> Is Administrator Group
                        @endif
                    </label>
                </div>

                <h3><div class="alert alert-secondary" role="alert">
                    Access Rights
                </div></h3>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th>
                                <label for="copy_rights">Copy access rights from</label>
                                <select class="form-control @error('copy_rights') is-invalid @enderror" name="copy_rights" id="copy_rights">
                                    <option value="--">--</option>
                                @foreach($d_usergroups as $d_usergroup) 
                                    <option value="{{  $d_usergroup->ug_id  }}">{{  $d_usergroup->ug_name  }}</option>
                                @endforeach
                                </select>
                                @error('copy_rights')
                                    <div class="alert alert-danger p-1">{{ $message }}</div>
                                @enderror
                        </th>
                        <th class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="chk_all_1" title="Check All"> Check All
                                </label>
                            </div>
                        </th>
                        <th class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="chk_all_2" title="Check All"> Check All
                                </label>
                            </div>
                        </th>
                        <th class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="chk_all_3" title="Check All"> Check All
                                </label>
                            </div>
                        </th>
                        <th class="text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="chk_all_4" title="Check All"> Check All
                                </label>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($c_userrights as $c_userright) 
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    {{  $c_userright->ur_name  }}
                                </label>
                                <input name="ur_id[]" value="{{  $c_userright->ur_id }}" type="hidden">
                            </div>
                        </td>   
                        
                        <td class="text-left">
                            <div class="checkbox">
                                <label>
                                    @if($c_userright->ur_id =='72' || $c_userright->ur_id =='73' || $c_userright->ur_id =='74' || $c_userright->ur_id =='75') 
                                        <input type="checkbox" class="chk1" name="ur{{  $c_userright->ur_id  }}_view" id="ur{{  $c_userright->ur_id  }}_view" value="1"> Approval 1
                                    @else
                                        <input type="checkbox" class="chk1" name="ur{{  $c_userright->ur_id  }}_view" id="ur{{  $c_userright->ur_id  }}_view" value="1"> View
                                    @endif
                                </label>
                            </div>
                        </td>

                        <td class="text-left">
                            <div class="checkbox">
                                <label>
                                @if($c_userright->ur_id =='72' || $c_userright->ur_id =='73' || $c_userright->ur_id =='74' || $c_userright->ur_id =='75') 
                                    <input type="checkbox" class="chk2" name="ur{{  $c_userright->ur_id  }}_add" id="ur{{  $c_userright->ur_id  }}_add" value="1"> Approval 2
                                @else
                                    <input type="checkbox" class="chk2" name="ur{{  $c_userright->ur_id  }}_add" id="ur{{  $c_userright->ur_id  }}_add" value="1"> Add
                                @endif
                                </label>
                            </div>
                        </td>

                        <td class="text-left">
                            <div class="checkbox">
                                <label>
                                @if($c_userright->ur_id =='72' || $c_userright->ur_id =='73' || $c_userright->ur_id =='74' || $c_userright->ur_id =='75') 
                                    <input type="checkbox" class="chk3" name="ur{{  $c_userright->ur_id  }}_edit" id="ur{{  $c_userright->ur_id  }}_edit" value="1"> Approval 3
                                @else
                                    <input type="checkbox" class="chk3" name="ur{{  $c_userright->ur_id  }}_edit" id="ur{{  $c_userright->ur_id  }}_edit" value="1"> Edit
                                @endif
                                </label>
                            </div>
                        </td>

                        <td class="text-left">
                            <div class="checkbox">
                                <label>
                                @if($c_userright->ur_id =='72' || $c_userright->ur_id =='73' || $c_userright->ur_id =='74' || $c_userright->ur_id =='75') 
                                    <input type="checkbox" class="chk4" name="ur{{  $c_userright->ur_id  }}_delete" id="ur{{  $c_userright->ur_id  }}_delete" value="1"> Approval 4
                                @else
                                    <input type="checkbox" class="chk4" name="ur{{  $c_userright->ur_id  }}_delete" id="ur{{  $c_userright->ur_id  }}_delete" value="1"> Delete
                                @endif
                                </label>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>                    
                </table>
            </div>

            <div class="card-footer">
                <input class="btn btn-primary btn-block" type="submit" name="update" id="update" value="Update">
            </div>

            </div>
    </div>
</form>
</div>

<script>
    $("#region_id option[value='" + {{ $show->region_id }} + "']").attr("selected","selected");
    $("#province_id option[value='" + {{ $show->province_id }} + "']").attr("selected","selected");
    $("#ug_parent_id option[value='" + {{ $show->ug_parent_id }} + "']").attr("selected","selected");
    $("#ug_unit_head option[value='" + {{ $show->ug_unit_head }} + "']").attr("selected","selected");

    @foreach($ug_Rights as $ug_Right)
        if({{ $ug_Right->ugr_view }} == '1'){
            $("#ur" + {{ $ug_Right->ur_id }} + "_view").attr("checked", "checked");
        }else{
            $("#ur" + {{ $ug_Right->ur_id }} + "_view").attr("checked", "false");
        }

        if({{ $ug_Right->ugr_add }} == '1'){
            $("#ur" + {{ $ug_Right->ur_id }} + "_add").attr("checked", "checked");
        }else{
            $("#ur" + {{ $ug_Right->ur_id }} + "_add").attr("checked", "false");
        }

        if({{ $ug_Right->ugr_edit }} == '1'){
            $("#ur" + {{ $ug_Right->ur_id }} + "_edit").attr("checked", "checked");
        }else{
            $("#ur" + {{ $ug_Right->ur_id }} + "_edit").attr("checked", "false");
        }

        if({{ $ug_Right->ugr_delete }} == '1'){
            $("#ur" + {{ $ug_Right->ur_id }} + "_delete").attr("checked", "checked");
        }else{
            $("#ur" + {{ $ug_Right->ur_id }} + "_delete").attr("checked", "false");
        }
    @endforeach
</script>
@endsection