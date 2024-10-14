<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Translatable;

    // الحقول القابلة للترجمة
    public $translatedAttributes = ['name', 'overview'];
    // الحقول العادية
    protected $fillable = [
        'email',
        'password',
        'phone',
        'type',
        'country_id',
        'whatsapp_number',
        'contact_number',
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
