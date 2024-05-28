<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addToCart(Request $request){
        $productId=$request->input('product_id');
        $singleProduct=Product::findOrfail($productId);
        $quantity=$request->input('quantity');

        $price=$singleProduct->price;
        $total_price=$singleProduct->price * $quantity;
        
        $cart=Cart::where('product_id',$singleProduct->id)->first();
         
        if($cart){
            
         
            $updatedQuanity=$cart->quantity += $quantity;
             
            $updatedTotalPrice=$updatedQuanity * $price;
            
            $cart->update([
                  'quantity'=>$updatedQuanity,
                  'total_price'=>$updatedTotalPrice,
                  
            ]);
        }else{
            Cart::create([
                'quantity'=>$quantity,
                 'product_id'=>$productId,
                 'price'=>$price,
              'total_price'=>$total_price
          ]);
        }
        
        
    }
}
