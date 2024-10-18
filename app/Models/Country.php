<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Country extends Model
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name']; // Ensure this property is correctly defined
    protected $fillable = ['locale', 'name'];

}
