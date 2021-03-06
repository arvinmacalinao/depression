@extends('./layouts.app', ['title' => 'Add'])

@section('content')
<div id="loader" class="lds-dual-ring hidden overlay"></div>

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
<form action = "/store" method = "post">
    @csrf
    <div class="card">
    <div class="card-header">
            <div class="d-flex justify-content-between">
                <h2>User Groups (Add)</h2>
                <div></div>
                <div id="buttonz">
                    <a href="{{ URL::to('usergroups') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                </div>

            </div>  
    </div>
        <div class="card-body">
            <div class="form-group">
                <label for="ug_name" class="control-label"><b>Group Name *</b></label>   
                <input class="form-control input-sm @error('ug_name') is-invalid @enderror" placeholder="Group Name" name="ug_name" id="ug_name" type="text" value="{{ old('ug_name') }}">
                @error('ug_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="ug_display_name" class="control-label"><b>Short Display Name * (Used in Buttons)</b></label>
                <span class="text-danger"><small></small></span>
                <input class="form-control input-sm @error('ug_display_name') is-invalid @enderror" placeholder="Short Display Name" name="ug_display_name" id="ug_display_name" type="text" value="{{ old('ug_display_name') }}">
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
                    <option value="">None</option>
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
                    <input type="checkbox" name="ug_is_admin" id="ug_is_admin" value="0"> Is Administrator Group
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
                <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">
            </div>

        </div>
    </div>
    </form>   
</div>

<script>

ug_admin_is = document.querySelector('input[name="ug_is_admin"]');
ug_admin_is.value = "0";

$("#ug_is_admin").change( function(){
    if($(this).is(':checked')) {
        ug_admin_is.value = "1"
    } else {
        ug_admin_is.value = "0"
    }
});

@foreach($c_userrights as $c_userright) 
    ur_view = document.querySelector('input[name="ur{{  $c_userright->ur_id  }}_view"]'); 
    ur_add = document.querySelector('input[name="ur{{  $c_userright->ur_id  }}_add"]');
    ur_delete = document.querySelector('input[name="ur{{  $c_userright->ur_id  }}_delete"]');

    ur_view.value = "0";
    ur_add.value = "0";
    ur_delete.value = "0";

    // $("#ur{{  $c_userright->ur_id  }}_view").change( function(){
    //     if($(this).is(':checked')) {
    //         ur_view.value = "1"
    //     } else {
    //         ur_view.value = "0"
    //     }
    // });

    // $("#ur{{  $c_userright->ur_id  }}_add").change( function(){
    //     if($(this).is(':checked')) {
    //         ur_add.value = "1"
    //     } else {
    //         ur_add.value = "0"
    //     }
    // });

    // $("#ur{{  $c_userright->ur_id  }}_delete").change( function(){
    //     if($(this).is(':checked')) {
    //         ur_delete.value = "1"
    //     } else {
    //         ur_delete.value = "0"
    //     }
    // });

    
@endforeach

select_id="";

if ($('#copy_rights').length) {
	    $('#copy_rights').change(function (){
            select_id = $(this).children(":selected").attr("value");
            getChkData()
		});
}



// user groups check all
	
if ($('#chk_all_1').length){
		$('#chk_all_1').click(function (){
			var _checked = this.checked;
			$('.chk1').each(function (){
				this.checked = _checked;
			});
		});

		$('.chk1').click(function (){
			var _checked = this.checked;
			$('.chk1').each(function (){
				_checked &= this.checked;
			});
			$('#chk_all_1').prop('checked', _checked);
		});
	}

	if ($('#chk_all_2').length){
		$('#chk_all_2').click(function (){
			var _checked = this.checked;
			$('.chk2').each(function (){
				this.checked = _checked;
			});
		});

		$('.chk2').click(function (){
			var _checked = this.checked;
			$('.chk2').each(function (){
				_checked &= this.checked;
			});
			$('#chk_all_2').prop('checked', _checked);
		});
	}

	if ($('#chk_all_3').length){
		$('#chk_all_3').click(function (){
			var _checked = this.checked;
			$('.chk3').each(function (){
				this.checked = _checked;
			});
		});

		$('.chk3').click(function (){
			var _checked = this.checked;
			$('.chk3').each(function (){
				_checked &= this.checked;
			});
			$('#chk_all_3').prop('checked', _checked);
		});
	}

	if ($('#chk_all_4').length){
		$('#chk_all_4').click(function (){
			var _checked = this.checked;
			$('.chk4').each(function (){
				this.checked = _checked;
			});
		});

		$('.chk4').click(function (){
			var _checked = this.checked;
			$('.chk4').each(function (){
				_checked &= this.checked;
			});
			$('#chk_all_4').prop('checked', _checked);
		});
	}


function getChkData(){
    $.ajax({
            url: "{!! URL::to('usergroups/create/get-by-selid')!!}",
            type: "GET",
            data:{ 
                select_id: select_id
            },
            beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                $('#loader').removeClass('hidden')
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
</script>
@endsection