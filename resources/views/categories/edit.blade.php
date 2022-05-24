@extends('layouts.app')

@section('title', 'Update Category')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 w-75">

            <div class="row justify-content-center my-3 g-0">
                <div class="col-12 text-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to Home</a>
                </div>
            </div>

            <form method="post" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Update Category</h4>
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
                                <input type="text" id="category_name" class="form-control"
                                    value="{{ $category->name }}" name="name"
                                    placeholder="Enter category name" required autofocus>
                            </div>
                        </div>

                        <div class="card-footer float-end">
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
