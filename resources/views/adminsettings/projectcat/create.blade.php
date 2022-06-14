@extends('./layouts.app', ['title' => 'Project Categories'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('projectcategories.store')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Project Categories (Add)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('projectcategories') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>

            <div class="form-group">
                <label for="prj_type_name"> <b>Category Name *</b> </label>
                <input type="text" class="form-control" name="prj_type_name" id="prj_type_name" aria-describedby="prj_type_name">
                @error('prj_type_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="section_ids" class="control-label"> <b>Project Sections *</b> </label>
                    <select class="form-control input-sm chosen-select" id="section_ids" name="section_ids[]" multiple="multiple">
                    
                    @foreach($sel_prjsections as $sel_prjsection)
                            <option value="{{ $sel_prjsection->section_id }}">
                                {{$sel_prjsection->section_name }}
                            </option>
                    @endforeach
                    </select>
                    @error('section_ids')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
            </div>

            <div class="form-group">
                <label for="doctype_ids" class="control-label"> <b>Required Documents *</b> </label>
                    <select class="form-control input-sm chosen-select" id="doctype_ids" name="doctype_ids[]" multiple="multiple">
                    
                    @foreach($sel_prjdoctypes as $sel_prjdoctype)
                            <option value="{{ $sel_prjdoctype->doctype_id }}">
                                {{$sel_prjdoctype->doctype_name }}
                            </option>
                    @endforeach
                    </select>
                    @error('doctype_ids')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
            </div>

            <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">
            <input type="hidden" name="doctype_names" id="doctype_names" value="">   
            <input type="hidden" name="section_names" id="section_names" value="">   
            </form>           
        </div>
    </div>
    </form>

</div>

<script>
    $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});

    $('#section_ids').on('change', function(e) {
        var val = [];
    	$('#section_ids').find('option:selected').each(function(){
      	text = $(this).text();
        result = text.trim();
        val.push(result);
      });
      document.getElementById("section_names").setAttribute('value',val.join(','));
    });

    $('#doctype_ids').on('change', function(e) {
        var val = [];
    	$('#doctype_ids').find('option:selected').each(function(){
      	text = $(this).text();
        result = text.trim();
        val.push(result);
      });
      document.getElementById("doctype_names").setAttribute('value',val.join(','));
    });
</script>
@endsection