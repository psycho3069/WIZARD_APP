@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <a href="{{ route('home') }}" class="btn btn-primary mb-2 float-start">Home</a>
            <a href="{{ route('product.index') }}" class="btn btn-primary mb-2 float-end">Back</a>
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
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product Information</h5>
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                    <label for="name">Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="barcode" placeholder="Enter Barcode">
                                    <label for="barcode">Barcode</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="unit" placeholder="Enter Unit">
                                    <label for="unit">Unit</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="weight" placeholder="Enter Weight">
                                    <label for="weight">Weight</label>
                                </div>
                            </div>
                        </div>

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
