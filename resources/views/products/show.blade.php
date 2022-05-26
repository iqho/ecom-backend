@extends('layouts.app')

@section('title', 'Show Product')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="row justify-content-center my-3 g-0">
                <div class="col-12 text-end">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Back to All Products</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Show Product Details</h4>
                </div>

                <div class="card-body">
                    <div class="row p-1">
                        <div class="col-3 text-end">
                            <strong>Name :</strong>
                        </div>
                        <div class="col-9">
                            {{ $product->name }}
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-3 text-end">
                            <strong>Category Name :</strong>
                        </div>
                        <div class="col-9">
                            {{ optional($product->category)->name }}
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-3 text-end">
                            <strong>Price :</strong>
                        </div>
                        <div class="col-9">
                            @forelse ($product->productPrices as $row)
                                <div style="border-bottom: 1px solid #ccc; width:350px">
                                    {{ $row->priceType->name ?? 'No Price Type' }} :
                                    <strong>{{ $row->amount ?? 'No Price' }}</strong> -

                                    @if ($row->start_date)
                                        <small class="text-success"> Start From:
                                            {{ date('d F Y', strtotime($row->start_date)) }} <br>
                                        </small>
                                    @endif
                                </div>
                            @empty
                                <small>No Price</small>
                            @endforelse
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-3 text-end">
                            <strong>Description :</strong>
                        </div>
                        <div class="col-9">
                            {{ $product->description }}
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-3 text-end">
                            <strong>Image :</strong>
                        </div>
                        <div class="col-9">
                            @if ($product->image && file_exists(public_path('product-images/' . $product->image)))
                                <img src="{{ asset('product-images/' . $product->image) }}" height="150" width="250">
                            @else
                                <small>No Image</small>
                            @endif
                        </div>
                    </div>

                </div>
            </div> <!-- /.card -->
        </div>
    </div>
@endsection
