<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
     protected $fillable = [
        'title',
        'slug',
        'status',
    ];


     public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
