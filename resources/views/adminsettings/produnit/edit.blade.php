@extends('./layouts.app', ['title' => 'Product Units (Edit)'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('productunits.update', $show_prod->unit_id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Product Units (Edit)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('productunits') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="unit_name">Unit Name *</label>
                <input type="text" class="form-control" name="unit_name" id="unit_name" aria-describedby="unit_name" value="{!! $show_prod->unit_name !!}">
            </div>
            <input class="btn btn-primary btn-block" type="submit" name="update" id="update" value="Update">
            </form>           
        </div>
    </div>
    </form>
</div>
@endsection