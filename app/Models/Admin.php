<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Auth\Passwords\CanResetPassword;

class Admin extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait,CanResetPassword;

    protected $table = 'admins';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function getList($condition = [], $paginate_params = [])
    {
        $users = Admin::where('id', '>', '0');

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
                        $users->where($item['field'], $item['option'], $item['value']);
                        break;
                    case 'in':
                        $users->whereIn($item['field'], $item['value']);
                        break;
                }
            }
        }

        $users = $users->orderBy('id', 'desc')->paginate(10)->appends($paginate_params);

        return $users;
    }
}
