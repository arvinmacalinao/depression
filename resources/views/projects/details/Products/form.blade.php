@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header">
        <h3>Project Product (Add)
            <div class="pull-right">
                <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Product Save', ['id' => $id, 'prod_id' => $prod_id]) }}" method="POST">
        @csrf
            <div class="form-group form-group-sm">
                <label for="prod_name" class="control-label"><Strong>Product Name *</Strong></label>
                <input class="form-control input-sm" placeholder="Product Name" maxlength="255" required="required" name="prod_name" id="prod_name" type="text" value="{{ old('prod_name', $product->prod_name) }}">
            </div>
            <div class="form-group form-group-sm">
                <label for="unti_id" class="control-label"><Strong>Unit</Strong></label>
                <select class="form-control input-sm" id="unit_id" name="unit_id">
                    @foreach ($sel_units as $unit)
                        <option value="{{ $unit->unit_id }}"{{ old('unit_id', $product->unit_id) == $unit->unit_id ? 'selected' : '' }} >{{ $unit->unit_name }}</option>           
                    @endforeach
                </select>
            </div>
            <input class="save-btn mt-3" type="submit" name="save" id="save" value="Save">
        </form>
    </div>
</div>
@endsection