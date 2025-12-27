@extends('admin.layout.app')

@section('title', 'sub categories')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sub Categories</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('subcategories.create') }}" class="btn btn-outline-primary">New Sub Categories</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Preview Modal -->
            <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Subcategory Preview</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th>Category Name</th>
                                    <td id="pvCategory"></td>
                                </tr>

                                <tr>
                                    <th>Name</th>
                                    <td id="pvName"></td>
                                </tr>

                                <tr>
                                    <th>Slug</th>
                                    <td id="pvSlug"></td>
                                </tr>

                                <tr>
                                    <th>Description</th>
                                    <td id="pvDescription" style="white-space: pre-wrap;"></td>
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
            <div class="card mb-2">
                <div class="card-body">
                    <form method="GET" action="{{ route('subcategories.index') }}" class="mb-3">
                        <div class="row">

                            <!-- Name Filter -->
                            <div class="col-md-3">
                                <input type="text" name="name" class="form-control"
                                    placeholder="Search by Subcategory Name"
                                    value="{{ request('name') }}">
                            </div>

                            <!-- Status Filter -->
                            <div class="col-md-3">
                                <select name="status" class="form-control">
                                    <option value="">-- Status --</option>
                                    <option value="1" {{ request('status') == "1" ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ request('status') == "0" ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <!-- Parent Category Filter -->
                            <div class="col-md-3">
                                <select name="category_id" class="form-control">
                                    <option value="">-- Category --</option>
                                    @foreach(\App\Models\Category::all() as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="col-md-3 text-right">
                                <button class="btn btn-outline-primary">Filter</button>
                                <a href="{{ route('subcategories.index') }}" class="btn btn-outline-secondary ml-2">Reset</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <!-- Table -->
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <!-- Filter Form -->

                    <!-- End Filter Form -->

                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>Category</th>
                                <th>Subcategory Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th width="100">Status</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($subcategories as $category)
                            <tr>
                                <td>{{ ($subcategories->currentPage() - 1) * $subcategories->perPage() + $loop->iteration }}</td>

                                <!-- Parent Category -->
                                <td>{{ $category->category->name ?? '-' }}</td>

                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>

                                <!-- Short Description -->
                                <td>
                                    @if(!empty($category->description))
                                    <div style="
                                            max-height: 45px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            white-space: nowrap;
                                            width: 200px;">
                                        {!! Str::limit($category->description) !!}
                                    </div>
                                    @else
                                    <span class="text-muted">— NA -</span>
                                    @endif
                                </td>


                                <td>
                                    @php $type = 'SubCategory'; @endphp
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="switch{{ $category->id }}"
                                            {{ $category->status == 1 ? 'checked' : '' }}
                                            onchange="changeStatus('{{ $category->id }}', '{{ $type }}')">
                                        <label class="custom-control-label" for="switch{{ $category->id }}"></label>
                                    </div>
                                </td>


                                <td class="text-center">

                                    <!-- Preview -->
                                    <button class="btn btn-sm btn-outline-info mx-1 previewBtn"
                                        data-id="{{ $category->id }}"
                                        data-category="{{ $category->category->name ?? '-' }}"
                                        data-name="{{ $category->name }}"
                                        data-slug="{{ $category->slug }}"
                                        data-description="{{ strip_tags($category->description) }}"
                                        data-status="{{ $category->status }}"
                                        data-created="{{ $category->created_at }}"
                                        data-updated="{{ $category->updated_at }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- Edit -->
                                    <a href="{{ route('subcategories.edit', $category->id) }}"
                                        class="btn btn-sm btn-outline-primary mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('subcategories.destroy', $category->id) }}"
                                        method="POST"
                                        class="d-inline-block mx-1"
                                        onsubmit="return confirm('Are you sure?');">
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

                <div class="card-footer clearfix">
                    <ul class="pagination m-0 float-right">
                        {{-- Previous Page Link --}}
                        @if ($subcategories->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">«</span></li>
                        @else
                        <li class="page-item"><a class="page-link" href="{{ $subcategories->previousPageUrl() }}">«</a></li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($subcategories->getUrlRange(1, $subcategories->lastPage()) as $page => $url)
                        <li class="page-item {{ $subcategories->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($subcategories->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $subcategories->nextPageUrl() }}">»</a></li>
                        @else
                        <li class="page-item disabled"><span class="page-link">»</span></li>
                        @endif
                    </ul>
                </div>


            </div>

        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    $(document).on("click", ".previewBtn", function() {

        $("#pvCategory").text($(this).data("category"));
        $("#pvName").text($(this).data("name"));
        $("#pvSlug").text($(this).data("slug"));
        $("#pvDescription").text($(this).data("description"));
        $("#pvStatus").text($(this).data("status") == 1 ? "Active" : "Inactive");
        $("#pvCreated").text($(this).data("created"));
        $("#pvUpdated").text($(this).data("updated"));

        $("#previewModal").modal("show");
    });
</script>
@endsection