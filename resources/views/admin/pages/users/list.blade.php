@extends('admin.layout.app')

@section('title', 'usersData')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>usersData</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('users.create') }}" class="btn btn-outline-primary">New user</a>
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
                            <h5 class="modal-title">user Preview</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th>Name</th>
                                    <td id="pvName"></td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td id="pvSlug"></td>
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

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success') }}
            </div>
            @endif

            <!-- Filter Form -->
            <div class="card mb-2">
                <div class="card-body">
                    <form action="{{ route('users.index') }}" method="GET" class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control" placeholder="user Name" value="{{ request('name') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="status" class="form-control">
                                <option value="">-- Select Status --</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-outline-primary">Filter</button>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- usersData Table -->
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
    
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($usersData as $user)
                            <tr>
                                <td>{{ ($usersData->currentPage() - 1) * $usersData->perPage() + $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                 
                                <td>{{ $user->role }}</td>
                               
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td class="text-center">
                                    <!-- View -->
                                    <button class="btn btn-sm btn-outline-info mx-1 previewBtn"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-email_verified="{{ $user->email_verified_at ?? '-' }}"
                                        data-role="{{ $user->role }}"                            
                                        data-created="{{ $user->created_at }}"
                                        data-updated="{{ $user->updated_at }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- Edit -->
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('users.destroy', $user->id) }}"
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
                        @if ($usersData->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">«</span></li>
                        @else
                        <li class="page-item"><a class="page-link" href="{{ $usersData->previousPageUrl() }}">«</a></li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($usersData->getUrlRange(1, $usersData->lastPage()) as $page => $url)
                        <li class="page-item {{ $usersData->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($usersData->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $usersData->nextPageUrl() }}">»</a></li>
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
            $("#pvSlug").text($(this).data("slug"));
            $("#pvStatus").text($(this).data("status") == 1 ? "Active" : "Inactive");
            $("#pvCreated").text($(this).data("created"));
            $("#pvUpdated").text($(this).data("updated"));

            $("#previewModal").modal("show");
        });

    });
</script>
@endsection