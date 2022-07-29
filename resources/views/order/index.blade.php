@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="{{ route('home') }}" class="btn btn-primary mb-2 float-start">Home</a>
                <a href="{{ route('order.create') }}" class="btn btn-primary mb-2 float-end">Create Order</a>
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
                                @if(auth()->user()->type == 'admin' || auth()->user()->type == 'sub_admin')
                                    <th>User</th>
                                    <th>Email</th>
                                @endif
                                <th>Order Number</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Total Price</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    @if(auth()->user()->type == 'admin' || auth()->user()->type == 'sub_admin')
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->user->email }}</td>
                                    @endif
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->total_price }}</td>
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

