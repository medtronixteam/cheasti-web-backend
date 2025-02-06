<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function parent()
    {
        return $this->belongsTo(FaqCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(FaqCategory::class, 'parent_id');
    }
    public function faqs()
    {
        return $this->hasMany(Faq::class, 'category_id');
    }

}
