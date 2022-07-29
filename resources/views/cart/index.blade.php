@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="{{ route('cart.create') }}" class="btn btn-primary mb-2 float-end">Create cart</a>
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
                                <tr>
                                    <td>{{ $cart->product->name }}</td>
                                    <td>{{ $cart->product->unit }}</td>
                                    <td>{{ $cart->product->weight }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

