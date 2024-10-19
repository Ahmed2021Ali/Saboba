<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory, Translatable;

    protected $table = 'ads';
    public $timestamps = true; // يجب تفعيل التوقيتات

    protected $fillable = ['price', 'reference_number', 'user_id', 'category_id', 'city_id', 'image'];

    public $translatedAttributes = ['name', 'description']; // الخصائص المترجمة

    public function translations()
    {
        return $this->hasMany(AdTranslation::class); // علاقة مع الترجمات
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
