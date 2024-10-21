<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory,Translatable;

    public $translatedAttributes = ['name'];
    public $timestamps = false;


    public function languageUsers()
    {
        return $this->belongsToMany(User::class, 'user_languages')->withPivot('language_id', 'user_id');
    }
}
