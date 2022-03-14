@extends('./layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header container-fluid">
            <h3>Projects</h3>
            <div class="pull-right">
            <a id="print-list-btn" name="print-list-btn" class="btn btn-success btn-sm" href="" title="Print List"><span class="fa fa-print"></span> Print</a>
            <a id="download-list-btn" name="download-list-btn" class="btn btn-success btn-sm" href="" title="Download List"><span class="fa fa-floppy-o"></span> Download</a>
            <a class="btn btn-primary btn-sm" href="" title="Add Projects"><span class="fa fa-plus"></span> Add Projects</a>
        </div>
            
        </div>
        <div class="card-body">
        </div>
    </div>
</div>


@endsection()