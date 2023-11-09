<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'subcategoryName', 
        'visibility', 
    ];
    public function category(){
        return $this->belongsToMany(Category::class);
    }

    public function Products(){
        return $this->belongsToMany(Product::class);
    }
}
