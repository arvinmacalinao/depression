<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use App\Models\Province;
use App\Models\UserGroup;
use App\Models\UserRight;
use Illuminate\Http\Request;
use App\Models\UserGroupRight;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $region_id = $request->input('region_id');
        $province_id = $request->input('province_id');
        $ug_name = $request->input('ug_name');

        $sel_ugs = UserGroup::Region($region_id)->Province($province_id)->UserGroup($ug_name)
        ->orderBy('ug_name', 'ASC')->get();        

        $sel_regions = Region::orderBy('region_code', 'ASC')->get();
        $sel_provinces = Province::orderBy('province_name', 'ASC')->get();

        return view('adminsettings/usergroups.index', compact('sel_ugs','sel_regions','sel_provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $show_ug = UserGroup::findOrFail($id);
        $sel_regions = Region::orderBy('region_code', 'ASC')->get();
        $sel_provinces = Province::orderBy('province_name', 'ASC')->get();
        $sel_usergroups = UserGroup::orderBy('ug_name', 'ASC')->get();
        $ug_users = User::orderBy('u_fname', 'ASC')->get();
        $usergroup_rights = UserGroupRight::where('ug_id', $id)->get();
        $default_rights = UserRight::orderBy('ur_name')->get();
        return view('adminsettings/usergroups.edit', compact('default_rights','show_ug','sel_regions','sel_provinces','sel_usergroups','ug_users','usergroup_rights'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $default_rights = UserRight::orderBy('ur_name')->get();
        $rights =  $default_rights->urights->get();   

        foreach($rights as $right) {
            $right->ugr_view = $request->has('ur'.$right->ur_id.'_view');
            if($right->ugr_view == 'false'){
                $right->ugr_view = '0';
            }else{
                $right->ugr_view = '1';
            }
            $right->save();
        }

        return redirect('usergroups')->with('status',"User Group Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getURData(){
        $data_id = $_GET['data_id'];
        
        $data_ids = UserGroupRight::where("ug_id", "=", $data_id)
        ->get();

        return $data_ids;
    }
}
