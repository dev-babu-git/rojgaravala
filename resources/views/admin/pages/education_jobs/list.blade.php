@extends('admin.layout.app')

@section('title', 'Education Wise Jobs')

@section('content')
<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Education Wise Jobs</h1></div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('education-jobs.create') }}" class="btn btn-outline-primary">New Job</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Filter Form -->
            <div class="card mb-2">
                <div class="card-body">
                    <form action="{{ route('education-jobs.index') }}" method="GET" class="row g-2">
                        <div class="col-md-6">
                            <input type="text" name="title" class="form-control" placeholder="Job Title" value="{{ request('title') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="status" class="form-control">
                                <option value="">-- Select Status --</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-primary">Filter</button>
                            <a href="{{ route('education-jobs.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Jobs Table -->
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th width="160">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($educationJobs as $edu)
                            <tr>
                                <!-- Row Number -->
                                <td>{{ ($educationJobs->currentPage() - 1) * $educationJobs->perPage() + $loop->iteration }}</td>

                                <!-- Title -->
                                <td>{{ $edu->title }}</td>

                                <!-- Status Toggle -->
                                <td>
                                      @php $type = 'EducationJob'; @endphp
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="switch{{ $edu->id }}"
                                            {{ $edu->status == 1 ? 'checked' : '' }}
                                            onchange="changeStatus('{{ $edu->id }}', '{{ $type }}')">
                                        <label class="custom-control-label" for="switch{{ $edu->id }}"></label>
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="text-center">

                                    <!-- Preview -->
                                    <button class="btn btn-sm btn-outline-info mx-1 previewBtn"
                                            data-title="{{ $edu->title }}"
                                            data-status="{{ $edu->status }}"
                                            data-created="{{ $edu->created_at }}"
                                            data-updated="{{ $edu->updated_at }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- Edit -->
                                    <a href="{{ route('education-jobs.edit', $edu->id) }}" class="btn btn-sm btn-outline-primary mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('education-jobs.destroy', $edu->id) }}"
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
                        @if ($educationJobs->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">«</span></li>
                        @else
                        <li class="page-item"><a class="page-link" href="{{ $educationJobs->previousPageUrl() }}">«</a></li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($educationJobs->getUrlRange(1, $educationJobs->lastPage()) as $page => $url)
                        <li class="page-item {{ $educationJobs->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($educationJobs->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $educationJobs->nextPageUrl() }}">»</a></li>
                        @else
                        <li class="page-item disabled"><span class="page-link">»</span></li>
                        @endif
                    </ul>
                </div>

            </div>

        </div>
    </section>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Job Preview</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Title</th>
                        <td id="pvTitle"></td>
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

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Preview Modal
        $(".previewBtn").click(function() {
            $("#pvTitle").text($(this).data("title"));
            $("#pvStatus").text($(this).data("status") == 1 ? "Active" : "Inactive");
            $("#pvCreated").text($(this).data("created"));
            $("#pvUpdated").text($(this).data("updated"));
            $("#previewModal").modal("show");
        });
    });

    
</script>
@endsection
