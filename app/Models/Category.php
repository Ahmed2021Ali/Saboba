<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['locale', 'name', 'parent_id'];
    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children')->get()->map(function ($child) {
            if (in_array($this->name, ['وظائف', 'خدمات'])) {
                $child->type = $child->name; // إضافة حقل type إذا كانت فئة فرعية مباشرة
            }
            return $child;
        });
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}
