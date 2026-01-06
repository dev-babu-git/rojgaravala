<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestAttempt extends Model
{
     


    protected $fillable = [
    'user_id',
    'test_id',
    'attempt_user_no',
    'status',
    'started_at',
    'score',
    'submitted_at',
];


    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
