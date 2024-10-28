<?php

namespace App\Models;


use App\Http\Controllers\EducationController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements JWTSubject, HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'type', 'country_id',
        'whatsapp_number', 'contact_number', 'overview',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('userImages');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    public function educations()
    {
        return $this->hasMany(Education::class)->select('id', 'specialization', 'university', 'employment_type', 'end_date', 'start_date')->get();
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class)->select('id', 'job_title', 'company_name', 'description', 'employment_type', 'start_date', 'end_date', 'status')->get();
    }

    public function userLanguages()
    {
        return $this->belongsToMany(Language::class, 'user_languages')->withPivot(['language_id', 'user_id']);
    }

    public function userSkills()
    {
        return $this->belongsToMany(Skills::class, 'user_skills')->withPivot(['skills_id', 'user_id']);
    }

    public function basicInformation()
    {
        return $this->hasOne(BasicInformation::class)->select('job_title', 'nationality', 'gender', 'age')->first();
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'follower_id')->select('following_id')->get();
    }

    public function followings()
    {
        return $this->hasMany(Follow::class, 'following_id')->select('follower_id')->get();
    }

    public function identifyVerification()
    {
        return $this->hasOne(CompanyIdentityVerification::class)->select('id', 'status')->where('type', 'company')->get();
    }
}
