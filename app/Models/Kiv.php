<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kiv extends Model
{
    use SoftDeletes;

    protected $table = 'kiv_list';
    
    protected $fillable = [
        'applicant_id',
        'name',
        'score'
    ];

    protected $dates = ['deleted_at'];
}
