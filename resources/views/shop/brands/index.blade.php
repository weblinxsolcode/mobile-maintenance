@extends('shop.layout.main')


@section('section')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12 d-flex align-items-center justify-content-between">
                        <h3 class="page-title">{{ $title }}</h3>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                            <i class="fe fe-plus"></i> Add
                        </button>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">

                                <div class="tab-pane show active" id="tab1" bis_skin_checked="1">
                                    <table class="datatable table table-hover table-center mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($brand as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>

                                                    <td>
                                                        {{ ucfirst($item->name) }}
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-sm bg-info text-white" data-bs-toggle="modal"
                                                            data-bs-target="#editBrand{{ $item->id }}">
                                                            <i class="fe fe-edit"></i> Edit
                                                        </button>
                                                        <button class="btn btn-sm bg-danger text-white"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteManagement{{ $item->id }}">
                                                            <i class="fe fe-trash"></i>
                                                            Delete
                                                        </button>

                                                    </td>

                                                </tr>
                                                {{-- Delete Modal --}}
                                                <div class="modal fade" id="deleteManagement{{ $item->id }}"
                                                    tabindex="-1"
                                                    aria-labelledby="deleteManagementLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteManagementLabel{{ $item->id }}">Confirm
                                                                    Deletion| {{ ucfirst($item->name) }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                Are you sure you want to delete this brand?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <a href="{{ route('shop.brands.delete', $item->id) }}"
                                                                    class="btn btn-danger">
                                                                    Yes, Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Edit Brand Modal -->
                                                <div class="modal fade" id="editBrand{{ $item->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <form action="{{ route('shop.brands.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Brand</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <label>Brand Name</label>
                                                                    <input type="text" name="name"
                                                                        value="{{ $item->name }}" class="form-control"
                                                                        required>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit"
                                                                        class="btn btn-success">Update</button>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- /Recent Orders -->

                </div>
            </div>
        </div>
    </div>

    <!-- Add Brand Modal -->
    <div class="modal fade" id="addBrandModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('shop.brands.store') }}" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Brand</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <label>Brand Name</label>
                        <input type="text" name="name" placeholder="Please enter brand name" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
