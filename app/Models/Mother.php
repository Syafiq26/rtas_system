<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $uuid
 * @property integer $contact_id
 * @property integer $type
 * @property string $notes
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $status
 */
class Mother extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'mother_applicant';

    /**
     * @var array
     */
    protected $fillable = [
        'motherName',
        'motherIC',
        'citizen',
        'motherDOB',
        'motherPOB',
        'motherAge',
        'copySalaryLocation',
        'copyIC',
        'occupation',
        'motherPhone',
        'motherEmployer',
        'addressEmployer',
        'postcode',
        'motherEmail',
        'motherIncome',
        'icNum'
    ];

}
