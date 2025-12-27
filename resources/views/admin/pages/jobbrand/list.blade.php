@extends('admin.layout.app')

@section('title', 'Job Brands')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Job Brands</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('jobbrand.create') }}" class="btn btn-outline-primary">New Brand</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Preview Modal -->
            <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Brand Preview</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name</th>
                                    <td id="pvName"></td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td id="pvCategory"></td>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td><img id="pvImage" src="" width="80"></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td id="pvStatus"></td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td id="pvCreated"></td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td id="pvUpdated"></td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success') }}
            </div>
            @endif

            <!-- Filter Form -->
            <div class="card mb-2">
                <div class="card-body">
                    <form action="{{ route('jobbrand.index') }}" method="GET" class="row g-2">

                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control"
                                placeholder="Brand Name" value="{{ request('name') }}">
                        </div>



                        <div class="col-md-3">
                            <select name="status" class="form-control">
                                <option value="">-- Select Status --</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-outline-primary">Filter</button>
                            <a href="{{ route('jobbrand.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-body table-responsive p-0">

                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>Brand Name</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th> Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            ?>
                            @foreach ($jobBrands as $brand)
                            <tr>

                                <td>{{ ($jobBrands->currentPage() - 1) * $jobBrands->perPage() + $loop->iteration }}</td>

                                <td>{{ $brand->name }}</td>

                                <td>{{ $brand->category->name ?? '' }}</td>

                                <td>
                                    @if($brand->image)
                                    <img src="{{ asset('uploads/jobbrand/' . $brand->image) }}" width="40">
                                    @else
                                    <span>No Image</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="switch{{ $brand->id }}"
                                            {{ $brand->status == 1 ? 'checked' : '' }}
                                            onchange="changeStatus('{{ $brand->id }}','JobBrand')">

                                        <label class="custom-control-label" for="switch{{ $brand->id }}"></label>
                                    </div>
                                </td>

                                <td class="text-center">

                                    <!-- Preview -->
                                    <button class="btn btn-sm btn-outline-info mx-1 previewBtn"
                                        data-name="{{ $brand->name }}"
                                        data-category="{{ $brand->category->name ?? '' }}"
                                        data-image="{{ asset('uploads/jobbrand/' . $brand->image) }}"
                                        data-status="{{ $brand->status }}"
                                        data-created    ="{{ $brand->created_at }}"
                                        data-updated="{{ $brand->updated_at }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <a href="{{ route('jobbrand.edit', $brand->id) }}"
                                        class="btn btn-sm btn-outline-primary mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('jobbrand.destroy', $brand->id) }}"
                                        method="POST" class="d-inline-block mx-1"
                                        onsubmit="return confirm('Are you sure?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <!-- Pagination -->
                <div class="card-footer clearfix">
                    {{ $jobBrands->links() }}
                </div>

            </div>

        </div>
    </section>

</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        $(".previewBtn").click(function() {

            $("#pvName").text($(this).data("name"));
            $("#pvCategory").text($(this).data("category"));
            $("#pvImage").attr("src", $(this).data("image"));
            $("#pvStatus").text($(this).data("status") == 1 ? "Active" : "Inactive");
            $("#pvCreated").text($(this).data("created"));
            $("#pvUpdated").text($(this).data("updated"));

            $("#previewModal").modal("show");
        });

    });
</script>
@endsection