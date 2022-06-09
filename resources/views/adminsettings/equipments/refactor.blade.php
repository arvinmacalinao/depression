@extends('./layouts.app', ['title' => 'Equipment Names (Refactor)'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('equipmentnames.refupdate', $show_eqrefrac->brand_id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Equipment Names (Refactor)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('equipmentnames') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>


            <div class="form-group">
                <label for="old"> <b>Category to Replace (Old)</b> </label>
                <select class="form-control input-sm" id="sr_cat_old" name="sr_cat_old">
                    @foreach($sel_eqs as $sel_eq)
                        <option value="{{ $sel_eq->brand_id }}"  {{ ($show_eqrefrac->brand_id == $sel_eq->brand_id) ? 'selected' : '' }}>
                            {{$sel_eq->brand_name }}
                        </option>
                    @endforeach
                </select>
                @error('doctype_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="new"> <b>Replacement Category (New)</b> </label>
                <select class="form-control input-sm" id="sr_cat_new" name="sr_cat_new">
                    @foreach($sel_eqs as $sel_eq)
                        <option value="{{ $sel_eq->brand_id }}"  {{ ($show_eqrefrac->brand_id == $sel_eq->brand_id) ? 'selected' : '' }}>
                            {{$sel_eq->brand_name }}
                        </option>
                    @endforeach
                </select>
                @error('doctype_abbr')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="chk_refac" name="chk_refac">
                <label class="form-check-label" for="defaultCheck1">
                    <div class="text-danger">
                        I acknowledge that I will be solely responsible of the consequences of this action.
                    </div>
                </label>
            </div>


            <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">
            </form>           
        </div>
    </div>
    </form>
</div>

<script>
    $('#save').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to refactor this record?`,
              text: "Double think your decision",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willRefactor) => {
            if (willRefactor) {
              form.submit();
            }
          });
      });
</script>
@endsection