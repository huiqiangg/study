<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    //protected $fillable = ['pid', 'sort', 'hide', 'gtitle','name','id'];
    protected $guarded=[];
}
