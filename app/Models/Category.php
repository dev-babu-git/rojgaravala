<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'status',
        'description',    // if you have this
        'meta_title',     // SEO fields if present
        'meta_description',
        'meta_keywords',
    ];
    public function brands()
    {
        return $this->hasMany(JobBrand::class, 'category_id');
    }
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }
     public function descriptionPages()
    {
        return $this->hasMany(DescriptionPage::class, 'category_id');
    }
}
