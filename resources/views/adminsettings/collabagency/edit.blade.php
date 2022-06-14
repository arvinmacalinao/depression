@extends('./layouts.app', ['title' => 'Collaborating Agencies'])

@section('content')
<div class="container-fluid mt-3">
<form action="{{route('collabagency.update', $show_agency->col_id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h2>Collaborating Agencies (Edit)</h2>
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
                            <option id="{{ $sel_category->ot_id }}" {{ ($show_agency->ot_id == $sel_category->ot_id) ? 'selected' : '' }}>
                                {{ $sel_category->ot_name }}
                            </option>
                        @endforeach
                    </select>
            </div>

            <div class="form-group">
                <label for="ot_name"><b>Agency Name *</b></label>
                <input type="text" class="form-control" name="col_name" id="col_name" aria-describedby="col_name" value="{{ $show_agency->col_name }}">
            </div>

            <div class="form-group">
                <label for="ot_name"> <b>Abbreviation * </b> </label>
                <input type="text" class="form-control" name="col_abbr" id="col_abbr" aria-describedby="col_abbr" value="{{ $show_agency->col_abbr }}">
            </div>
            <input class="btn btn-primary btn-block" type="submit" name="update" id="update" value="Update">
        </div>
    </div>
</form>
</div>
@endsection