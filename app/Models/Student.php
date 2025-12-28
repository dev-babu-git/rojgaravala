<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Student extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'enrollment_no',
        'phone',
        'course',
    ];
    public function setEnrollmentNoAttribute($value)
    {
        $this->attributes['enrollment_no'] = Crypt::encryptString($value);
    }

    // GET (fetch time → decrypt)
    public function getEnrollmentNoAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }
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
