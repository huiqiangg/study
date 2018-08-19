<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Permission;
use App\Models\Role;
use App\Http\Controllers\Controller;
use DB;

class RoleController extends Controller
{
    /*
     * 角色列表
     */
    public function index(Request $request)
    {
        $condition = $request->all();
        $roles = Role::getList($condition, $request->all());
        return view('admin.role.index', compact('roles'));
    }

    /*
     * 创建角色
     */
    public function create()
    {
        $title = '添加角色';
        $permissions =$this->array_to_tree(Permission::all()->toArray());
        return view('admin.role.create', compact('title','permissions'));
    }

    /*
     * 保存创建的角色
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
            'display_name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => '请填写角色标示符',
            'name.unique' => '角色标示符已经存在',
            'display_name.required' => '请填写角色名称',
            'description.required' => '请填写角色描述',
        ]);

        $role = new Role;
        $role->name = trim($request->get('name'));
        $role->display_name = trim($request->get('display_name'));
        $role->description = trim($request->get('description'));
        $role->save();
        if ($request->has('permission_id')) {
            $role->perms()->sync($request->get('permission_id'));
        }

        return redirect()->back()->with('status', 1);
    }

    /*
     * 修改角色
     */
    public function edit($id)
    {
        //获取角色名
        $title='修改角色';
        $role = Role::find($id);
        // 获取全部权限, 用来判断那些全选选中了
        $permissions = DB::table('permission_role')->where('role_id', '=', $id)->get();
        $selected_permissions = [];
        foreach ($permissions as $value) {
            $selected_permissions[$value->permission_id] = 1;
        }
        $permissions=$this->array_to_tree(Permission::all()->toArray());
        return view('admin.role.edit', compact('title','role','permissions','selected_permissions'));
    }

    /*
     * 保存修改
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $id,
            'display_name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => '请填写角色标示符',
            'name.unique' => '角色标示符已经存在',
            'display_name.required' => '请填写角色名称',
            'description.required' => '请填写角色描述',
        ]);

        // 检查角色是否存在
        $role = Role::where('id', '=', $id)->first();
        if (empty($role)) {
            return redirect()->back()->withErrors(['errorMsg' => '找不到该角色'])->withInput();
        }
        if ($role->name == 'admin') {
            return redirect()->back();
        }
        $role->name = trim($request->get('name'));
        $role->display_name = trim($request->get('display_name'));
        $role->description = trim($request->get('description'));
        $role->save();

        // 删除权限重新赋值
        DB::table('permission_role')->where('role_id', '=', $id)->delete();
        if ($request->has('permission_id')) {
            $role->perms()->sync($request->get('permission_id'));
        }

        return redirect()->back()->with('status', 1);
    }

    /*
     * 删除角色
     */
    public function delete($id)
    {
        $role = Role::find($id);
        if (($role->name != 'admin') && $role) {
            $role->delete();
        }

        return redirect()->back()->with('status', 1);
    }

    /*
 * 数组转成树形结构
 */
    public function array_to_tree($array, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
    {
        // 创建Tree
        $tree = array();
        if (is_array($array)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($array as $key => $data) {
                $refer[$data[$pk]] =& $array[$key];
            }
            foreach ($array as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $array[$key];
                } else {
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $array[$key];
                    }
                }
            }
        }
        return $tree;
    }
}
