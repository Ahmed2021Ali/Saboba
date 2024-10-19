<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdUpdate extends Model
{
    use HasFactory;

     protected $table = 'ads_updates'; // Define the table name

     protected $fillable = [
         'ad_id',
         'price',
         'category_id',
         'city_id',
         'locale',
         'name',
         'description',
         'status',
     ];
 
     public function ad()
     {
         return $this->belongsTo(Ad::class, 'ad_id');
     }
 

}
