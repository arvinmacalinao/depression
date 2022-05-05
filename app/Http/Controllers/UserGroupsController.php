<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\UGroup;
use App\Models\UGRegion;
use App\Models\UGProvince;
use App\Models\UserGroups;
use App\Models\UserRights;
use Illuminate\Http\Request;
use App\Models\StoreUserGroup;
use App\Models\UserGroupRights;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserGroupsController extends Controller
{
    public function index(){

        $sel_regions = UGRegion::select('region_text', 'region_id')
            ->orderBy('region_text', 'ASC')
            ->get();
        $sel_provinces = UGProvince::select('province_name', 'province_id')
            ->orderBy('province_name', 'ASC')
            ->get();
        $d_usergroups = UserGroups::orderBy('ug_name', 'ASC')
            ->get();

        return view('usergroups.index', compact('sel_regions','sel_provinces', 'd_usergroups'));
    }

    public function create(){
        $sel_regions = UGRegion::select('region_text', 'region_id')
        ->orderBy('region_text', 'ASC')
        ->get();
        $sel_provinces = UGProvince::select('province_name', 'province_id')
            ->orderBy('province_name', 'ASC')
            ->get();
        $d_usergroups = UserGroups::orderBy('ug_name', 'ASC')
            ->get();
        $c_userrights = UserRights::orderBy('ur_name', 'ASC')
            ->get();
        $ug_rights = UserGroupRights::orderBy('ug_id', 'ASC')
            ->orderBy('ur_id', 'ASC')
            ->get();
        $ug_users = Users::orderBy('u_name', 'ASC')
            ->get();        
        
        return view('usergroups.create', compact('sel_regions','sel_provinces', 'd_usergroups', 'c_userrights', 'ug_rights', 'ug_users'));

    }

    public function store(Request $request){
        $rules = [
			'ug_name' => 'required|string|min:3|max:255',
			'ug_display_name' => 'required|string|min:3|max:255',
			'region_id' => 'required|string||max:255',
            'province_id' => 'required|string|max:255',
            'ug_parent_id' => 'required|string|max:255',
            'ug_unit_head' => 'required|string|max:255',
            'copy_rights' => 'required|string|max:255'
		];

        $messages = [
            'ug_name.required' => 'Group Name field is required.',
            'ug_display_name.required' => 'Short Display Name field is required.',
            'ug_parent_id.required' => 'Parent field is required.',
            'ug_unit_head.required' => 'Unit Head field is required.',
        ];


        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('usergroups/create')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
			try{
				$usergroup_data = new StoreUserGroup;

                $usergroup_data->ug_name = $data['ug_name'];
                $usergroup_data->ug_display_name = $data['ug_display_name'];
                $usergroup_data->region_id = $data['region_id'];
                $usergroup_data->province_id = $data['province_id'];
                $usergroup_data->ug_parent_id = $data['ug_parent_id'];
                $usergroup_data->ug_unit_head = $data['ug_unit_head'];
                if($request->has('ug_is_admin')){
                    //Checkbox checked
                    $usergroup_data->ug_is_admin = $data['ug_is_admin'];
                }else{
                    $usergroup_data->ug_is_admin = '0';
                }
                
				$usergroup_data->save();

                $lastId = $usergroup_data->id;
                
                $urid=$request->get('ur_id');

                foreach($urid as $urids){
            
                    $usgright_data = new UserGroupRights;
                    $usgright_data->ug_id = $lastId;
                    $usgright_data->ur_id = $urids;

                    if($request->get('ur'.$urids.'_view')){
                        $usgright_data->ugr_view = $request->get('ur'.$urids.'_view');
                    }else{
                        $usgright_data->ugr_view = 0;
                    }

                    if($request->get('ur'.$urids.'_add')){
                        $usgright_data->ugr_add = $request->get('ur'.$urids.'_add');
                    }else{
                        $usgright_data->ugr_add = 0;
                    }

                    if($request->get('ur'.$urids.'_edit')){
                        $usgright_data->ugr_edit = $request->get('ur'.$urids.'_edit');
                    }else{
                        $usgright_data->ugr_edit = 0;
                    }

                    if($request->get('ur'.$urids.'_delete')){
                        $usgright_data->ugr_delete = $request->get('ur'.$urids.'_delete');
                    }else{
                        $usgright_data->ugr_delete = 0;
                    }

                    $usgright_data->save();
                }

				return redirect('usergroups/create')->with('status',"Saved Successfully");
                
			}
			catch(Exception $e){
				return redirect('usergroups/create')->with('failed',"operation failed");
			}           
        }
    }

    public function edit($id){

            $show = UGroup::with('usergrouprights')->find($id);
            
            $sel_regions = UGRegion::select('region_text', 'region_id')
                ->orderBy('region_text', 'ASC')
                ->get();
            $sel_provinces = UGProvince::select('province_name', 'province_id')
                ->orderBy('province_name', 'ASC')
                ->get();
            $d_usergroups = UGroup::orderBy('ug_name', 'ASC')
                ->get();
            $c_userrights = UserRights::orderBy('ur_name', 'ASC')
                ->get();
            $ug_users = Users::orderBy('u_name', 'ASC')
                ->get(); 
            // $ug_rights = UserGroupRights::select()
            
            return view('usergroups.edit', compact('show', 'sel_regions', 'sel_provinces', 'd_usergroups', 'ug_users', 'c_userrights'));
    }

    public function getChkData(){
        $select_id = $_GET['select_id'];

        $chkDatas = UserGroupRights::select('ur_id', 'ugr_view', 'ugr_add', 'ugr_edit', 'ugr_delete')
            ->where('ug_id', '=', $select_id)
            ->get();

            return $chkDatas;
    }

}
