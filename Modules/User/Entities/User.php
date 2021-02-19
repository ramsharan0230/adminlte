<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
Use Modules\Branch\Entities\Branch;

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

    public function inspections(){
        return $this->hasMany('Modules\Inspection\Entities\Inspection');
    }

    public function reviews(){
        return $this->hasMany('Modules\Review\Entities\Review');
    }

    public function hygienes(){
        return $this->where('role_id', 1)->get();
    }

    public function siteManagers(){
        return $this->where('role_id', 2)->get();
    }

    public function operationManagers(){
        return $this->where('role_id', 3)->get();
    }

    public function srOperationManagers(){
        return $this->where('role_id', 4)->get();
    }

    public function checkUserBranch($id){
        return Branch::where('id', $id)->first();
    }
    
}
