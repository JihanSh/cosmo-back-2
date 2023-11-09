<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'ImageURL',
        'visibility',
       
    ];

    public function MediaProduct(){
        return $this->belongsTo(Product::class);
    }
}
