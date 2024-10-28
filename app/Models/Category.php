<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use Translatable, InteractsWithMedia;

    public $translatedAttributes = ['name'];
    protected $fillable = ['locale', 'name', 'parent_id'];
    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('categoryImages');
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}
