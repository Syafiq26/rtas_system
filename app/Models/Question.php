<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'candidate_id',
        'interviewer_id',
        'category',
        'marks',
        'comment'
    ];

    public function candidate()
    {
        return $this->belongsTo(Recommend::class, 'candidate_id');
    }
}
