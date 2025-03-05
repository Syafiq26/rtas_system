<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siblings extends Model
{
    use SoftDeletes;

    protected $table = 'sibling_applicant';
    
    protected $fillable = [
        'siblingName',
        'siblingDOB',
        'siblingAge',
        'occupation',
        'emp_ins',
        'icNum'
    ];

    protected $dates = ['deleted_at'];
}
