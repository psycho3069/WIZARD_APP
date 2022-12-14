@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="{{ route('home') }}" class="btn btn-primary mb-2 float-start">Home</a>
                <a href="{{ route('cart.create') }}" class="btn btn-primary mb-2 float-end">Add to CART</a>
            </div>
            <div class="col-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Unit</th>
                                <th>Weight</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($carts as $cart)
                                @if($cart->quantity > 0)
                                <tr>
                                    <td>{{ $cart->product->name }}</td>
                                    <td>{{ $cart->product->unit }}</td>
                                    <td>{{ $cart->product->weight }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <a href="{{ route('order.create') }}" class="btn btn-secondary my-2 float-end">Submit Order</a>
            </div>
        </div>
    </div>
@endsection

