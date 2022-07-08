@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header">
        <h3>Project Progress Reports (Add)
            <div class="pull-right">
                <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action=" {{ route('Progress Reports Save', ['id' => $id, 'prog_id' => $prog_id]) }}" method="POST">
            @csrf
            <div class="form-row align-items-center">
                <div class="col-sm-auto my-1">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <div class="input-group-text">Period From</div>
                      </div>
                      <input class="form-control input-sm month_range_start" placeholder="Start" maxlength="10" required="required" name="prog_start" id="prog_start" type="text" value="">
                    </div>
                </div>
                <div class="col-sm-auto my-1">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Period To</div>
                    </div>
                    <input class="form-control input-sm month_range_end" placeholder="Start" maxlength="10" required="required" name="prog_end" id="prog_end" type="text" value="">
                  </div>
                </div>
              </div>
            </div>  
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-condensed">
                    <thead>
                        <tr>
                            <th class="text-center" rowspan="2" width="1%">#</th>
                            <th class="text-center" rowspan="2">
                                Target Activities for the Period
                                <br>
                                (Relate to Form 2B-1)
                            </th>
                            <th class="text-center" rowspan="2">
                                Actual Accomplishment
                            </th>
                            <th class="text-center" colspan="2">
                                Percentage Accomplishment
                            </th>
                            <th class="text-center" rowspan="2">
                                Project Expenditures for the Period
                            </th>
                            <th class="text-center" rowspan="2">
                                Remarks
                            </th>
                            <tr>
                                <th class="text-center">
                                    For Period
                                </th>
                                <th class="text-center">
                                    Cumulative<br>(from the start)
                                </th>
                            </tr>
                        </tr>
                    </thead> 
                    <tbody>
                    @foreach ($targets as $target)
                    @if ($target->prjprogtarget_category == 1)
                        <tr>
                            <td class="nowrap text-c">{{ ++$i }}</td>
                            <td class="text-wrap" colspan="6">
                                {{ $target->prjprogtarget_target }}
                            </td>
                        </tr>
                    @else
                        <tr class="">
                            <td class="nowrap text-c">{{ ++$i }}</td>
                            <td class="text-wrap">{{ $target->prjprogtarget_target }}</td>
                            <td>
                                <textarea class="form-control" name="{{ $target->prjprogtarget_id }}_accomplishment[]" id="{{ $target->prjprogtarget_id }}_accomplishment" rows="3"></textarea>
                            </td>
                            <td class="nowrap">
                                <div class="input-group input-group-sm">
                                    <input type="number" name="{{ $target->prjprogtarget_id }}_percentage[]" id="{{ $target->prjprogtarget_id }}_percentage" min="0" step="1" maxlength="66" class="form-control" value="">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                      </div>
                                </div>
                            </td>
                            <td class="nowrap">
                                <div class="input-group input-group-sm">
                                    <input type="number" name="{{ $target->prjprogtarget_id }}_cummulative[]" id="{{ $target->prjprogtarget_id }}_cummulative" min="0" step="1" maxlength="66" class="form-control" value="">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                      </div>
                                </div>
                            </td>
                            <td class="nowrap">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Php</span>
                                      </div>
                                      <input type="text" class="form-control" id="{{ $target->prjprogtarget_id }}_expenditure[]" name="{{ $target->prjprogtarget_id }}_expenditure">
                                </div>
                            </td>
                            <td>
                                <textarea class="form-control" name="{{ $target->prjprogtarget_id }}_remarks[]" id="{{ $target->prjprogtarget_id }}_remarks" rows="3"></textarea>
                            </td>
                        </tr>
                    @endif
                    <input type="hidden" name="prjprogtarget_id[]" value="{{ $target->prjprogtarget_id }}">
                    @endforeach
                    </tbody>
                </table>
            <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">
        </form>
    </div>
</div>
<script type="text/javascript"> 
    $(document).ready(function() {

    var datastart = $('.month_range_start').val() != "" ? new Date($('.month_range_start').val()) : false;
    var dateend = $('.month_range_end').val() != "" ? new Date($('.month_range_end').val()) : false;

        $('.month_range_start').datetimepicker({
        format: "MM-YYYY",
        
        maxDate: dateend,
        });
    
        $('.month_range_end').datetimepicker({
        useCurrent: false, //Important! See issue #1075
        minDate: datastart,
        format: "MM-YYYY",
       
        });
    
    $(".month_range_start").on("dp.change", function (e) {
      $('.month_range_end').data("DateTimePicker").minDate(e.date);
    });      
    
    $(".month_range_end").on("dp.change", function (e) {
        $('.month_range_start').data("DateTimePicker").maxDate(e.date);
    });

    
});
</script>
@endsection

{{-- <div class="d-flex align-content-start">
                <div class="form-group form-group-sm d-flex">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                      </div>
                </div>
                <div class="form-group form-group-sm  d-flex">
                    <label for="fr_start" class="control-label mr-2"><Strong>Period To</Strong></label>
                    <input class="form-control input-sm month_range_end" placeholder="Start" maxlength="10" required="required" name="fr_end" id="fr_end" type="text" value="">
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label for="sp_id" class="control-label"><Strong>Service Provider *</Strong></label>
                <select class="form-control input-sm" id="sp_id" name="sp_id">
                <option value=""></option>
                </select>
            </div>
            <div class="form-group form-group-sm">
                <label for="cal_parameters" class="control-label"><Strong>Date</Strong></label>
                <input class="form-control input-sm date-picker" placeholder="Date Tagged" maxlength="10" name="eqp_date_tagged" id="eqp_date_tagged" type="text" value="">
            </div>
            <div class="form-group form-group-sm">
                <label for="cal_no_tests_free" class="control-label"><Strong></Strong></label>
                <input class="form-control input-sm" placeholder="No. of Non-Payed Services Rendered" min="0" step="1" required="required" name="cal_no_tests_free" id="cal_no_tests_free" type="number" value="">
            </div> --}}