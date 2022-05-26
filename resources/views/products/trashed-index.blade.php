@extends('layouts.app')

@section('title', 'All Products')

@section('content')

    <div class="row justify-content-center mb-2">
        <div class="col-md-12">

            <div class="row justify-content-center my-3 g-0">
                <div class="col-12 text-end">
                    <a class="btn btn-primary" href="{{ route('products.index') }}">All Products</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>All Trashed Products List</h4>
                </div>
                <div class="card-body">

                    @if (session('status'))
                        <div class="row">
                            <div class="col-12 alert alert-success text-center" role="alert">
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th class="text-center no-sort">Image</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">CreatedBy</th>
                                    <th class="text-center no-sort">Active Status</th>
                                    <th class="text-center no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = $products->count();
                                @endphp
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td class="text-center">{{ $i-- }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td class="text-center">
                                            @if ($product->image)
                                                @if (file_exists(public_path('product-images/' . $product->image)))
                                                    <img src="{{ asset('product-images/' . $product->image) }}"
                                                        height="45" width="60">
                                                @else
                                                    <small>Image not exists in path</small>
                                                @endif
                                            @else
                                                <small>No Image</small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @forelse ($product->productPrices as $row)
                                                <div style="border-bottom: 1px solid #ccc">
                                                    {{ $row->priceType->name ?? 'No Price Type' }} :
                                                    {{ $row->amount ?? 'No Price' }}
                                                    <br>
                                                    @if ($row->start_date)
                                                        <small class="text-success"> Start From:
                                                            {{ date('d F Y', strtotime($row->start_date)) }} <br>
                                                        </small>
                                                    @endif
                                                </div>
                                            @empty
                                                <small>No Price</small>
                                            @endforelse
                                        </td>
                                        <td class="text-center">{{ optional($product->category)->name }}</td>
                                        <td class="text-center">{{ optional($product->users)->name }}</td>
                                        <td class="text-center">
                                                @if ($product->is_active == 1)
                                                    <button type="button" class="btn btn-success">Active</button>
                                                @else
                                                    <button type="button" class="btn btn-danger">Inactive</button>
                                                @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">

                                                <a href="{{ route('products.trashedRestore', $product->id) }}"
                                                    class="btn btn-success me-1" onclick="return confirm('Are you sure you want to Restore this product ?')" title="Restore"><i class="fa-solid fa-recycle"></i></a>

                                                <form action="{{ route('products.forceDelete', $product->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this product parmanently ?')" title="Parmanent Delete">
                                                        <i class="fa-solid fa-trash-can"></i></button>
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
                order: [0, 'desc'],
                responsive: true,
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }],
            });
        });
    </script>
@endpush
