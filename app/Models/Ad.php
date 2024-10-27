<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory, Translatable;

    protected $table = 'ads';
    public $timestamps = true;

    protected $fillable = ['price', 'reference_number', 'user_id', 'category_id', 'city_id', 'image', 'status', 'additional_fields'];

    public $translatedAttributes = ['name', 'description']; // الخصائص المترجمة

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
}
