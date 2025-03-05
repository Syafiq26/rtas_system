<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{
    use SoftDeletes;

    protected $table = 'guardian';

    protected $fillable = [
        'name',
        'ic',
        'citizen',
        'gender',
        'relation',
        'dob',
        'pob',
        'age',
        'occupation',
        'phoneNum',
        'empName',
        'empAddress',
        'postcode',
        'email',
        'income',
        'copyIC',
        'copySalaryLocation',
        'icNum',
    ];
}
