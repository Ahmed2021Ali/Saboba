<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockUser extends Model
{

    protected $fillable = [
        'user_id',
        'blocked_by_user_id',
        'blocked_at',
        'unlocked_by_user_id',
        'unblocked_at',
        'reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blockedBy()
    {
        return $this->belongsTo(User::class, 'blocked_by_user_id');
    }

    public function unlockedBy()
    {
        return $this->belongsTo(User::class, 'unlocked_by_user_id');
    }
}
