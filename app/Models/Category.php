<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoryName',
        'visibility',
       
    ];
    
    public function departments(){
        return $this->belongsToMany(Department::class);
    }
    public function subcategories(){
        return $this->belongsToMany(Subcategory::class);
    }
}
