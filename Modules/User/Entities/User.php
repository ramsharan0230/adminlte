<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'role_id', 'status', 'phone', 'current_status', 'branch_id'];

    public function role(){
        return $this->belongsTo('Modules\Role\Entities\Role');
    }

    public function branch(){
        return $this->belongsTo('Modules\Branch\Entities\Branch');
    }

    public function hygienes(){
        return $this->where('role_id', 1)->where('status', 1)->get();
    }

    public function siteManagers(){
        return $this->where('role_id', 2)->where('status', 1)->get();
    }

    public function operationManagers(){
        return $this->where('role_id', 3)->where('status', 1)->get();
    }

    public function srOperationManagers(){
        return $this->where('role_id', 4)->where('status', 1)->get();
    }
    
}
