<?php


//function  getCurrentMenu(){
//    $all_menu=Menu();//所有菜单信息
//    dd($all_menu);
//    $current=getTopRecord();//当前用户访问的菜单
//    if($current['id']==0){
//        return $all_menu;
//    }
//    return isset($all_menu[$current['name']])?$all_menu[$current['name']]:[];//当前菜单的所有子菜单
//}
/*
 * 获取当前登录用户拥有的菜单信息
 */
function Menu()
{
    $top = '';
    $perms=[];
    $user=Auth::guard('admin')->user();
    foreach($user->roles as $role){
        if($role->perms){
            $perms = array_merge($perms, $role->perms->toArray());
        }
    }
    $menu = array_to_tree_with_key($perms);
    foreach($menu as $key=>$m){
        $menu[$key]['single'] = [];
        $menu[$key]['group'] = [];
        if(isset($m['_child'])){
            foreach($m['_child'] as $k=>$child){
                if(empty($child['gtitle'])){
                    $menu[$key]['single'][] = $child;
                }else{
                    $menu[$key]['group'][$child['gtitle']][] = $child;
                }
            }
        }
    }
    return $menu;
}

/*
 * 获取当前顶级菜单
 */
function getTopRecord($name='')
{
    $id=0;
    $menu_param=$display_name='';
    $name =$name?$name:\Route::current()->getName();
    if($name){
        $p = \App\Models\Permission::where('name','=',$name)->first();
        while(isset($p->pid)&&$p->pid != 0){
            $p = \App\Models\Permission::find($p->pid);
            if(empty($p)) {
               break;
            }
        }
        if(isset($p->pid)&&$p->pid===0) {
            $id = $p->id;
            $menu_param = $p->name;
            $display_name = $p->display_name;
        }
    }
    return ['id'=>$id,'name'=>$menu_param,'display_name'=>$display_name];
}

/*
 * 数组转成树形结构
 */
function array_to_tree_with_key($array, $pk='id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if(is_array($array)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($array as $key => $data) {
            $refer[$data[$pk]] =& $array[$key];
        }
        foreach ($array as $key => $data) {
            // 判断是否存在parent
            $parentId =  $data[$pid];
            if ($root == $parentId) {
                $tree[$data['name']] =& $array[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][$data['name']] =& $array[$key];
                }
            }
        }
    }
    return $tree;
}

/*
 * 数组转成树形结构
 */
function array_to_tree($array, $pk='id', $pid = 'pid', $child = '_child', $root = 0)
{
    // 创建Tree
    $tree = array();
    if(is_array($array)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($array as $key => $data) {
            $refer[$data[$pk]] =& $array[$key];
        }
        foreach ($array as $key => $data) {
            // 判断是否存在parent
            $parentId =  $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $array[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $array[$key];
                }
            }
        }
    }
    return $tree;
}