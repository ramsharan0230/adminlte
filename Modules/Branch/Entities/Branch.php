<?php

namespace Modules\Branch\Entities;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
    protected $fillable = ['name', 'email', 'main_office_id', 'address', 'phone', 'fax', 'status'];
    
    public function mainOffice(){
        return $this->belongsTo('Modules\Branch\Entities\MainOffice');
    }

    public function users(){
        return $this->hasMany('Modules\User\Entities\User');
    }
}
