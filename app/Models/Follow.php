<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'follower_id', 'following_id'];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id')->select('id','name','type','country_id','email');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'following_id')->select('id','name','type','country_id','email');
    }
}