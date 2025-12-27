<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
     

    protected $fillable = [
        'user_id',
        'enrollment_no',
        'phone',
        'course',
    ];

    // 🔗 User relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 Answers relation
    public function answers()
    {
        return $this->hasMany(StudentAnswer::class, 'user_id', 'user_id');
    }
}
