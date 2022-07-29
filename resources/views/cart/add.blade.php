@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <a href="{{ route('cart.index') }}" class="btn btn-primary mb-2 float-end">Back</a>
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
            @if (session('status'))
                <div class="alert alert-warning" role="alert">
                    <ul>
                        <li>{{ session('status') }}</li>
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Scan Product</h5>
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="barcode" placeholder="Scan Barcode">
                                    <label for="barcode">Barcode</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-md">Add To CART</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
