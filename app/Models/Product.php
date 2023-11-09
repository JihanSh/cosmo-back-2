<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'productName',
        'productTitle',
        'productPrice',
        'productVisible',
        'productDescription',
        'productDesign',
        'productCountry',
        'productWashing',
        'productColor',
        'productFabric',
        'productSKU',
        'productSale',
        'productQuantity',
        'productCurrency',
        'productShipping',
        'productAllowPurchase',
        'productChargetaxes',
        'productWearing',
        'media1',
        'media2',
        'media3',
        'media4',
        'media5',
       
    ];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function images(){
        return $this->hasMany(MediaProduct::class);
    }
    
    public function size(){
        return $this->hasMany(Size::class);
    }

    public function subcategory(){
        return $this->belongsToMany(Subcategory::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function collections(){
        return $this->belongsToMany(Collection::class);
    }
}
