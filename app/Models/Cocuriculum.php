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
class Cocuriculum extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cocuriculum';

    /**
     * @var array
     */
    protected $fillable = ['cocuId', 'cocuName', 'cocuType', 'represent', 'merit', 'role', 'merit_role', 'icNum', 'copyCertLocation', 'user_id'];

}
