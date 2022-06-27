@extends('./layouts.app', ['title' => 'Schools'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('schools.store')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Schools (Add)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('schools') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>

            <div class="form-group">
                <label for="school_name"> <b>School Name *</b> </label>
                <input type="text" class="form-control" name="school_name" id="school_name" aria-describedby="school_name">
                @error('school_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="school_acronym"> <b>Acronym *</b> </label>
                <input type="text" class="form-control" name="school_acronym" id="school_acronym" aria-describedby="school_acronym">
                @error('school_acronym')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="school_address"> <b>Address </b> </label>
                <input type="text" class="form-control" name="school_address" id="school_address" aria-describedby="school_address">
            </div>

            <div class="form-group">
                <label for="school_coordinator"> <b>Coordinator</b> </label>
                <input type="text" class="form-control" name="school_coordinator" id="school_coordinator" aria-describedby="school_coordinator">
            </div>

            <div class="form-group">
                <label for="school_email"> <b>Email</b> </label>
                <input type="text" class="form-control" name="school_email" id="school_email" aria-describedby="school_email">
            </div>

            <div class="form-group">
                <label for="school_phone"> <b>Phone</b> </label>
                <input type="text" class="form-control" name="school_phone" id="school_phone" aria-describedby="school_phone">
            </div>

            <div class="form-group">
                <label for="school_mobile"> <b>Mobile</b> </label>
                <input type="text" class="form-control" name="school_mobile" id="school_mobile" aria-describedby="school_mobile">
            </div>


            <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">

            </form>           
        </div>
    </div>
    </form>
</div>
@endsection