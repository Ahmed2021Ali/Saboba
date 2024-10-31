<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ad extends Model implements HasMedia
{
    use HasFactory, Translatable, InteractsWithMedia;

    protected $table = 'ads';
    public $timestamps = true;

    protected $fillable = ['price', 'reference_number', 'user_id', 'category_id', 'city_id', 'image', 'status', 'additional_fields'];

    public $translatedAttributes = ['name', 'description']; // الخصائص المترجمة


    public function registerMediaConversions1(Media $media = null): void
    {
        $this->addMediaCollection('ad_main_image');
    }

    public function registerMediaConversions2(Media $media = null): void
    {
        $this->addMediaCollection('ad_images');
    }

    public function registerMediaConversions3(Media $media = null): void
    {
        $this->addMediaCollection('reals');
    }


    public function translations()
    {
        return $this->hasMany(AdTranslation::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function adFields($locale)
    {
        return $this->hasMany(AdField::class)->where('locale', $locale === "ar" ?? "en")->get();
    }
}
