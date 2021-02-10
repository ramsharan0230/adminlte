<?php

namespace Modules\Inspection\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Picture\Entities\Picture;

class Inspection extends Model
{
    
    protected $table = 'inspections';
    protected $fillable = ['location','start_date','findings', 'pca', 'accountibility', 'closing_date', 'user_id', 'approvedBy_hygiene', 'approvedBy_siteman', 'approvedBy_opman', 'approvedBy_sropman', 'status'];
    
    protected $casts = [
        'created_at' => 'datetime:d/m/Y', // Change your format
        'updated_at' => 'datetime:d/m/Y',
    ];


    public function pictures(){
        return $this->hasMany(Picture::class);
    }

    public function user(){
        return $this->belongsTo('Modules\User\Entities\User');
    }

    public function reviews(){
        return $this->hasMany('Modules\Review\Entities\Review');
    }

    public function seniorOperationManagerInspections(){
        return $this->where(['status'=>1, 'approvedBy_hygiene'=>1, 'approvedBy_siteman'=>1,'approvedBy_opman'=>1])->get();
    }

    public function hygieneInspections(){
        return $this->where(['status'=>1])->get();
    }

}
