@extends('layouts.app')

@section('title', 'Create New Category')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">

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
                        <h4 class="text-center">Add New Category</h4>
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
                            <label for="name" class="col-md-3 col-form-label text-end">Category Name</label>
                            <div class="col-md-9 float-end">
                                <input type="text" id="name" class="form-control" value="{{ old('name') }}" name="name"
                                    placeholder="Enter Category Name" required autofocus>
                            </div>
                        </div>

                        <div class="row p-3">
                            <label for="image" class="col-md-3 col-form-label text-end">Category Image</label>
                            <div class="col-md-7">
                                <input type="file" id="image" class="form-control" value="{{ old('image') }}"
                                    name="image">
                            </div>
                            <div class="col-md-2">
                                <img id="preview-image-before-upload"
                                    src="{{ asset('assets/images/image-not-available.jpg') }}" alt="preview image"
                                    style="max-height: 60px; max-width:100px">
                            </div>
                        </div>

                        <div class="card-footer bg-white text-center border-0">
                            <button type="submit" class="btn btn-primary">Add New Category</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        // Upload Image Preview
        $(document).ready(function(e) {
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
