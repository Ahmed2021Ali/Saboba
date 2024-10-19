<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdTranslation extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['name', 'description', 'locale', 'ad_id']; // الخصائص القابلة للتعبئة

    public function ad()
    {
        return $this->belongsTo(Ad::class); // علاقة مع نموذج Ad
    }
}
