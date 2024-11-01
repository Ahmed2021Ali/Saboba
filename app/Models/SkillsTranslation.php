<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillsTranslation extends Model
{
    use HasFactory;
    protected $table = 'skills_translations';
    protected $fillable = ['name'];
    public $timestamps = false;

    protected $hidden = ['created_at', 'updated_at'];

}
