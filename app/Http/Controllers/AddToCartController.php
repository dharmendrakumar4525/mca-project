<?php

namespace App\Http\Controllers;

use App\Models\AddToCart;
use App\Models\Product;
use Facade\FlareClient\Http\Response;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpKernel\HttpCache\ResponseCacheStrategy;

//use Symfony\Component\HttpFoundation\Cookie;

class AddToCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = 0;
        if (!Auth::check()) {
            $cookies = Cookie::get('user');
            $cookies =   json_decode($cookies, true);
            foreach ($cookies  as $index => $cookie) {
                $product = Product::find($cookie['product_id']);
                $cookies[$index]['product'] = $product;
                $total =  $total + $cookie["quantity"] * $cookies[$index]['product']['price'];
            }
            $cartItems  = $cookies;
            return view('customer.cart', compact('cartItems', 'total'));
        } else {
            $userCartProducts = Auth::user()->loadmissing('carts', 'carts.product');
            $cartItems = $userCartProducts->carts;
            foreach ($cartItems as $items) {
                $total = $total + $items['quantity'] * $items->product['price'];
            }
            return view('customer.cart', compact('cartItems', 'total'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)  
    {
        $array_json = [];
        $index = 0;
        if (!Auth::check()) {
            $cookies = Cookie::get('user');
            $cookies = json_decode($cookies, true);
            if ($cookies) {
                $value = (array_search($request->product_id, array_column($cookies, 'product_id')));
                if ($value === false) {
                    array_push($cookies, ["product_id" => $request->product_id, "quantity" => $request->quantity]);
                } else {
                    $cookies[$value]['quantity'] = $cookies[$index]['quantity'] + $request->quantity;
                }
            } else {
                $cookies = [];
                array_push($cookies, ["product_id" => $request->product_id, "quantity" => $request->quantity]);
            }
            $array_json = json_encode($cookies);
            return response([
                'status' => 'success'
            ], 200)->cookie('user', $array_json, 12000);
        } else {

            $user_id = auth()->user()->id;
            $item = AddToCart::where(['customer_id' => $user_id, 'product_id' => $request->product_id])->first();
            if ($item) {
                $item->quantity = $item->quantity + $request->quantity;
                $item->save();
            } else {
                $addtocart =  new AddToCart();
                $addtocart->product_id = $request->product_id;
                $addtocart->customer_id = auth()->user()->id;
                $addtocart->quantity =  $request->quantity;
                $addtocart->save();
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddToCart  $addToCart
     * @return \Illuminate\Http\Response
     */
    public function show(AddToCart $addToCart)
    {
        if (count($addToCart->all()))

            return 0;

        else return 1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AddToCart  $addToCart
     * @return \Illuminate\Http\Response
     */
    public function edit(AddToCart $addToCart)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AddToCart  $addToCart
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, AddToCart $addToCart)
    {
        if (!Auth::check()) {
            $value = '/addtocart';
            session(['url' => '/addtocart']);
            return response(0);
        } else {

            $cookies = Cookie::get('user');
            $data =   $cookies ? json_decode($cookies, true) : $request->data;
            foreach ($data as $item) {
                $addtocart = AddToCart::updateOrCreate(
                    ['product_id' =>  $item['product_id'], 'customer_id' => auth()->user()->id],
                    ['quantity'  =>  $item['quantity']],
                );
            }
            return response('Hello World')->withoutCookie('user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddToCart  $addToCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddToCart $addtocart)
    {
        // dd($addtocart);
        $addtocart->delete();
    }
}
