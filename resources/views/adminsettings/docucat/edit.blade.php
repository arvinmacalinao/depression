@extends('./layouts.app', ['title' => 'Document Categories (Edit)'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('documentcategory.update', $show_doctypecat->doctype_id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Document Categories (Edit)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('documentcategory') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>


            <div class="form-group">
                <label for="doctype_name">Category Name *</label>
                <input type="text" class="form-control" name="doctype_name" id="doctype_name" aria-describedby="doctype_name" value="{!! $show_doctypecat->doctype_name !!}">
                @error('doctype_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="doctype_abbr">Acronym *</label>
                <input type="text" class="form-control" name="doctype_abbr" id="doctype_abbr" aria-describedby="doctype_abbr" value="{!! $show_doctypecat->doctype_abbr !!}">
                @error('doctype_abbr')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>


            <input class="btn btn-primary btn-block" type="submit" name="update" id="update" value="Update">
            </form>           
        </div>
    </div>
    </form>
</div>
@endsection