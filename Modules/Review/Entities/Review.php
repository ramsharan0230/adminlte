<?php

namespace Modules\Review\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = ['comments', 'inspection_id', 'user_id', 'status'];
    

    public function inspection(){
        return $this->belongsTo('Modules\Inspection\Entities\Inspection');
    }

    public function user(){
        return $this->belongsTo('Modules\User\Entities\User');
    }
}
