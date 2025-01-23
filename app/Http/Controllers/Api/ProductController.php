<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $product=Product::get();
        if($product->count()>0)
        {
           return ProductResource::collection($product);
        }
        else{
            return response()->json(['message'=>'No record'],200);
        }


    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:255',
            'description'=>'required',
            'price'=>'required|integer',
    ]);
      if($validator->fails())
      {
        return response()->json([
            'message'=>'all fields are mandatory',
            'error'=>$validator->messages(),
        ],422);
      }
      $product=Product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
        ]);
        return response()->json([
            'message'=>'Product Created Successfully',
            'data'=>new ProductResource($product)],200);
        
        
    }
    public function show()
    {
        
    }
    public function destory()
    {
        
    }
}
