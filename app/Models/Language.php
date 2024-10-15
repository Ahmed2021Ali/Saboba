<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';
    protected $fillable = ['name',];
    public $translatedAttributes = ['name'];

    /*    public function userLanguages()
        {
            return $this->belongsToMany(User::class, 'user_languages')->withPivot('user_id', 'language_id');
        }*/
}
