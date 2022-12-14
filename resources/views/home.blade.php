@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @if(auth()->user()->type == 'admin' || auth()->user()->type == 'sub_admin')
                            <a href="{{ route('product.index') }}" class="btn btn-outline-primary fw-bold">Products</a>
                        @elseif(auth()->user()->type == 'customer')
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-info fw-bold">Shopping Cart</a>
                        @endif
                        <a href="{{ route('order.index') }}" class="btn btn-outline-secondary fw-bold">Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
