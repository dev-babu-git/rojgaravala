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
        'status',
    ];
 


    // Optional: Cast types
    // protected $casts = [
    //     'duration' => 'integer',
    //     'total_marks' => 'integer',
    //     'status' => 'string',
    // ];



    // ✅ ADD THIS METHOD
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function exam()
    {
        return $this->belongsTo(DescriptionPage::class);
    }
}
