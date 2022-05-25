@extends('layouts.app')

@section('title', 'Update Category')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="row justify-content-center my-3 g-0">
            <div class="col-12 text-end">
                <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to All Categories</a>
            </div>
        </div>

        <form method="post" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="card">

                <div class="card-header">
                    <h4 class="text-center">Update Category</h4>
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
                        <label for="category_name" class="col-md-3 col-form-label text-end">Category Name</label>
                        <div class="col-md-9">
                            <input type="text" id="category_name" class="form-control" value="{{ $category->name }}"
                                name="name" placeholder="Enter category name" required autofocus>
                        </div>
                    </div>

                    <div class="row p-3">
                        <label for="image" class="col-md-3 col-form-label text-end">Image</label>
                        <div class="col-md-7">
                            <input type="file" id="image" class="form-control" value="{{ old('image') }}" name="image">
                        </div>
                        <div class="col-md-2">
                            @if ($category->image && file_exists(public_path('category-images/' . $category->image)))
                            <img id="preview-image-before-upload"
                                src="{{ asset('category-images/' . $category->image) }}" height="50" width="60">
                            @else
                            <img id="preview-image-before-upload"
                                src="{{ asset('assets/images/image-not-available.jpg') }}" alt="preview image"
                                style="max-height: 60px; max-width:100px">
                            @endif
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Category</button>
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