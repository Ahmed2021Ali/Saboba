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
}