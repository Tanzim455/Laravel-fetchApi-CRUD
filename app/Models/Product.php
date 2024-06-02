<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable=['title','description','price'];
    protected static function booted()
    {
        static::deleting(function ($product) {
            // Delete all associated cart items when the product is deleted
            Cart::where('product_id', $product->id)->delete();
        });
    }

}
