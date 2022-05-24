@extends('layouts.app')

@section('title', 'Create New Category')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12 w-75">

            <div class="row justify-content-center my-3 g-0">
                <div class="col-12 text-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to All Categories</a>
                </div>
            </div>

            <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Add New Category</h4>
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
                            <label for="category_name" class="col-md-3 col-form-label">Category Name</label>
                            <div class="col-md-9">
                                <input type="text" id="name" class="form-control"
                                    value="{{ old('name') }}" name="name"
                                    placeholder="Enter Category name" required autofocus>
                            </div>
                        </div>

                        <div class="card-footer float-end">
                            <button type="submit" class="btn btn-primary">Add New Category</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
