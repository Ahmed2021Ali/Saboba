<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['locale','name'];
    public $timestamps = false;
    protected $hidden = ['created_at', 'updated_at'];

}
