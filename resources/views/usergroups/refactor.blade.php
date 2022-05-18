@extends('./layouts.app', ['title' => 'Refactor'])

@section('content')

<div class="container-fluid mt-3">
    <div class="card">
        <div class="card-header">
             <h3>Implementor Refactoring</h3> 
        </div>

        <div class="alert alert-warning" role="alert">
            <h4>Read me 3X !!!</h4>
            <p>This tool is used to replace the implementors of all records of selected tables with the chosen replacement usergroups. <br>
            This too was created to aid in removing usergroups. <br>
            Usergroups prefixed with "Laboratory-" are now depreciated and should be replaced/removed. <br>
            Please add replacement "PSTC-" or "RO-" usergroups beforehand. <br>
            Please make sure to backup the database before refactoring.</p>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <th class="text-center">Original Implementor</th>
                    <th class="text-center">Replacement Implementor</th>
                </thead>

                <tbody>
                    <tr>
                        <td class="text-center">
                            <select class="form-control input-sm" id="ug1" name="ug1">
                            @foreach($d_usergroups as $d_usergroup)
                                <option value="{{ $d_usergroup->ug_id }}">{{ $d_usergroup->ug_name }}</option>
                            @endforeach
                            </select>
                        </td>
                        <td class="text-center">
                            <select class="form-control input-sm" id="ug2" name="ug2">
                            @foreach($d_usergroups as $d_usergroup)
                                <option value="{{ $d_usergroup->ug_id }}">{{ $d_usergroup->ug_name }}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                    <th class="text-center">Tables</th>
                    <th class="text-left nowrap" width="100%">
                        Include in Refactoring
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="chk_all_1" title="Check All"> Check All
                            </label>
                        </div>
                    </th>
                </thead>

                <tbody>
                @foreach($g_tables as $g_table)
                        <tr>
                            <td>
                            @if ($g_table->TABLE_NAME == 'vwkpi_average_productivity')
                                @break
                            @endif
                               <b>{{ $g_table->TABLE_NAME }}</b> 
                            </td>
                            <td class="text-left nowrap">
                                <div class="checkbox">
                                    <label>
                                        <input class="chk1" type="checkbox" name="{{ $g_table->TABLE_NAME }}" id="{{ $g_table->TABLE_NAME }}" value="1"> Include Table
                                    </label>
                                </div>
                            </td>
                        </tr>
                @endforeach
                </tbody>

            </table>

        <div class="alert alert-danger" role="danger">
            <h4>Read me 3X !!!</h4>
            <p>This tool is used to replace the implementors of all records of selected tables with the chosen replacement usergroups. <br>
            This too was created to aid in removing usergroups. <br>
            Usergroups prefixed with "Laboratory-" are now depreciated and should be replaced/removed. <br>
            Please add replacement "PSTC-" or "RO-" usergroups beforehand. <br>
            Please make sure to backup the database before refactoring.</p>
        </div>        
        <input class="btn btn-primary btn-block" type="submit" name="save" id="save" value="Refactor">   

        </div>
    </div>
<div>

@endsection