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
                    <h5>List of All Categories</h5>
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
                                </tr>
                                <th class="text-center">SL</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th class="text-center no-sort">Active Status</th>
                                <th class="text-center no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td class="text-center">{{ ++$key }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td class="text-center">

                                            @if ($category->is_active == 1)
                                                <form action="{{ route('categories.changeStatus', $category->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('GET')

                                                    <button type="submit" class="btn btn-success">Active</button>
                                                </form>
                                            @else
                                                <form action="{{ route('categories.changeStatus', $category->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('GET')

                                                    <button type="submit" class="btn btn-danger">Inactive</button>
                                                </form>
                                            @endif

                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
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
                responsive: true,
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }],
            });
        });
    </script>
@endpush
