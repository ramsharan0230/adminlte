<?php

namespace Modules\Picture\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Picture extends Model
{
    use HasFactory;

    protected $table = 'pictures';
    protected $fillable = ['name', 'inspection_id', 'status'];

    // public function inspection(){
    //     return $this->belongsTo(Inspection::class);
    // }
}
