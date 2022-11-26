<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{ 
    public function index()
    {
        $products = Product::all() ;

        return response()->json(['message' => 'OK' , 'data' => $products]) ;
    }

     
    public function store(Request $request)
    {

        
        $data = $request->validate([
            'name' => 'required' , 
            'price' => 'required' ,
            'slug' => 'required' ,
        ]) ;

         $product = Product::create($data) ;
         
         return response()->json([
            'message' => 'created' ,
            'data' => $product 
         ]);
    }

    
    public function show(Product $product)
    {
         return response()->json([
            'message' => 'OK' ,
            'data'    => $product ,
         ]);
    }

    
    public function update(Request $request, Product $product)
    {
         $product->update($request->all()) ;
         return response()->json([
            'message' => "updated" ,
            "data"    => $product ,
         ]);
    }

  
    public function destroy(Product $product)
    {
        $product->delete() ;
        return response()->json([
            'message' => 'deleted' , 
            'data'    => $product ,
        ]);
    }

    public function search($name){
        $result = Product::where('name' , 'like' , '%'.$name.'%')->get() ;
        return response()->json([
            'message' => 'results' , 
            'data' => $result ,
        ]);
    }
}
