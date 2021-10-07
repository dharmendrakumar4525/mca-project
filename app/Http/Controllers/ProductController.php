<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->wantsJson()) {
            $products = auth()->user()->products()->paginate(4);
            return response()->json([
                'data' => $products->items(),
                'pagination' => ['currentPage' => $products->currentPage(), 'totalPages' => $products->lastPage()]
            ]);
        }
        $products = auth()->user()->products()->paginate(4);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        //$user = $user->loadmissing('categories', 'categories.sub_categories');
        $categories  = $user->categories;
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $data = $request->all();
        $imagePath = Storage::disk('local')->put('', $request->image);
        $data['image'] = $imagePath;
        $data['supplier_id'] = auth()->user()->id;
        $Product = Product::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $user = auth()->user();
        $categories  = $user->categories;
        return view('product.edit', compact('product', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product  $product, ProductRequest $request)
    {
        $data = $request->all();
        unset($request['_method']);
        $imagePath = Storage::disk('local')->put('', $request->image);
        $data['image'] = $imagePath;
        $product->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
