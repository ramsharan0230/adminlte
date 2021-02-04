<?php

namespace Modules\Role\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['name', 'slug', 'status'];

    public function users(){
        return $this->hasMany('Modules\User\Entities\User');
    }
    
}
