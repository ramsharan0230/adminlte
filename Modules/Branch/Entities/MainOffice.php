<?php

namespace Modules\Branch\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainOffice extends Model
{
    protected $table = 'main_offices';
    protected $fillable = ['name', 'address', 'phone', 'email', 'fax', 'status'];

    public function branches(){
        return $this->hasMany('Modules\Branch\Entities\Branch', 'main_office_id');
    }
}
