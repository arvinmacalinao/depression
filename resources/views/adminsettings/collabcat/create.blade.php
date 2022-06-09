@extends('./layouts.app', ['title' => 'Collaborating Agency Categories'])

@section('content')
<div class="container-fluid mt-3">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('status') }}
        </div>
        @elseif(session('failed'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('failed') }}
        </div>
    @endif  

    <form action="{{route('collabcategories.store')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>Collaborating Agency Categories (Add)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('collabcategories') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>
            <div class="form-group">
                <label for="ot_name">Category Name *</label>
                <input type="text" class="form-control" name="ot_name" id="ot_name" aria-describedby="ot_name">
                @error('ot_name')
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