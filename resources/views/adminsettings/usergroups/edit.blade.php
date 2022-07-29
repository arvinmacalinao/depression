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
    <div id="loader" class="lds-dual-ring hidden overlay"></div> 
    
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
                        <option value="0">None</option>    
                        @foreach($sel_usergroups as $sel_usergroup)
                            <option value="{{ $sel_usergroup->ug_id }}" {{ ($sel_usergroup->ug_id == $show_ug->ug_parent_id)  ? 'selected':''}} >{{ $sel_usergroup->ug_name }}</option>
                        @endforeach 
                    </select>
                    @error('ug_parent_id')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group-sm">
                <label for="ug_unit_head" class="control-label"><b>Unit Head</b></label>
                <select class="form-control input-sm @error('ug_unit_head') is-invalid @enderror" id="ug_unit_head" name="ug_unit_head">
                    <option value="0">None</option>     
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
                                <option value="{{  $show_ug->ug_id  }}">--</option>
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
                @foreach($default_rights as $default_right)
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    {{  $default_right->ur_name  }}
                                    {{  $default_right->ur_id  }}
                                </label>
                                
                            </div>
                        </td>

                        <td class="text-left">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input chk1" name="ur{{  $default_right->ur_id  }}_view[]" id="ur{{  $default_right->ur_id  }}_view" value="0">
                                <label class="form-check-label">{!! ($default_right->ur_id =='72' || $default_right->ur_id =='73' || $default_right->ur_id =='74' || $default_right->ur_id =='75') ? 'Approval 1' : 'View'  !!}</label>
                            </div>
                        </td>

                        <td class="text-left">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input chk2" name="ur{{  $default_right->ur_id  }}_add" id="ur{{  $default_right->ur_id  }}_add" value="0">
                                <label class="form-check-label">{!! ($default_right->ur_id =='72' || $default_right->ur_id =='73' || $default_right->ur_id =='74' || $default_right->ur_id =='75') ? 'Approval 2' : 'Add'  !!}</label>
                            </div>
                        </td>

                        <td class="text-left">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input chk3" name="ur{{  $default_right->ur_id  }}_edit" id="ur{{  $default_right->ur_id  }}_edit" value="0">
                                <label class="form-check-label">{!! ($default_right->ur_id =='72' || $default_right->ur_id =='73' || $default_right->ur_id =='74' || $default_right->ur_id =='75') ? 'Approval 3' : 'Edit'  !!}</label>
                            </div>
                        </td>

                        <td class="text-left">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input chk4" name="ur{{  $default_right->ur_id  }}_delete" id="ur{{  $default_right->ur_id  }}_delete" value="0">
                                <label class="form-check-label">{!! ($default_right->ur_id =='72' || $default_right->ur_id =='73' || $default_right->ur_id =='74' || $default_right->ur_id =='75') ? 'Approval 3' : 'Delete'  !!}</label>
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
    var select_  = document.querySelector('select[id="copy_rights"] option[selected]');
    $( document ).ready(function() {
        getUGBox();
    });

    if ($('#copy_rights').length) {
	    $('#copy_rights').change(function (){
            data_id = $(this).children(":selected").attr("value");
            getUGBox()
		});
}
    
    if ($('#chk_all_1').length){
		$('#chk_all_1').click(function (){
            var _checked = this.checked;
            if($(this).is(":checked")) {
                $('.chk1').each(function (){
                    this.checked = _checked;
                    this.value = "1";
                });
            }else{
                $('.chk1').each(function (){
                    this.checked = "";
                    this.value = "0";
                });                
            }
		});
	}

	if ($('#chk_all_2').length){
		$('#chk_all_2').click(function (){
            var _checked = this.checked;
            if($(this).is(":checked")) {
                $('.chk2').each(function (){
                    this.checked = _checked;
                    this.value = "1";
                });
            }else{
                $('.chk2').each(function (){
                    this.checked = "";
                    this.value = "0";
                });                
            }
		});
	}

	if ($('#chk_all_3').length){
		$('#chk_all_3').click(function (){
            var _checked = this.checked;
            if($(this).is(":checked")) {
                $('.chk3').each(function (){
                    this.checked = _checked;
                    this.value = "1";
                });
            }else{
                $('.chk3').each(function (){
                    this.checked = "";
                    this.value = "0";
                });                
            }
		});
	}

	if ($('#chk_all_4').length){
		$('#chk_all_4').click(function (){
            var _checked = this.checked;
            if($(this).is(":checked")) {
                $('.chk4').each(function (){
                    this.checked = _checked;
                    this.value = "1";
                });
            }else{
                $('.chk4').each(function (){
                    this.checked = "";
                    this.value = "0";
                });                
            }
		});
	}

    function clearChkBox(){
        $('.chk1').each(function (){
            this.checked = "";
            this.value = "0";
        });  

        $('.chk2').each(function (){
            this.checked = "";
            this.value = "0";
        });  

        $('.chk3').each(function (){
            this.checked = "";
            this.value = "0";
        });  

        $('.chk4').each(function (){
            this.checked = "";
            this.value = "0";
        });  
    }

    data_id = {{ $show_ug->ug_id }};

    function getUGBox(){
        $.ajax({
            url: "{!! URL::to('usergroups/{usergroup}/edit/checkData')!!}",
            type: "GET",
            data:{ 
                data_id: data_id
            },
            beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                $('#loader').removeClass('hidden')
                clearChkBox()
            },
            success:function(response){
                var data = response
                jQuery.each(data,function(index, value){
                    if(value.ugr_view == "1"){
                        $("#ur" + value.ur_id + "_view").prop('checked', true);
                        document.getElementById("ur" + value.ur_id + "_view").setAttribute("value", "1");
                        
                    }else{
                        $("#ur" + value.ur_id + "_view").prop('checked', false);
                        document.getElementById("ur" + value.ur_id + "_view").setAttribute("value", "0");
                    }

                    if(value.ugr_add == "1"){
                        $("#ur" + value.ur_id + "_add").prop('checked', true);
                        document.getElementById("ur" + value.ur_id + "_add").setAttribute("value", "1");
                    }else{
                        $("#ur" + value.ur_id + "_add").prop('checked', false);
                        document.getElementById("ur" + value.ur_id + "_add").setAttribute("value", "0");
                    }

                    if(value.ugr_edit == "1"){
                        $("#ur" + value.ur_id + "_edit").prop('checked', true);
                        document.getElementById("ur" + value.ur_id + "_edit").setAttribute("value", "1");
                    }else{
                        $("#ur" + value.ur_id + "_edit").prop('checked', false);
                        document.getElementById("ur" + value.ur_id + "_edit").setAttribute("value", "0");
                    }

                    if(value.ugr_delete == "1"){
                        $("#ur" + value.ur_id + "_delete").prop('checked', true);
                        document.getElementById("ur" + value.ur_id + "_delete").setAttribute("value", "1");
                    }else{
                        $("#ur" + value.ur_id + "_delete").prop('checked', false);
                        document.getElementById("ur" + value.ur_id + "_delete").setAttribute("value", "0");
                    }
                });
                // $("#ur26_view").prop('checked', true);
            },
            complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                $('#loader').addClass('hidden');
            },
        });
    }

    @foreach($default_rights as $default_right)
        $('#ur{{$default_right->ur_id}}_view').click(function (){
            var _checked = this.checked;
            if($(this).is(":checked")) {
                this.checked = _checked;
                this.value = "1";
            }else{
                this.checked = "";
                this.value = "0";             
            }
		}); 

        $('#ur{{$default_right->ur_id}}_add').click(function (){
            var _checked = this.checked;
            if($(this).is(":checked")) {
                this.checked = _checked;
                this.value = "1";
            }else{
                this.checked = "";
                this.value = "0";             
            }
		}); 

        $('#ur{{$default_right->ur_id}}_edit').click(function (){
            var _checked = this.checked;
            if($(this).is(":checked")) {
                this.checked = _checked;
                this.value = "1";
            }else{
                this.checked = "";
                this.value = "0";             
            }
		}); 

        $('#ur{{$default_right->ur_id}}_delete').click(function (){
            var _checked = this.checked;
            if($(this).is(":checked")) {
                this.checked = _checked;
                this.value = "1";
            }else{
                this.checked = "";
                this.value = "0";             
            }
		}); 
    @endforeach
</script>
@endsection