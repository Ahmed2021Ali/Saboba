<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CompanyProfile extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['documentation_status'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('documentationFiles');
    }
}
