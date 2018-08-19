<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table='role';

    public static function getList($condition = [],$paginate_params = [])
    {
        $roles = Role::where('id', '>', '0');

        if (!empty($condition)) {
            foreach ($condition as $item) {
                if ($item['option'] == 'like') {
                    $item['value'] = "%{$item['value']}%";
                }
                switch (strtolower($item['option'])) {
                    case '=':
                    case '>=':
                    case '<=':
                    case '>':
                    case '<':
                    case 'like':
                        $roles->where($item['field'], $item['option'], $item['value']);
                        continue;
                    case 'in':
                        $roles->whereIn($item['field'], $item['value']);
                        continue;
                }
            }
        }

        $roles = $roles->orderBy('id', 'desc')->paginate(10)->appends($paginate_params);

        return $roles;
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'permission_role', 'role_id', 'permission_id');
    }

    public function users()
    {
        return $this->belongsToMany(\App\Models\Admin::class,'role_user','role_id','user_id');
    }

}

