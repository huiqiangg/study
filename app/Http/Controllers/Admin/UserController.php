<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator,DB;
use App\Models\Admin;
use App\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /*
     * 列表页
     */
    public function index(Request $request)
    {
        $users = Admin::getList($condition=[],$request->all());
        return view('admin.user.index', compact('users'));
    }

    /*
     * 添加用户
     */
    public function create()
    {
        $roles= Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /*
     * 保存用户
     */
    public function store(Request $request)
    {
        $user = Admin::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt( $request->get('password') ),
        ]);
        if(!$user){
            return redirect()->back()->withInput();
        }
        if($request->has('role_id')){
            foreach ($request->input('role_id') as $key => $value) {
                $user->attachRole($value);
            }
        }
        return redirect()->back()->with('status',1);
    }

    /*
     * 更新显示页面
     */
    public function edit($id)
    {
        $user=Admin::find($id);
        $selected_roles = [];
        $roles = DB::table('role_user')->where('user_id', '=', $id)->get();
        foreach ($roles as $value) {
            $selected_roles[$value->role_id] = 1;
        }
        $roles=Role::all();
        return view('admin.user.edit',compact('roles','user','selected_roles'));
    }
    /*
     * 更新用户信息
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->only(['password', 'password_confirmation']),[
            'password'=>'min:6|confirmed',
            'password_confirmation'=>'min:6'
        ],[
            'password.min' => '密码不能少于6位',
            'password_confirmation.min' => '密码不能少于6位',
            'password.confirmed' => '确认密码与密码不一致',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $user = Admin::find($id);
        if($request->has('password')){
            $user->password = bcrypt( $request->get('password') );
            $user->save();
        }

        //删除角色重新赋值
        DB::table('role_user')->where('user_id', '=', $id)->delete();
        if($request->has('role_id')){
            foreach ($request->input('role_id') as $key => $value) {
                $user->attachRole($value);
            }
        }

        return redirect()->back()->with('status',1);
    }
    public function delete($id)
    {
        $user = Admin::find($id);
        if($user){
            $user->delete();
        }

        return redirect()->back()->with('status',1);
    }

   public function white()
{
    return view('layouts.white');
}
}
