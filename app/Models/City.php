<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['country_id', 'locale', 'name'];
    public $timestamps = false;
    protected $hidden = ['name', 'created_at', 'updated_at'];


    public function Country()
    {
        return $this->belongsTo(Country::class);
    }

}
