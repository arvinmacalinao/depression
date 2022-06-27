@extends('./layouts.app', ['title' => 'Project Categories (Edit)'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('projectcategories.update', $show_projtypes->prj_type_id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Project Categories (Edit)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('projectcategories') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">

            <div class="form-group">
                <label for="prj_type_name"> <b>Category Name *</b> </label>
                <input type="text" class="form-control" name="prj_type_name" id="prj_type_name" aria-describedby="prj_type_name" value="{!! $show_projtypes->prj_type_name !!}">
                @error('prj_type_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="h_section_ids" class="control-label"> <b>Project Sections *</b> </label>
                    <select class="form-control input-sm chosen-select" id="h_section_ids" name="h_section_ids[]" multiple="multiple">
                    
                    @foreach($sel_prjsections as $sel_prjsection)
                            <option value="{{ $sel_prjsection->section_id }}" {{ ($sel_prjsection->section_id ==  in_array($sel_prjsection->section_id,$exSel_prjsections)) ? 'selected' : '' }}>
                                {{$sel_prjsection->section_name }}
                            </option>
                    @endforeach
                    </select>
                    @error('section_ids')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
            </div>

            <div class="form-group">
                <label for="h_doctype_ids" class="control-label"> <b>Required Documents *</b> </label>
                    <select class="form-control input-sm chosen-select" id="h_doctype_ids" name="h_doctype_ids[]" multiple="multiple">
                    
                    @foreach($sel_prjdoctypes as $sel_prjdoctype)
                            <option value="{{ $sel_prjdoctype->doctype_id }}" {{ ($sel_prjdoctype->doctype_id ==  in_array($sel_prjdoctype->doctype_id,$exSel_prjdocu)) ? 'selected' : '' }}>
                                {{$sel_prjdoctype->doctype_name }}
                            </option>
                    @endforeach
                    </select>
                    @error('doctype_ids')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
            </div>

            <input class="btn btn-primary btn-block" type="submit" name="update" id="update" value="Update">   
            <input type="hidden" name="section_ids" id="section_ids" value="">   
            <input type="hidden" name="doctype_ids" id="doctype_ids" value="">    
            <input type="hidden" name="doctype_names" id="doctype_names" value="">   
            <input type="hidden" name="section_names" id="section_names" value="">   
        </div>
    </div>
    </form>
</div>

<script>
    $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
    $('.chosen-select').on('change', function(e) {
        var sec_ids = $("#h_section_ids").chosen().val()
        var doc_ids = $("#h_doctype_ids").chosen().val()

        let text_sec_ids = sec_ids.toString();
        let text_doc_ids = doc_ids.toString();

        document.getElementById("section_ids").setAttribute('value',text_sec_ids);
        document.getElementById("doctype_ids").setAttribute('value',text_doc_ids);
    });
    var sec_ids = $("#h_section_ids").chosen().val()
    var doc_ids = $("#h_doctype_ids").chosen().val()

    let text_sec_ids = sec_ids.toString();
    let text_doc_ids = doc_ids.toString();

    document.getElementById("section_ids").setAttribute('value',text_sec_ids);
    document.getElementById("doctype_ids").setAttribute('value',text_doc_ids);

    $('#h_section_ids').ready(function(){
        var val = [];
    	$('#h_section_ids').find('option:selected').each(function(){
      	text = $(this).text();
        result = text.trim();
        val.push(result);
      });
      
      document.getElementById("section_names").setAttribute('value',val.join(','));
    });

    $('#h_section_ids').on('change', function(e) {
        var val = [];
    	$('#h_section_ids').find('option:selected').each(function(){
      	text = $(this).text();
        result = text.trim();
        val.push(result);
      });
      
      document.getElementById("section_names").setAttribute('value',val.join(','));
    });
    

    $('#h_doctype_ids').ready(function(){
        var val = [];
    	$('#h_doctype_ids').find('option:selected').each(function(){
      	text = $(this).text();
        result = text.trim();
        val.push(result);
      });
      
      document.getElementById("doctype_names").setAttribute('value',val.join(','));
    });

    $('#h_doctype_ids').on('change', function(e) {
        var val = [];
    	$('#h_doctype_ids').find('option:selected').each(function(){
      	text = $(this).text();
        result = text.trim();
        val.push(result);
      });
      
      document.getElementById("doctype_names").setAttribute('value',val.join(','));
    });
</script>
@endsection