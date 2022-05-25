@extends('layouts.app')

@section('title', 'Show Category Details')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12  w-75">

            <div class="row justify-content-center my-3 g-0">
                <div class="col-12 text-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to All Categories</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Show Category Details</h4>
                </div>

                <div class="card-body">
                    <div class="row p-1">
                        <div class="col-2">
                            <strong>Name :</strong>
                        </div>
                        <div class="col-10">
                            {{ $category->name }}
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-2">
                            <strong>Slug :</strong>
                        </div>
                        <div class="col-10">
                            {{ $category->slug }}
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-2">
                            <strong>Status :</strong>
                        </div>
                        <div class="col-10">
                            @if ($category['is_active'] == 1)
                                Active
                            @else
                                Inactive
                            @endif
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col-2">
                            <strong>CreatedBy :</strong>
                        </div>
                        <div class="col-10">
                            @if(!empty($category->users->name))
                                {{ $category->users->name }}
                            @else
                                <span>No Creator Found</span>
                            @endif
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-2">
                            <strong>Image :</strong>
                        </div>
                        <div class="col-10">
                            @if ($category->image && (file_exists(public_path('category-images/'. $category->image ))))
                                <img src="{{ asset('category-images/'.$category->image) }}" height="150" width="250">
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
