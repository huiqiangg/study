<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleUser;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth.admin:admin');
    }

    //
    public function index()
    {
        $user=Auth::guard('admin')->user();
        $role_user=new RoleUser();
        $roles=$role_user->select('role_id')->where('user_id',$user->id)->get();
        $roleKey = [];
        foreach ($roles as $role) {
            $roleKey[] = $role->role_id;
        }
        $permission_roles=DB::table('permission_role')->select('permission_id')->whereIn('role_id',$roleKey)->get();
        foreach ($permission_roles as $v) {
            $permissions[] = $v->permission_id;
        }
        $user_persion=new Permission();
        $display_names=$user_persion->select('name','display_name')->where('pid',0)->whereIn('id',$permissions)->distinct()->get();
        return view('/admin/home',compact('display_names'));
    }

}
