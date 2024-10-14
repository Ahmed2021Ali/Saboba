<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = ['specialization', 'university', 'employment_type', 'end_date', 'start_date', 'job_profile_id'];

    public function jobProfile()
    {
        return $this->belongsTo(JobProfile::class);
    }
}
