@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <a href="{{ route('home') }}" class="btn btn-primary mb-2 float-start">Home</a>
            <a href="{{ route('order.index') }}" class="btn btn-primary mb-2 float-end">Back</a>
        </div>
        <div class="col-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

{{--            @dd($carts)--}}

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Information</h5>
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <table class="table table-hover table-bordered">
                            <thead>
                                Shopping Cart Items
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Product</th>
                                    <th>Weight (Change if not accurate)</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                </tr>
                            @foreach($carts as $cart)
                                @if($cart->quantity > 0)
                                    <tr>
                                        <td>
                                            <input type="hidden" class="form-check-inline" name="item[{{$cart->product->id}}][product_id]" value="{{ $cart->product->id }}">
                                            {{ $cart->product->name }}
                                        </td>
                                        <td>
                                            <input type="text" class="form-check-inline" name="item[{{$cart->product->id}}][accurate_weight]" placeholder="Enter Accurate Weight" value="{{ $cart->product->weight }}">
                                            {{ $cart->product->unit }}
                                        </td>
                                        <td>
                                            <input type="hidden" class="form-check-inline" name="item[{{$cart->product->id}}][quantity]" value="{{ $cart->quantity }}">
                                            {{ $cart->quantity }}
                                        </td>
                                        <td>
                                            <input type="hidden" class="form-check-inline" name="item[{{$cart->product->id}}][unit_price]" value="{{ $cart->product->unit_price }}">
                                            {{ $cart->product->unit_price }}
                                        </td>
                                        <td>
                                            <input type="hidden" class="form-check-inline" name="item[{{$cart->product->id}}][sub_total]" placeholder="" value="{{ $cart->product->unit_price*$cart->quantity }}">
                                            {{ $cart->product->unit_price*$cart->quantity }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
