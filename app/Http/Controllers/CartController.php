<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index(){
        $carts=Cart::select('carts.id','carts.quantity','carts.price','carts.total_price',
        'carts.product_id','products.title','products.description',
        )->join('products', 'carts.product_id', '=', 'products.id')->get();
        
        return response()->json($carts);
    }
    public function addToCart(Request $request):JsonResponse{
        $productId=$request->input('product_id');
        $singleProduct=Product::findOrfail($productId);
        $quantity=$request->input('quantity');

        $price=$singleProduct->price;
        $total_price=$singleProduct->price * $quantity;
        
        $cart=Cart::where('product_id',$singleProduct->id)->first();
         
        if($cart){
            
         
            $updatedQuanity=$cart->quantity + $quantity;
             
            $updatedTotalPrice=$updatedQuanity * $price;
            
            $cart->update([
                  'quantity'=>$updatedQuanity,
                  'total_price'=>$updatedTotalPrice,
                  
            ]);
            return response()->json([
                'status'=>200,
                'cart'=>$cart,
                'message'=>'Your cart has been updated successfully'
            ]);
            
        }else{
            Cart::create([
                'quantity'=>$quantity,
                 'product_id'=>$productId,
                 'price'=>$price,
              'total_price'=>$total_price
          ]);
          return response()->json([
            'status'=>200,
            'cart'=>$cart,
            'message'=>'Your cart has been added successfully'
        ]);
        }
        
        
    }

    public function deleteCart(string $id):JsonResponse{
        $cart=Cart::findOrFail($id);
        if($cart){
            $cart->delete();
            return response()->json([
                'status'=>200,
                'cart'=>$cart,
                'message'=>'Your cart has been removed successfully'
            ]);
        }
        
        

    }
}
