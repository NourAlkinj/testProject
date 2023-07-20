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
//        $user=Auth::user();
//        if (!$user->is_admin)
//        {
//            return response()->json(['message' => __('auth.validate'),], 400);
//        }
        $products = Product::paginate(15);
//        return response()->json($products,200);
        return view('product.index', compact('products'));

    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->is_admin) {
            return redirect()->back()->with(['message' => __('auth.validate'),
                'alert-type' => 'danger']);
        }
        $product = Product::create($request->all());
//        return response()->json(['message' => __('common.store'),], 200);

        return redirect()->back()->with([
            'message' => __('Frontend/products.created_failed'),
            'alert-type' => 'success'
        ]);
}

    public function show($id)
    {
        $user=Auth::user();
        if (!$user->is_admin)
        {
            return response()->json(['message' => __('auth.validate'),], 400);
        }
        $product = Product::find($id);
        if(!$product)
        {
            return response()->json(['message' =>  'product not found'  ], 200);

        }
//          return  DataTables::of($product)->toJson();
        return view('product.show', compact('product'));


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

    public function delete($id)
    {
        $user=Auth::user();
        if (!$user->is_admin)
        {
            return response()->json(['message' => __('auth.validate'),], 400);
//            return redirect()->route('product.index')->with([
//                'message' => __('auth.validate'),
//                'alert-type' => 'danger'
//            ]);
        }
        $product = Product::find($id);
        if(!$product)
        {
            return response()->json(['message' =>  'product not found'  ], 200);
//            return redirect()->route('product.index')->with([
//                'message' =>  'product not found',
//            'alert-type' => 'danger'
//            ]);
        }
        $product->delete();
        return response()->json(['message' =>  __('common.delete')  ], 200);
//        return redirect()->route('product.index')->with([
//            'message' =>  __('common.delete'),
//        'alert-type' => 'success'
//        ]);


    }
}
