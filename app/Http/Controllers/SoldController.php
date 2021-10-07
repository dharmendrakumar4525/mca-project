<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customerId = $productId = $amount = false;
        if ($request->filled(['customer_id'])) {
            $customerId = $request->input('customer_id');
        }
        $user = Auth::user();
        $products = Product::whereSupplierId($user->id)
            ->whereHas('orders')
            ->pluck('name', 'id');

        $customers = User::whereHas('orders', function ($query) use ($products) {
            $query->whereIn('product_id', $products->keys());
        })->pluck('name', 'id');
        if ($request->filled(['product_id'])) {
            $product_ids = [$request->input('product_id')];
        } else {
            $product_ids = Auth::user()->products->pluck('id')->toArray();
        }

        $sellers = ($user->products->pluck('id'));

        $orders = Order::whereIn('product_id', $product_ids)
            ->when($customerId, function ($query) use ($customerId) {
                $query->where('customer_id', $customerId);
            })
            ->with(['customer', 'product'])
            ->get();


        if (request()->wantsJson()) {
            return response()->json([
                'data' => $orders,
            ]);
        } else {
            return view('seller.solditem', compact('orders', 'products', 'customers'));
        }
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $Order, $id)
    {

        $order = Order::find($id);
        $order->status = '1';
        $order->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
