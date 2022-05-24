@extends('layouts.app')

@section('title','Show Product')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12  w-75">

            <div class="row justify-content-center my-3 g-0">
                <div class="col-12 text-end">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Home</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3>Show Product Details</h3></div>

                <div class="card-body">
                    <div class="row p-1">
                        <div class="col-3">
                            <strong>Name :</strong>
                        </div>
                        <div class="col-9">
                            {{ $product->name }}
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-3">
                            <strong>Category Name :</strong>
                        </div>
                        <div class="col-9">
                            {{ optional($product->category)->category_name ?? 'null' }}
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-3">
                            <strong>Price :</strong>
                        </div>
                        <div class="col-9">
                            {{ $product->price }}
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-3">
                            <strong>Description :</strong>
                        </div>
                        <div class="col-9">
                            {{ $product->description }}
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-3">
                            <strong>Image :</strong>
                        </div>
                        <div class="col-9">
                            @if ($product->image && (file_exists(public_path('product-images/'. $product->image ))))
                                <img src="{{ asset('product-images/'.$product->image) }}" height="150" width="250">
                            @else
                                <small>No Image</small>
                            @endif
                        </div>
                    </div>

                </div>
            </div>  <!-- /.card -->
        </div>
    </div>
@endsection
