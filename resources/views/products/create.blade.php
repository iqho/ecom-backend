@extends('layouts.app')

@section('title', 'Create New Product')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12 w-75">

            <div class="row justify-content-center my-3 g-0">
                <div class="col-12 text-end">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Home</a>
                </div>
            </div>

            <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Create Product</h4>
                    </div>

                    <div class="card-body">

                        @if ($errors->any())
                            <div class="row">
                                <div class="col-12 alert alert-danger p-1 m-0">
                                    <ul class="g-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="row p-3">
                            <label for="name" class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input type="text" id="name" class="form-control" value="{{ old('name') }}" name="name"
                                    placeholder="Enter Product name" required autofocus>
                            </div>
                        </div>

                        <div class="row p-3">
                            <label for="category" class="col-md-2 col-form-label">Category</label>
                            <div class="col-md-10">
                                <select class="form-control" name="category_id">
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row p-3">
                            <label for="price" class="col-md-2 col-form-label">Price</label>
                            <div class="col-md-10">
                                <input type="number" id="price" class="form-control" value="{{ old('price') }}"
                                    name="price" placeholder="Enter Product price">
                            </div>
                        </div>

                        <div class="row p-3">
                            <label for="image" class="col-md-2 col-form-label">Image</label>
                            <div class="col-md-10">
                                <input type="file" id="image" class="form-control" value="{{ old('image') }}"
                                    name="image">
                            </div>
                        </div>

                        <div class="row p-3">
                            <label for="description" class="col-md-2 col-form-label">Description</label>
                            <div class="col-md-10">
                                <textarea type="text" id="description" class="form-control" value="{{ old('description') }}" name="description"
                                    placeholder="Enter Product Details"></textarea>
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-2">Active Status</div>
                            <div class="col-4">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" style="transform: scale(1.5); margin-right:8px" checked>
                                <label class="form-check-label" for="is_active">Active </label>
                            </div>
                        </div>

                        <div class="card-footer float-end">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
