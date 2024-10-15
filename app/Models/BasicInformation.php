<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicInformation extends Model
{
    use HasFactory;
    protected $fillable=['nationality','gender','age','job_title','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
