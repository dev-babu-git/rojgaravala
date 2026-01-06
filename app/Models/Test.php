<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DescriptionPage;

class Test extends Model
{
    // Mass assignment protection

    protected $fillable = [
        'exam_id',
        'title',
        'slug',
        'duration',
        'total_marks',
        'status'
    ];




    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function attempts()
    {
        return $this->hasMany(TestAttempt::class);
    }
}
