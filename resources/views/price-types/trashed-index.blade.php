@extends('layouts.app')

@section('title', 'All Trashed Price Types')

@section('content')
    <div class="card mt-2">
        <div class="card-header">
            <h4 class="d-inline-block">All Trashed Price Types</h4>
            <a href="{{ route('priceType.create') }}" class="btn btn-success float-end">Create New Price Type</a>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-12">
                    @if ($message = Session::get('success'))
                        <div id="success" class="alert alert-success alert-dismissible fade show p-2 m-3" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div id="successMessage" class="alert alert-success alert-dismissible fade show p-2 text-center"
                        role="alert" style="display: none; margin:0 auto; width:400px">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Price Type Name</th>
                                    <th>Price Type Slug</th>
                                    <th class="text-center">CreatedBy</th>
                                    <th class="text-center no-sort">Actvie Status</th>
                                    <th class="text-center no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php $i =  count($priceTypes); @endphp

                                @foreach ($priceTypes as $ptype)
                                    <tr>
                                        <td class="text-center">{{ $i-- }}</td>
                                        <td>{{ $ptype->name }}</td>
                                        <td>{{ $ptype->slug }}</td>
                                        <td class="text-center">
                                            @if (!empty($ptype->users->name))
                                                {{ $ptype->users->name }}
                                            @else
                                                <span>No Creator Found</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <input data-id="{{ $ptype->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="Inactive"
                                                {{ $ptype->is_active ? 'checked' : '' }}>
                                        </td>
                                        <td style="max-width: 150px; text-align:right">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('priceType.trashedRestore', $ptype->id) }}"
                                                        class="btn btn-success me-1" title="Restore" onclick="return confirm('Are you sure you want to restore this price type ?')"><i class="fa-solid fa-recycle"></i></a>

                                                <form action="{{ route('priceType.forceDelete', $ptype->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure want to delete this Price Type Parmanently ?')" title="Delete Parmanently">
                                                        <i class="fa-solid fa-trash-can"></i></button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div> <!-- Close Responsive Table -->
                </div>
            </div> <!-- Close Table Row -->

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                //console.log(status);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('priceType.changeStatus') }}',
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        $("#successMessage").html(data.success).show().delay(3000).fadeOut(
                            400);;
                    }
                });
            })
        })

        // Hide Flash Message After 5 Second
        $(document).ready(function() {
            $('#datatable').DataTable({
                order: [0, 'desc'],
                responsive: true,
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }],
            });

            // Hide Success Message
            $("#success").delay(5000).slideUp(300);
        });
    </script>
@endpush
