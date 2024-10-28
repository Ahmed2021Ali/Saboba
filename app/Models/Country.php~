<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Country extends Model implements  HasMedia
{
    use HasFactory, Translatable,InteractsWithMedia;

    public $translatedAttributes = ['name']; // العمود اللي هيتترجم
    // protected $fillable = []; // هنا ممكن تضيف أي أعمدة تحتاجها
    public $timestamps = false;
    protected $hidden = ['name','created_at', 'updated_at'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('countryImages');
    }
}
