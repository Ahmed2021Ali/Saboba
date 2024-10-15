<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['name'];
    public function userskills()
    {
        return $this->belongsToMany(User::class, 'skill_user')->withPivot('skill_id', 'user_id');
    }
}
