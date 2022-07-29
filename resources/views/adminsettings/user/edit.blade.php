@extends('./layouts.app', ['title' => 'User'])

@section('content')
<div class="container-fluid mt-3">

    <form action="{{route('users.update', $show_user->u_id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                    <h2>User (Edit)</h2>
                    <div></div>
                        <div id="buttonz">
                            <a href="{{ URL::to('users') }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
                        </div>
                </div>  
        </div>
        <div class="card-body">
            <form>


                <div class="form-group form-group-sm">
                    <label for="region_id" class="control-label"><b>Region</b></label>
                    <select class="form-control input-sm @error('region_id') is-invalid @enderror" id="region_id" name="region_id">
                        @foreach($sel_regions as $sel_region)
                            <option value="{{ $sel_region->region_id }}"  {{ ( $sel_region->region_id == $show_user->region_id ) ? 'selected' : '' }}>{!!  $sel_region->region_code !!} ({!!  $sel_region-> region_name !!})</option>
                        @endforeach 
                    </select>
                        @error('region_id')
                            <div class="alert alert-danger p-1">{{ $message }}</div>
                        @enderror
                </div>

                <div class="form-group form-group-sm">
                    <label for="ug_id" class="control-label"><b>Usergroup</b></label>
                    <select class="form-control input-sm @error('ug_id') is-invalid @enderror" id="ug_id" name="ug_id">
                        @foreach($sel_ugs as $sel_ug)
                            <option value="{{ $sel_ug->ug_id }}" {{ ( $sel_ug->ug_id == $show_user->ug_id ) ? 'selected' : '' }}>{{ $sel_ug->ug_name }}</option>
                        @endforeach 
                    </select>
                        @error('ug_id')
                            <div class="alert alert-danger p-1">{{ $message }}</div>
                        @enderror
                </div>

                <div class="form-group form-group-sm">
                    <label for="u_fname"> <b>First Name *</b> </label>
                    <input type="text" class="form-control" placeholder="First Name" name="u_fname" id="u_fname" aria-describedby="u_fname" value="{{ $show_user->u_fname }}">
                    @error('u_fname')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group-sm">
                    <label for="u_mname"> <b>Middle Name *</b> </label>
                    <input type="text" class="form-control" placeholder="Middle Name" name="u_mname" id="u_mname" aria-describedby="u_mname" value="{{ $show_user->u_mname }}">
                    @error('u_mname')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group-sm">
                    <label for="u_lname"> <b>Last Name *</b> </label>
                    <input type="text" class="form-control" placeholder="Last Name" name="u_lname" id="u_lname" aria-describedby="u_lname" value="{{ $show_user->u_lname }}">
                    @error('u_lname')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group-sm">
                    <label for="u_email"> <b>Email</b> </label>
                    <input type="email" class="form-control" placeholder="Email" name="u_email" id="u_email" aria-describedby="u_email" value="{{ $show_user->u_email }}">
                    @error('u_email')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group-sm">
                    <label for="u_mobile"> <b>Mobile</b> </label>
                    <input type="text" class="form-control" placeholder="Mobile" name="u_mobile" id="u_mobile" aria-describedby="u_mobile" value="{{ $show_user->u_mobile }}">
                    @error('u_mobile')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group-sm">
                    <label for="u_username"> <b>Username *</b> </label>
                    <input type="text" class="form-control" placeholder="Username" name="u_username" id="u_username" aria-describedby="u_username" value="{{ $show_user->u_username }}">
                    @error('u_username')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group-sm">
                    <label for="u_password"> <b>Password *</b> </label>
                    <input type="password" class="form-control" placeholder="Password" name="u_password" id="u_password" aria-describedby="u_password">
                    @error('u_password')
                        <div class="alert alert-danger p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-group-sm">
                    <label for="confirm_password" class="control-label"> <b>Confirm Password *</b> </label>
                    <input class="form-control input-sm" placeholder="Confirm Password" maxlength="255" name="confirm_password" id="confirm_password" type="password" value="">
                </div>

                <div class="form-group form-group-sm">
                    <label>
                        <input type="checkbox" name="u_coordinator" id="u_coordinator" value="1" {{ ( $show_user->u_coordinator == '1') ? 'checked' : '' }}>  <b>Project Coordinator/Leader</b> 
                    </label>
                </div>

                <div class="form-group form-group-sm">
                    <label>
                        <input type="checkbox" name="u_head" id="u_head" value="0" {{ ( $show_user->u_head == '1') ? 'checked' : '' }}>  <b>Agency Head or Authorized Representative</b> 
                    </label>
                </div>

                <div class="form-group form-group-sm">
                    <label>
                        <input type="checkbox" name="u_enabled" id="u_enabled" value="1" {{ ( $show_user->u_enabled == '1') ? 'checked' : '' }}> <b>Account Enabled</b>
                    </label>
                </div>


            <input class="btn btn-primary btn-block" type="submit" name="update" id="update" value="Update">
            </form>           
        </div>
    </div>
    </form>
</div>

@endsection