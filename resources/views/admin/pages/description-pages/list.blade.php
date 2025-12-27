@extends('admin.layout.app')

@section('title', 'Description Page')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Description Page</h1>
                </div>
                <div class="col-sm-6 text-right">

                    <a href="{{ route('description-pages.create') }}" class="btn btn-outline-primary">
                        <i class="fa fa-plus"></i> New Post
                    </a>

                </div>
            </div>
        </div>
    </section>
    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Description Page Preview</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <table class="table table-bordered">
                        <tr>
                            <th>Category</th>
                            <td id="pvCategory"></td>
                        </tr>

                        <tr>
                            <th>Subcategory</th>
                            <td id="pvSubcategory"></td>
                        </tr>

                        <tr>
                            <th>Title</th>
                            <td id="pvName"></td>
                        </tr>
                        <tr>
                            <th>Eligibility</th>
                            <td id="pvEligibility"></td>
                        </tr>

                        <tr>
                            <th>State</th>
                            <td id="pvState"></td>
                        </tr>

                        <tr>
                            <th>Job Brand</th>
                            <td id="pvJobbrand"></td>
                        </tr>

                        <tr>
                            <th>Slug</th>
                            <td id="pvSlug"></td>
                        </tr>

                        <tr>
                            <th>Description</th>
                            <td id="pvDescription"></td>
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

                        <tr>
                            <th>Meta Description </th>
                            <td id="pvmetadescription"></td>
                        </tr>
                        <tr>
                            <th>mets Keyword</th>
                            <td id="pvmetakeyword"></td>
                        </tr>
                        <tr>
                            <th>Meta Title</th>
                            <td id="pvmetatitle"></td>
                        </tr>


                    </table>

                </div>

            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Success Message -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success') }}
            </div>
            @endif

            <!-- Filter Card -->
            <div class="card mb-2">
                <div class="card-body">
                    <form method="GET" action="{{ route('description-pages.index') }}" class="mb-3">

                        <div class="row">

                            <!-- Title Filter -->
                            <div class="col-md-1">
                                <input type="text" name="title" class="form-control"
                                    placeholder="Search by Title"
                                    value="{{ request('title') }}">
                            </div>

                            <!-- Status Filter -->
                            <div class="col-md-1">
                                <select name="status" class="form-control">
                                    <option value="">-- Status --</option>
                                    <option value="1" {{ request('status') == "1" ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ request('status') == "0" ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <!-- Category Filter -->
                            <div class="col-md-2">
                                <select name="category_id" class="form-control">
                                    <option value="">-- Category --</option>
                                    @foreach(\App\Models\Category::all() as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Author Filter -->
                            <div class="col-md-2">
                                <select name="author_id" class="form-control">
                                    <option value="">-- Author --</option>
                                    @foreach(\App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}" {{ request('author_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date Filter -->

                            <div class="col-md-2 d-flex">
                                <span class="small text-muted">From Date</span>
                                <input type="date" name="from_date" class="form-control"
                                    value="{{ request('from_date') }}">
                            </div>

                            <div class="col-md-2 d-flex">
                                <span class="small text-muted">End Date</span>
                                <input type="date" name="to_date" class="form-control"
                                    value="{{ request('to_date') }}">
                            </div>

                            <!-- Buttons -->
                            <div class="col-md-1 d-flex text-right">
                                <button class="btn btn-outline-primary">Filter</button>
                                <a href="{{ route('description-pages.index') }}" class="btn btn-outline-secondary ml-1">Reset</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-body table-responsive p-0">

                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Title</th>
                                <th>Eligibility</th>
                                <th>State</th>
                                <th>Job Brand</th>
                                <th>Author</th>

                                @if(auth()->user()->role == 'saysadmin')
                                <th width="100">Status</th>
                                @endif
                                <th width="120">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pagesData as $page)
                            <tr>

                                <td>{{ ($pagesData->currentPage() - 1) * $pagesData->perPage() + $loop->iteration }}</td>

                                <td td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $page->category->name ?? '' }}">
                                    {{ $page->category->name ?? '-' }}
                                </td>
                                <!-- <td>{{ $page->subcategory->name ?? '-' }}</td> -->
                                <td>
                                    @php
                                    $subcatIds = explode(',', $page->subcategory_id); // get IDs as array
                                    $subcatNames = \App\Models\Subcategory::whereIn('id', $subcatIds)->pluck('name')->toArray();
                                    $subcatText = implode(', ', $subcatNames);
                                    @endphp
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $subcatText }}">
                                        {{ truncate_chars($subcatText) }}
                                    </span>
                                </td>

                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $page->title ?? '' }}">
                                    {{ truncate_chars($page->title) }}
                                </td>

                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $page->eligibility ?? '-' }}">
                                    {{ truncate_chars($page->eligibility) ?? '-' }}
                                </td>

                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $page->state ?? '-' }}">
                                    {{ truncate_chars($page->state) ?? '-' }}
                                </td>

                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $page->jobbrand ?? '-' }}">
                                    {{ truncate_chars($page->jobbrand) ?? '-' }}
                                </td>

                                <td>{{ $page->user->name ?? 'N/A' }}</td>

                                @if(auth()->user()->role == 'saysadmin')
                                <td>
                                    @php $type = 'Description'; @endphp
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="switch{{ $page->id }}"
                                            {{ $page->status == 1 ? 'checked' : '' }}
                                            onchange="changeStatus('{{ $page->id }}', '{{ $type }}')">
                                        <label class="custom-control-label" for="switch{{ $page->id }}"></label>
                                    </div>
                                </td>
                                @endif

                                <td class="text-center">

                                    <!-- Preview -->
                                    <button class="btn btn-sm btn-outline-info mx-1 previewBtn"
                                        data-category="{{ $page->category->name ?? '-' }}"
                                        data-subcategory="{{ $page->subcategory->name ?? '-' }}"
                                        data-title="{{ $page->title }}"
                                        data-slug="{{ $page->slug }}"
                                        data-content="{{ $page->content }}"

                                        data-eligibility="{{ $page->eligibility }}"
                                        data-state="{{ $page->state }}"
                                        data-jobbrand="{{ $page->jobbrand }}"

                                        data-status="{{ $page->status }}"
                                        data-created="{{ $page->created_at }}"
                                        data-updated="{{ $page->updated_at }}"
                                        data-metatitle="{{ $page->meta_title }}"
                                        data-metadescription="{{ $page->meta_description }}"
                                        data-metakeyword="{{ $page->meta_keywords }}">

                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- Edit -->
                                    <a href="{{ route('description-pages.edit', $page->id) }}"
                                        class="btn btn-sm btn-outline-primary mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('description-pages.destroy', $page->id) }}"
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

                <!-- Pagination -->

                <div class="card-footer clearfix">
                    <ul class="pagination m-0 float-right">
                        {{-- Previous Page Link --}}
                        @if ($pagesData->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">«</span></li>
                        @else
                        <li class="page-item"><a class="page-link" href="{{ $pagesData->previousPageUrl() }}">«</a></li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($pagesData->getUrlRange(1, $pagesData->lastPage()) as $page => $url)
                        <li class="page-item {{ $pagesData->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($pagesData->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $pagesData->nextPageUrl() }}">»</a></li>
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
    $(document).ready(function() {

        $(".previewBtn").click(function() {

            $("#pvCategory").text($(this).data("category"));
            $("#pvSubcategory").text($(this).data("subcategory"));
            $("#pvName").text($(this).data("title"));
            $("#pvSlug").text($(this).data("slug"));

            $("#pvDescription").html($(this).data("content"));

            // New Fields
            $("#pvEligibility").text($(this).data("eligibility"));
            $("#pvState").text($(this).data("state"));
            $("#pvJobbrand").text($(this).data("jobbrand"));

            $("#pvStatus").text($(this).data("status") == 1 ? "Active" : "Inactive");
            $("#pvCreated").text($(this).data("created"));
            $("#pvUpdated").text($(this).data("updated"));
            $("#pvmetatitle").text($(this).data("metatitle"));
            $("#pvmetadescription").text($(this).data("metadescription"));
            $("#pvmetakeyword").text($(this).data("metakeyword"));
            $("#previewModal").modal("show");
        });



    });
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection