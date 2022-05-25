@extends('./layouts.app')

@section('content')
<div class="container-fluid">
@include('projects.details.details')
<div class="card">
    <div class="card-header">
        <h3>Project PIS Add
            <div class="pull-right">
                <a href="{{ URL::previous() }}" class="projectdetails-btn pr"><span class="fa fa-arrow-circle-left"> Back</a>
            </div>
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('Product Save', ['id' => $id, 'pis_id' => $pis_id]) }}" method="POST">
            @csrf
            <div class="card mb-3">
                <div class="card-header">
                    
                    <div class="row mb-2 mt-2">
                        <div class="form-group col-sm-6">
                            <label for="prjpis_year" class="control-label">Year *</label>
                            <input class="form-control input-sm" placeholder="2022" maxlength="4" min="1800" max="2022" name="prjpis_year" id="prjpis_year" type="number" value="">
                            {{-- {{ old('prjpis_year', $pis->prjpis_year) }} --}}
                        </div>
                        <div class="form-group form-group-sm col-sm-6">
                            <label for="sem_id" class="control-label">Semester</label>
                            <select class="form-control input-sm" id="sem_id" name="sem_id">
                                {{-- @foreach ($sel_pis_semesters as $sem)
                                <option value="{{ $sem->sem_id }}" {{ old('sem_id', $pis->sem_id) == $sem->sem_id ? 'selected' : '' }}>{{ $sem->semester->sem_name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Save">
        </form>
    </div>
</div>
@endsection