<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CompanyIdentityVerification extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['status', 'user_id'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('documentationFiles');
    }

    public function user()
    {
      return  $this->belongsTo(User::class);
    }


}
