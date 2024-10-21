<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['locale', 'name', 'parent_id'];

    public $timestamps = false;

    // بترجع الفئة الأم المرتبطة بالفئة الحالية
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // بترجع كل الفئات الفرعية اللي بتتبع الفئة الحالية
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // بترجع كل الإعلانات المرتبطة بالفئة الحالية
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }


    
    // Method to hide 'name' and move 'translations' after main data
    public function formatCategory()
    {
        // Map over translations to hide 'category_id'
        $this->translations->map(function ($translation) {
            $translation->makeHidden('category_id');
            return $translation;
        });

        // Hide 'name' field if translations exist
        if (!empty($this->translations)) {
            $this->makeHidden('name');
        }

        // Apply the same logic to children categories
        $this->children->map(function ($child) {
            $child->translations->map(function ($translation) {
                $translation->makeHidden('category_id');
                return $translation;
            });

            if (!empty($child->translations)) {
                $child->makeHidden('name');
            }
            return $child;
        });

        // Convert the category to an array and restructure it
        $categoryArray = $this->toArray();
        $translations = $categoryArray['translations'];
        unset($categoryArray['translations']);

        // Move translations after category data
        $categoryArray['translations'] = $translations;

        return $categoryArray;
    }

}
