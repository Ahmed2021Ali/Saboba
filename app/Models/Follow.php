<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'follower', 'following'];

    public function follower()
    {
        return $this->belongsTo(User::class,'follower');
    }

    public function following()
    {
        return $this->belongsTo(User::class,'following');
    }
}
