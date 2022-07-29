@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="{{ route('home') }}" class="btn btn-primary mb-2 float-start">Home</a>
                <a href="{{ route('product.create') }}" class="btn btn-primary mb-2 float-end">Create product</a>
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
                                <th>Name</th>
                                <th>Barcode</th>
                                <th>Unit</th>
                                <th>Unit Price</th>
                                <th>Weight</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->barcode }}</td>
                                    <td>{{ $product->unit }}</td>
                                    <td>{{ $product->unit_price }}</td>
                                    <td>{{ $product->weight }}</td>
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

