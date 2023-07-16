<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request) //get all products
    {
        $user=Auth::user();
        if (!$user->is_admin)
        {
            return response()->json(['message' => __('auth.validate'),], 400);
        }
        $products = Product::paginate(15);
        return response()->json($products,200);
    }

    public function store(Request $request)
    {
        $user=Auth::user();
        if (!$user->is_admin)
        {
            return response()->json(['message' => __('auth.validate'),], 400);
        }
        $product = Product::find($request->productId);
        $product = Product::create($request->all());
        return response()->json(['message' => __('common.store'),], 200);
    }

    public function show(Request $request)
    {
        $user=Auth::user();
        if (!$user->is_admin)
        {
            return response()->json(['message' => __('auth.validate'),], 400);
        }
        $product = Product::query()->where('id',$request->productId);
        if(!$product)
        {
            return response()->json(['message' =>  'product not found'  ], 200);

        }
            return DataTables::of($product)->toJson();

    }

    public function update(Request $request)
    {
        $user=Auth::user();
        if (!$user->is_admin)
        {
            return response()->json(['message' => __('auth.validate'),], 400);
        }
        $product = Product::find($request->productId);
        if(!$product)
        {
            return response()->json(['message' =>  'product not found'  ], 200);

        }
        $product->update($request->all());
        return response()->json(['message' => __('common.update'),], 200);
    }

    public function delete(Request $request)
    {
        $user=Auth::user();
        if (!$user->is_admin)
        {
            return response()->json(['message' => __('auth.validate'),], 400);
        }
        $product = Product::find($request->productId);
        if(!$product)
        {
            return response()->json(['message' =>  'product not found'  ], 200);

        }
        $product->delete();
        return response()->json(['message' =>  __('common.delete')  ], 200);
    }
}
