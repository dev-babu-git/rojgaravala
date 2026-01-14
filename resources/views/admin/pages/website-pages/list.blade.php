@extends('admin.layout.app')

@section('title', 'Pages')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pages</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('website-pages.create') }}" class="btn btn-outline-primary">New Page</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Page Preview</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <table class="table table-bordered">
                        <tr>
                            <th width="150">Name</th>
                            <td id="pvName"></td>
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
                    </table>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Success Message -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success') }}
            </div>
            @endif

            <!-- Filter -->
            <div class="card mb-3">
                <div class="card-body">
                    <form action="{{ route('website-pages.index') }}" method="GET" class="row g-2">

                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control"
                                placeholder="Page Name"
                                value="{{ request('name') }}">
                        </div>

                        <div class="col-md-4">
                            <select name="status" class="form-control">
                                <option value="">-- Select Status --</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <button class="btn btn-outline-primary">Filter</button>
                            <a href="{{ route('website-pages.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>

                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                       
                            @foreach ($listData as $page)
                            
                            <tr>
                                <td>{{ ($listData->currentPage() - 1) * $listData->perPage() + $loop->iteration }}</td>
                                <td>{{ $page->name }}</td>
                                <td>
                                    @if($page->description)
                                    <div style="max-height:45px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; width:230px;">
                                        {{ strlen(strip_tags(html_entity_decode($page->description))) > 60
                                            ? Str::limit(strip_tags(html_entity_decode($page->description)), 60)
                                            : strip_tags(html_entity_decode($page->description)) }}
                                    </div>
                                    @else
                                    <span class="text-muted">— NA —</span>
                                    @endif
                                </td>
                                <td>
                                    @if($page->status !== null)

                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="switch{{ $page->id }}" {{ $page->status ? 'checked' : '' }} onchange="changeStatus('{{ $page->id }}','WebsitePage')">
                                        <label class="custom-control-label" for="switch{{ $page->id }}"></label>
                                    </div>
                                    @else
                                    <span class="text-muted">— NA —</span>
                                    @endif
                                </td>
                                <td>{{ $page->created_at ?? '— NA —' }}</td>
                                <td>{{ $page->updated_at ?? '— NA —' }}</td>
                                <td class="text-center">
                                    <!-- Preview -->
                                    <button class="btn btn-sm btn-outline-info mx-1 previewBtn"
                                        data-name="{{ $page->name }}"
                                        data-description="{{ strip_tags($page->description) }}"
                                        data-status="{{ $page->status }}"
                                        data-created="{{ $page->created_at }}"
                                        data-updated="{{ $page->updated_at }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- Edit -->
                                    <a href="{{ route('website-pages.edit', $page->id) }}" class="btn btn-sm btn-outline-primary mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('website-pages.destroy', $page->id) }}" method="POST" class="d-inline-block mx-1" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
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

                        {{-- Previous Page --}}
                        @if ($listData->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">«</span></li>
                        @else
                        <li class="page-item"><a class="page-link" href="{{ $listData->previousPageUrl() }}">«</a></li>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($listData->getUrlRange(1, $listData->lastPage()) as $pageNum => $url)
                        <li class="page-item {{ $listData->currentPage() == $pageNum ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $pageNum }}</a>
                        </li>
                        @endforeach

                        {{-- Next Page --}}
                        @if ($listData->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $listData->nextPageUrl() }}">»</a></li>
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

            $("#pvName").text($(this).data("name"));
            $("#pvDescription").text($(this).data("description"));
            $("#pvStatus").text($(this).data("status") == 1 ? "Active" : "Inactive");
            $("#pvCreated").text($(this).data("created"));
            $("#pvUpdated").text($(this).data("updated"));

            $("#previewModal").modal("show");
        });

    });
</script>
@endsection