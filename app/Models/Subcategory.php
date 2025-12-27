<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
    'category_id',
    'name',
    'slug',
    'description',
    'status'
];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
  // App\Models\Subcategory.php


    public function pages()
{
    return $this->hasMany(DescriptionPage::class, 'category_id', 'category_id')
                ->whereRaw("FIND_IN_SET(?, subcategory_id)", [$this->id]);
}
public function descriptionPages()
{
    return $this->hasMany(DescriptionPage::class, 'category_id', 'category_id')
        ->whereRaw("FIND_IN_SET($this->id, subcategory_id)");
}


}
