@extends('./layouts.app', ['title' => 'Organization Categories (Edit)'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('organizationcategories.update', $show_organ->ot_cat1_id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Organization Categories (Edit)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('organizationcategories') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="ot_name">Category Name *</label>
                <input type="text" class="form-control" name="ot_cat1_name" id="ot_cat1_name" aria-describedby="ot_cat1_name" value="{!! $show_organ->ot_cat1_name !!}">
                @error('ot_cat1_name')
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