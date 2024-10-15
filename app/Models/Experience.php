<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable=[
        'job_title','company_name','description','employment_type','start_date','end_date','status','user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
