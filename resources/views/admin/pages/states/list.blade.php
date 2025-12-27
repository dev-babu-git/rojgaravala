@extends('admin.layout.app')

@section('title', 'States')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>States</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('states.create') }}" class="btn btn-outline-primary">New State</a>
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
                            <h5 class="modal-title">State Preview</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th>Name</th>
                                    <td id="pvName"></td>
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
                    <form action="{{ route('states.index') }}" method="GET" class="row g-2">

                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control"
                                placeholder="State Name" value="{{ request('name') }}">
                        </div>

                        <div class="col-md-4">
                            <select name="status" class="form-control">
                                <option value="">-- Select Status --</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-outline-primary">Filter</button>
                            <a href="{{ route('states.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>

                    </form>
                </div>
            </div>

            <!-- States Table -->
            <div class="card">
                <div class="card-body table-responsive p-0">

                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>State Name</th>
                                <th width="100">Status</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($states as $state)
                            <tr>

                                <!-- Row Number -->
                                <td>{{ ($states->currentPage() - 1) * $states->perPage() + $loop->iteration }}</td>

                                <td>{{ $state->name }}</td>

                                <td>
                                       @php $type = 'State'; @endphp
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="switch{{ $state->id }}"
                                            {{ $state->status == 1 ? 'checked' : '' }}
                                            onchange="changeStatus('{{ $state->id }}', '{{ $type }}')">
                                        <label class="custom-control-label" for="switch{{ $state->id }}"></label>
                                    </div>
                                </td>

                                <td class="text-center">

                                    <!-- Preview -->
                                    <button class="btn btn-sm btn-outline-info mx-1 previewBtn"
                                        data-name="{{ $state->name }}"
                                        data-status="{{ $state->status }}"
                                        data-created="{{ $state->created_at }}"
                                        data-updated="{{ $state->updated_at }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- Edit -->
                                    <a href="{{ route('states.edit', $state->id) }}"
                                        class="btn btn-sm btn-outline-primary mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('states.destroy', $state->id) }}"
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
                        @if ($states->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">«</span></li>
                        @else
                        <li class="page-item"><a class="page-link" href="{{ $states->previousPageUrl() }}">«</a></li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($states->getUrlRange(1, $states->lastPage()) as $page => $url)
                        <li class="page-item {{ $states->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($states->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $states->nextPageUrl() }}">»</a></li>
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
            $("#pvStatus").text($(this).data("status") == 1 ? "Active" : "Inactive");
            $("#pvCreated").text($(this).data("created"));
            $("#pvUpdated").text($(this).data("updated"));

            $("#previewModal").modal("show");
        });

    });
</script>
@endsection
