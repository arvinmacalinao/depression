@extends('./layouts.app', ['title' => 'User Groups (Edit)'])

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
    
<form action = "{{route('usergroups.update', $show_ug->ug_id)}}" method = "post">
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
                    <input class="form-control input-sm @error('ug_name') is-invalid @enderror" placeholder="Group Name" name="ug_name" id="ug_name" type="text" value="{{ $show_ug->ug_name }}">
                    @error('ug_name')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ug_display_name" class="control-label"><b>Short Display Name * (Used in Buttons)</b></label>
                    <span class="text-danger"><small></small></span>
                    <input class="form-control input-sm @error('ug_display_name') is-invalid @enderror" placeholder="Short Display Name" name="ug_display_name" id="ug_display_name" type="text" value="{{ $show_ug->ug_display_name }}">
                    @error('ug_display_name')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div> 

                <div class="form-group form-group-sm">
                    <label for="region_id" class="control-label"><b>Region</b></label>
                    <select class="form-control input-sm regions_select @error('region_id') is-invalid @enderror" id="region_id" name="region_id">
                        @foreach($sel_regions as $sel_region)
                            <option value="{{ $sel_region->region_id }}"  {{ ($show_ug->region_id == $sel_region->region_id) ? 'selected':'' }} >{!!  $sel_region->region_code !!} ({!!  $sel_region->region_name !!})</option>
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
                            <option value="{{ $sel_province->province_id }}" {{ ($sel_province->province_id == $show_ug->province_id) ? 'selected':'' }} >{{ $sel_province->province_name }}</option>
                        @endforeach                   
                    </select>
                    @error('province_id')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group-sm">
                    <label for="ug_parent_id" class="control-label"><b>Parent</b></label>
                    <select class="form-control input-sm @error('ug_parent_id') is-invalid @enderror" id="ug_parent_id" name="ug_parent_id">
                        <option value="0" selected>None</option>    
                        @foreach($sel_usergroups as $sel_usergroup)
                            <option value="{{ $sel_usergroup->ug_id }}" {{ ($sel_usergroup->ug_parent_id == $show_ug->ug_id)  ? 'selected':''}} >{{ $sel_usergroup->ug_name }}</option>
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
                        <option value="{{ $ug_user->u_id }}" {{ ($ug_user->u_id == $show_ug->ug_unit_head)  ? 'selected':''}} >{{ $ug_user->u_fname }} {{ $ug_user->u_mname }} {{ $ug_user->u_lname }}</option>
                    @endforeach 
                </select>
                    @error('ug_unit_head')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group-sm">
                    <label>
                        <input type="checkbox" name="ug_is_admin" id="ug_is_admin" value="{{ ( $show_ug->ug_is_admin == '1') ? '1' : '0' }}" {{ ( $show_ug->ug_is_admin == '1') ? 'checked' : '' }}>  <b>Is Administrator Group</b> 
                    </label>
                </div>

                <h5><div class="alert alert-secondary" role="alert">
                    Access Rights
                </div></h5>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th>
                            <label for="copy_rights">Copy access rights from</label>
                            <select class="form-control @error('copy_rights') is-invalid @enderror" name="copy_rights" id="copy_rights">
                                <option value="0">--</option>
                            @foreach($sel_usergroups as $sel_usergroup) 
                                <option value="{{  $sel_usergroup->ug_id  }}">{{  $sel_usergroup->ug_name  }}</option>
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
                @foreach($usergroup_rights as $usergroup_right)
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    {{  $usergroup_right->urights->ur_name  }}
                                </label>
                                <input name="ur_id[]" value="{{  $usergroup_right->urights->ur_id }}" type="hidden">
                            </div>
                        </td>

                        <td class="text-left">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="ur{{  $usergroup_right->ur_id  }}_view" id="ur{{  $usergroup_right->ur_id  }}_view" value="{{ ( $usergroup_right->ugr_view == '1') ? '1' : '0' }}" {{ ( $usergroup_right->ugr_view == '1') ? 'checked' : '' }}>
                                <label class="form-check-label">{!! ($usergroup_right->ur_id =='72' || $usergroup_right->ur_id =='73' || $usergroup_right->ur_id =='74' || $usergroup_right->ur_id =='75') ? 'Approval 1' : 'View'  !!}</label>
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
@endsection