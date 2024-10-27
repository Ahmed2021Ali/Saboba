<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdField extends Model
{
    use HasFactory;

    protected $table = 'ad_fields';

    protected $fillable = [
        'field_name',
        'field_value',
        'ad_id',
        'locale',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
