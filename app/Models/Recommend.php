<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recommend extends Model
{
    use SoftDeletes;

    protected $table = 'recommend_list';
    
    protected $fillable = [
        'applicant_id',
        'name',
        'score',
        'remark'  // Changed from 'remarks' to 'remark'
    ];

    protected $dates = ['deleted_at'];

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'applicant_id', 'user_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'candidate_id', 'applicant_id');
    }
}
