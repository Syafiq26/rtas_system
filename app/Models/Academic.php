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
class Academic extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'academic';

    /**
     * @var array
     */
    protected $fillable = [
        'major',
        'schoolName',
        'subjectName',
        'subjectGrade',
        'subjectMerit',
        'icNum',
        'user_id',
        'spmCertLocation',
    ];

    protected $casts = [
        'subjectName' => 'json',
        'subjectGrade' => 'json',
        'subjectMerit' => 'json',
    ];
}
