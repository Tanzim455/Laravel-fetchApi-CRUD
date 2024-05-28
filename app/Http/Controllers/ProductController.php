<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allproducts():View{
        $carts=Cart::join('products','carts.product_id','products.id')->get();
         $cartLength=Cart::count();
        $products=Product::select('id','title','description','price')->get();
        return view('welcome',compact('products','carts','cartLength'));
    }
    public function index():JsonResponse
    {
        //
        $products=Product::select('id','title','description')->get();
        
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request):JsonResponse
    {
        //
      $product=Product::create($request->validated());
         
      return response()->json([
        'status' => 200,
        'message' => 'Product created successfully!',
        'product' => $product,
    ]);
         
       
        // return $product;
    }

         
       
        // return $product;
    

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        //
        $product=Product::findOrFail($id);
        
        return response()->json($product);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product=Product::findOrFail($id);
        // dd($product);
         return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request,string $id):JsonResponse
    {
        //
        $product=Product::findOrFail($id);
        if($product){
            $product->title=$request->input('title');
            $product->description=$request->input('description');
            $product->update();
            return response()->json([
                'status'=>200,
                'message'=>'Student Data updated Successfully.'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Student not found'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        //
        $product=Product::findOrFail($id);
        if($product){
            $product->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Student Deleted Successfully.'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Student not found'
            ]);
        }
    }
}
