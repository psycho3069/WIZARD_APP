<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::query()->where('user_id',auth()->user()->getAuthIdentifier())->get();
        return view('cart.index',compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cart.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        $product = Product::query()->where('barcode',$request->barcode)->first();
        if ($product){
            $cart = Cart::query()
                ->where('product_id',$product->id)
                ->where('user_id',auth()->user()->getAuthIdentifier())
                ->first();
            if ($cart){
                $cart->quantity++;
                $cart->save();
                Session::flash('status', 'Product ('.$product->name.' - '.$product->weight.$product->unit.') Added To CART (Total '.$cart->quantity.') Successfully!');
            } else {
                Cart::query()->create([
                    'product_id' => $product->id,
                    'user_id' => auth()->user()->getAuthIdentifier(),
                    'quantity' => 1,
                ]);
                Session::flash('status', 'Product ('.$product->name.' - '.$product->weight.$product->unit.') Added To CART (Total 1) Successfully!');
            }
        } else {
            Session::flash('status', 'Invalid Barcode!');
            return redirect()->back();
        }
        return redirect()->route('cart.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
