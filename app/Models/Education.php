<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialization', 'university', 'employment_type', 'end_date', 'start_date', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
