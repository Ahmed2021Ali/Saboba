<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['name'];
    protected $hidden = ['name','created_at', 'updated_at'];

    public function skillUsers()
    {
        return $this->belongsToMany(User::class, 'user_skills')->withPivot(['skills_id', 'user_id']);
    }
}
