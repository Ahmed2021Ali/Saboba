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



    public function formatCategory()
    {
        // Format translations for the main category and hide the 'name'
        $this->translations->map(function ($translation) {
            $translation->makeHidden('category_id');
            return $translation;
        });
    
        // If translations exist, hide 'name'
        if ($this->translations->isNotEmpty()) {
            $this->makeHidden('name');
        }
    
        // Apply the same logic to child categories
        $this->children->map(function ($child) {
            $child->translations->map(function ($translation) {
                $translation->makeHidden('category_id');
                return $translation;
            });
    
            if ($child->translations->isNotEmpty()) {
                $child->makeHidden('name');
            }
    
            // Format the child category
            $child->formatChildCategory();
            return $child;
        });
    
        // Convert the category to an array
        $categoryArray = $this->toArray();
        
        // Move translations after main data
        $translations = $categoryArray['translations'];
        unset($categoryArray['translations']);
        $categoryArray['translations'] = $translations;
    
        // Return the structured category array
        return $categoryArray;
    }
    
    protected function formatChildCategory()
    {
        // Format translations for the child category and hide the 'name'
        $this->translations->map(function ($translation) {
            $translation->makeHidden('category_id');
            return $translation;
        });
    
        // If translations exist, hide 'name'
        if ($this->translations->isNotEmpty()) {
            $this->makeHidden('name');
        }
    }
    
        

}
