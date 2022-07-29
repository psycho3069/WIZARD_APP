<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderItem;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->type == 'admin' || auth()->user()->type == 'sub_admin'){
            $orders = Order::all();
        } elseif (auth()->user()->type == 'customer'){
            $orders = Order::query()->where('user_id',auth()->user()->getAuthIdentifier())->get();
        }
        return view('order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carts = Cart::query()->where('user_id',auth()->user()->getAuthIdentifier())->get();
        return view('order.add',compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        try {
            DB::beginTransaction();

            $count = Order::query()->where('user_id',auth()->user()->getAuthIdentifier())->count();

            $order = Order::query()->create([
                'user_id' => auth()->user()->getAuthIdentifier(),
                'order_number' => 'PON'.date('d-m-y').str_pad(auth()->user()->getAuthIdentifier(),3,'0',STR_PAD_LEFT).str_pad($count+1,3,'0',STR_PAD_LEFT),
                'order_date' => date('Y-m-d'),
            ]);

            $cart = Cart::query()
                ->where('user_id',auth()->user()->getAuthIdentifier())
                ->update([
                    'quantity' => 0
                ]);

            $total = 0;

            foreach ($request->item as $item){
                $total += $item['sub_total'];
                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'accurate_weight' => $item['accurate_weight'],
                    'quantity' => $item['quantity'],
                    'sub_total' => $item['sub_total'],
                ]);
            }

            $order->update([
                'total_price' => $total,
                'status' => 'confirmed',
            ]);

            $details = [
                'title' => 'Order Confirmed',
                'body' => 'Hello '.auth()->user()->name.'. Your order has been confirmed. Order number '.$order->order_number.'. was received at '.$order->order_date
            ];

            Mail::to(auth()->user()->email)->send(new \App\Mail\OrderConfirmationMail($details));

            DB::commit();

            return redirect()->route('order.index');
        } catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
