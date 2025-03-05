<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal extends Model
{
    use SoftDeletes;

    protected $table = 'personal';

    protected $fillable = [
        'name',
        'ic_num',
        'icNum',
        'copyIC',
        'citizen',
        'gender',
        'dob',
        'pob',
        'address',
        'address2',
        'city',
        'postcode',
        'state',
        'email',
        'phoneNum',
        'user_id',
    ];

    protected $dates = ['deleted_at'];
}
