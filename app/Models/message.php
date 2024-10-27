<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class message extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['chat_id', 'sender_id', 'receiver_id', 'body', 'read'];


    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }


    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('messageFiles');
    }
}
