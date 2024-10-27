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

   

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}
