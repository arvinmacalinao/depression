@extends('./layouts.app', ['title' => 'Collaborating Agency Categories'])

@section('content')
<div class="container-fluid mt-3">
<form action="{{route('collabagency.store')}}" method="post">
    @csrf
    <div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h2>Collaborating Agencies (Add)</h2>
            <div></div>
                <div id="buttonz">
                    <a href="{{ URL::to('collabagency') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                </div>
        </div> 
    </div>
        <div class="card-body">
            <div class="form-group">
                <label for="ot_name"> <b>Category</b> </label>
                    <select class="form-control input-sm" id="sr_category" name="sr_category">
                        @foreach($sel_categories as $sel_category)
                            <option value="{{ $sel_category->ot_id }}">
                                {{ $sel_category->ot_name }}
                            </option>
                        @endforeach
                    </select>
            </div>

            <div class="form-group">
                <label for="ot_name"><b>Agency Name *</b></label>
                <input type="text" class="form-control" name="col_name" id="col_name" aria-describedby="col_name" value="">
                @error('col_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="ot_name"> <b>Abbreviation * </b> </label>
                <input type="text" class="form-control" name="col_abbr" id="col_abbr" aria-describedby="col_abbr" value="">
                @error('col_abbr')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>
            <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">
        </div>
    </div>
</form>
</div>
@endsection