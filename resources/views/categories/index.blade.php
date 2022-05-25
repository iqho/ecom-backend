@extends('layouts.app')

@section('title', 'All Categories')

@section('content')

    <div class="row justify-content-center mb-2">
        <div class="col-md-12">

            <div class="row justify-content-center my-3 g-0">
                <div class="col-12 text-end">
                    <a class="btn btn-primary" href="{{ route('categories.create') }}">Add New Category</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>List of All Categories</h4>
                </div>
                <div class="card-body">

                    @if (session('status'))
                        <div class="row">
                            <div class="col-12 alert alert-success text-center" role="alert">
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif

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

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped">
                            <thead>
                                <tr>
                                <th class="text-center">SL</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th class="text-center no-sort">Image</th>
                                <th class="text-center">CreatedBy</th>
                                <th class="text-center no-sort">Active Status</th>
                                <th class="text-center no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i =  count($categories); @endphp
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td class="text-center">{{ $i-- }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td class="text-center">
                                            @if ($category->image && (file_exists(public_path('category-images/'. $category->image ))))
                                                <img src="{{ asset('category-images/'.$category->image) }}" height="50" width="60">
                                            @else
                                                <small>No Image</small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(!empty($category->users->name))
                                                {{ $category->users->name }}
                                            @else
                                                <span>No Creator Found</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('categories.changeStatus', $category->id)}}" method="post">
                                                @csrf
                                                @method('GET')

                                                    @if ($category->is_active == 1)
                                                        <button type="submit" class="btn btn-success">Active</button>
                                                    @else
                                                        <button type="submit" class="btn btn-danger">Inactive</button>
                                                    @endif

                                                </form>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('categories.show', $category->id) }}"
                                                    class="btn btn-primary me-1"><i class="fa fa-eye"></i></a>

                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                    class="btn btn-info me-1"><i class="fa fa-edit"></i></a>

                                                <form action="{{ route('categories.destroy', $category->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure want to delete this category ?')"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable({
                order: [0,'desc'],
                responsive: true,
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }],
            });
        });
    </script>
@endpush
