<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'role_id', 'status', 'current_status'];

    public function role(){
        return $this->belongsTo('Modules\Role\Entities\Role');
    }

    public function operationManagers(){
        return $this->where('role_id', 3)->where('status', 1)->get();
    }
    
}
