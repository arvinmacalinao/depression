<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ug_id = $request->input('ug_id');
        $region_id = $request->input('region_id');
        $user_search = $request->input('user_search');

        $sel_users = User::UserSearch($user_search)->UserGroup($ug_id)->Region($region_id)
        ->orderBy('u_username', 'ASC')->get();

        $sel_ugs = UserGroup::orderBy('ug_name', 'ASC')->get();
        $sel_regions = Region::orderBy('region_code', 'ASC')->get();

        return view('adminsettings/user.index', compact('sel_users','sel_ugs','sel_regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sel_ugs = UserGroup::orderBy('ug_name', 'ASC')->get();
        $sel_regions = Region::orderBy('region_code', 'ASC')->get();

        return view('adminsettings/user.create', compact('sel_ugs','sel_regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'u_fname' => 'required|string|min:3|max:255',
            'u_mname' => 'required|string|min:3|max:255',
            'u_lname' => 'required|string|min:3|max:255',
            'u_email' => 'required|string|min:3|max:255',
            'u_mobile' => 'required|string|min:3|max:255',
            'u_username' => 'required|string|min:3|max:255',
            'u_password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password'=> 'min:6'
		];

        $messages = [
            'u_fname.required' => 'First Name field is required.',
            'u_mname.required' => 'Middle Name field is required.',
            'u_lname.required' => 'Last Name field is required.',
            'u_email.required' => 'Email field is required.',
            'u_mobile.required' => 'Mobile field is required.',
            'u_username.required' => 'Username field is required.',
            'u_password.required' => 'Password field is required.',
            'confirm_password.required' => 'Confirm Password field is required.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
			return redirect('users')
			->withInput()
			->withErrors($validator);
		}else{
            $data = $request->input();
            $passwerd = Hash::make($data['u_password']);
            if (empty($data['u_coordinator'])) {
                $u_coordinator = '0';
            }else{
                $u_coordinator = '1';
            }
            if (empty($data['u_head'])) {
                $u_head = '0';
            }else{
                $u_head = '1';
            }
            if (empty($data['u_enabled'])) {
                $u_enabled = '0';
            }else{
                $u_enabled = '1';
            }
			try{
				$users = new User;
                $users->region_id = $data['region_id'];
                $users->ug_id = $data['ug_id'];
                $users->u_fname = $data['u_fname'];
                $users->u_mname = $data['u_mname'];
                $users->u_lname = $data['u_lname'];
                $users->u_email = $data['u_email'];
                $users->u_email = $data['u_mobile'];
                $users->u_username = $data['u_username'];
                $users->u_password = $passwerd;
                $users->u_coordinator = $u_coordinator;
                $users->u_head = $u_head;
                $users->u_enabled = $u_enabled;

				$users->save();
				return redirect('users')->with('status',"Saved Successfully");
			}
			catch(Exception $e){
				return redirect('users')->with('failed',"Operation Failed");
			}           
        }
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
        $show_user = User::findOrFail($id);
        $sel_ugs = UserGroup::orderBy('ug_name', 'ASC')->get();
        $sel_regions = Region::orderBy('region_code', 'ASC')->get();

        return view('adminsettings/user.edit', compact('show_user','sel_ugs','sel_regions'));
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
        $validatedData = $request->validate([
            'region_id' => 'required|string|min:3|max:255',
            'ug_id' => 'required|string|min:3|max:255',
            'u_fname' => 'required|string|min:3|max:255',
            'u_mname' => 'required|string|min:3|max:255',
            'u_lname' => 'required|string|min:3|max:255',
            'u_email' => 'required|string|min:3|max:255',
            'u_mobile' => 'required|string|min:3|max:255',
            'u_username' => 'required|string|min:3|max:255',
        ]);

        User::where("u_id", "=", $id)->update($validatedData);


        return redirect('users')->with('status',"User Updated Successfully"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = User::findOrFail($id);
        $show->delete();

        return redirect('users')->with('status', 'User Deleted');
    }
}
