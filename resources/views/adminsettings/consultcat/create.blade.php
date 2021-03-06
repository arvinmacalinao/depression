@extends('./layouts.app', ['title' => 'Consultancy Categories'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('consultcategory.store')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Consultancy Categories (Add)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('consultcategory') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="con_type_name">Category Name *</label>
                <input type="text" class="form-control" name="con_type_name" id="con_type_name" aria-describedby="ot_name">
                @error('con_type_name')
                    <div class="alert alert-danger p-1">{{ $message }}</div>
                @enderror
            </div>
            <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">
            </form>           
        </div>
    </div>
    </form>

</div>
@endsection