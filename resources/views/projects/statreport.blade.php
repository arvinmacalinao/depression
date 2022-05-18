@extends('./layouts.app', ['title' => 'Status Report'])

@section('content')
<div id="loader" class="lds-dual-ring hidden overlay"></div>
<form action="/statfilter" method="post">
@csrf
<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-header">
            <h2><b>Status Reports</b></h2>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-sm-1">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Year</span>
                    </div>
                    <select class="form-control input-sm" id="sr_yr_approved" name="sr_yr_approved" style="width:auto;">
                        <option>All</option>
                        @foreach($yrs_approveds as $yrs_approved)
                            <option>{{ $yrs_approved->prjmon_year }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="col-sm-2">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Quarter</span>
                    </div>
                    <select class="form-control input-sm" id="sr_qtr_name" name="sr_qtr_name" style="width:auto;">
                        <option>All</option>
                        @foreach($sel_quarters as $sel_quarter)
                            <option>{{ $sel_quarter->quarter_name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="col-sm-3">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Project Type</span>
                    </div>
                    <select class="form-control input-sm" id="sr_prj_type" name="sr_prj_type" style="width:auto;">
                        <option>All</option>
                        @foreach($sel_projecttypes as $sel_projecttype)
                            <option>{{ $sel_projecttype->prj_type_name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="col-sm-2">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Status</span>
                    </div>
                    <select class="form-control input-sm" id="sr_prj_stat" name="sr_prj_stat" style="width:auto;">
                        <option>All</option>
                        @foreach($sel_projectstatus as $sel_projectstatu)
                            <option>{{ $sel_projectstatu->prj_status_name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="col-sm-2">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Province</span>
                    </div>
                    <select class="form-control input-sm" id="sr_province" name="sr_province" style="width:auto;">
                        <option>All</option>
                        @foreach($sel_provinces as $sel_province)
                            <option>{{ $sel_province->province_name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Project Title.." aria-describedby="button-addon2" id="sr_input_prjtitle">
                        <div class="input-group-append">
                            <button class="btn btn-primary  btn-sm" type="button" id="btn_search">Search</button>
                        </div>
                    </div>
                </div>
                
            </div>

        
            <table class="table table-striped table-bordered" style="width: 100%" id="mydatatable">
                
            <thead>
                    <tr>
                        <th>#</th>
                        <th>Year</th>
                        <th>Quarter</th>
                        <th>Code</th>
                        <th>Project</th>
                        <th>Beneficiaries</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Province</th>
                        <th>Encoded</th>
                        <th>Encoded By</th>
                        <th>Last Updated</th>
                        <th>Updated By</th>
                    </tr>
                </thead> 

                <tbody>
                    @foreach($dtdatas as $dtdata)    
                    <tr>
                        <td>1</td>
                        <td>{{  $dtdata->prj_year_approved  }}</td>
                        <td>{{  $dtdata->quarter_name  }}</td>
                        <td>{{  $dtdata->prj_code  }}</td>
                        <td class="text-wrap" id="td_title">{{  $dtdata->prj_title  }}</td>
                        <td class="text-wrap" id="td_coop">{{  $dtdata->coop_names  }}</td>
                        <td>{{  $dtdata->prj_status_name  }}</td>
                        <td class="text-wrap" id="td_typename">{{  $dtdata->prj_type_name  }}</td>
                        <td>{{  $dtdata->province_name  }}</td>
                        <td>{{  $dtdata->date_encoded  }}</td>
                        <td class="text-wrap" id="td_encoder">{{  $dtdata->encoder  }}</td>
                        <td>{{  $dtdata->last_updated  }}</td>
                        <td class="text-wrap" id="td_updater">{{  $dtdata->updater  }}</td>                        
                    </tr>
                    @endforeach
                </tbody>            

            </table>
        </div>

    </div>
    <div class="card-footer">
        <div class="table-responsive">
        <table class="table table-condensed">
            <thead>
            <tr>
                <th class="text-center">Total Number of Status Report Submitted</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">
                 <b><div id="t_count"></div></b>   
                </td>
            <tr>
            </tbody>
        </table>
        </div>
    </div>
</div>
</form>




<script>
var total_count_prj = ""
    var t =  $('#mydatatable').DataTable({
        deferRender:    true,
        searching:      false,
        paging:         true,
        orderable:      false,
        targets:        0,
        order: [[ 1, 'desc' ]]
    }); 

    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
   
    var usedNames = {};
    $("select[name='sr_yr_approved'] > option").each(function () {
        if(usedNames[this.text]) {
            $(this).remove();
        } else {
            usedNames[this.text] = this.value;
        }
    });

    $("#sr_yr_approved").val($("#sr_yr_approved option:eq(1)").val());


    $( "#btn_search" ).click(function() {
        milter();
    }); 

    function milter(){
        var op_yr_approved = document.getElementById("sr_yr_approved").value; 
        var op_qtr_name = document.getElementById("sr_qtr_name").value;
        var op_prj_type = document.getElementById("sr_prj_type").value;
        var op_prj_stat = document.getElementById("sr_prj_stat").value;
        var op_province = document.getElementById("sr_province").value;
        var op_prjtitle = document.getElementById("sr_input_prjtitle").value;

        let cCount = "";

        $.ajax({
        url: "get-by-year",
        type: "GET",
        data:{ 
            op_yr_approved: op_yr_approved,
            op_qtr_name: op_qtr_name,
            op_prj_type: op_prj_type,
            op_prj_stat: op_prj_stat,
            op_province: op_province,
            op_prjtitle: op_prjtitle
        },
        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                $('#loader').removeClass('hidden')
        },
        success:function(response){
            if ( $.fn.DataTable.isDataTable('#mydatatable') ) {
                $('#mydatatable').DataTable().destroy();
            }     
            $('#mydatatable tbody').empty();      
            var wsHtml = '';
            var data = response
            jQuery.each(data,function(index, value){
                // console.log(value.prj_title);
                wsHtml += '<tr>';
                wsHtml += '<td>' + "1" + '</td>';
                wsHtml += '<td class="text-wrap">' + value.prj_year_approved  + '</td>';
                wsHtml += '<td class="text-wrap">' + value.quarter_name  + '</td>';
                wsHtml += '<td class="text-wrap">' + value.prj_code  + '</td>';
                wsHtml += '<td class="text-wrap">' + value.prj_title  + '</td>';
                wsHtml += '<td class="text-wrap">' + value.coop_names  + '</td>';
                wsHtml += '<td>' + value.prj_status_name + '</td>';
                wsHtml += '<td class="text-wrap">' + value.prj_type_name + '</td>';
                wsHtml += '<td>' + value.province_name + '</td>';
                wsHtml += '<td>' + value.date_encoded + '</td>';
                wsHtml += '<td class="text-wrap">' + value.encoder + '</td>';
                wsHtml += '<td>' + value.last_updated + '</td>';
                wsHtml += '<td class="text-wrap">' + value.updater + '</td>';
                wsHtml += '</tr>';
            });
            $('#mydatatable > tbody:last').append(wsHtml);
            var t =  $('#mydatatable').DataTable({
                deferRender:    true,
                searching:      false,
                paging:         true,
                orderable:      false,
                targets:        0,
                order: [[ 1, 'desc' ]]
            }); 

            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                    total_count_prj = i+1
                } );
                
            } ).draw();

            $('#t_count').text(total_count_prj); 
        
            var usedNames = {};
            $("select[name='sr_yr_approved'] > option").each(function () {
                if(usedNames[this.text]) {
                    $(this).remove();
                } else {
                    usedNames[this.text] = this.value;
                }
            });
        },
        complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                $('#loader').addClass('hidden')
        },
        });  
    }

    
</script>

@endsection