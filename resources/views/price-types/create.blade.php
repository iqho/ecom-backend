@extends('layouts.app')

@section('title', 'Add New Price Type')

@section('content')

    <div class="card mt-2">
        <div class="card-header">
            <h4 class="d-inline-block">Add New Price Type</h4>
            <a href="{{ route('priceType.index') }}" class="btn btn-success float-end">Back to All Price Types</a>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger p-1 m-0">
                            <ul class="g-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('priceType.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-12 mb-3 mt-1">
                                <label for="name" class="form-label">Price Type Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="name" placeholder="Price Type Name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Add Price Type</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
