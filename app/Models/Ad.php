<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory, Translatable;

    protected $table = 'ads';

    protected $fillable = [
        'price', 
        'reference_number', 
        'user_id', 
        'category_id', 
        'city_id', 
        'image'
    ];

    public $translatedAttributes = ['name', 'description'];

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
