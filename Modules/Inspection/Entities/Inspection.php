<?php

namespace Modules\Inspection\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inspection extends Model
{
    use HasFactory;
    protected $table = 'inspections';
    protected $fillable = ['location','start_date','findings', 'pca', 'accountibility', 'closing_date', 'user_id', 'approvedBy_hygiene', 'approvedBy_siteman', 'approvedBy_opman', 'approvedBy_sropman', 'status'];
    
}
