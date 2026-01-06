@extends('admin.layout.app')

@section('title', 'Exams')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exams</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('exams.create') }}" class="btn btn-outline-primary">New Exam</a>
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
                            <h5 class="modal-title">Exam Preview</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Title</th>
                                    <td id="pvTitle"></td>
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

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Exams Table -->
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th width="100">Status</th>
                                <th width="140">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($exams as $exam)
                            <tr>
                                <td>{{ ($exams->currentPage() - 1) * $exams->perPage() + $loop->iteration }}</td>
                                <td>{{ $exam->title }}</td>
                                <td>{{ $exam->slug }}</td>

                                <td>
                                    @php $type = 'Exam'; @endphp
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            id="switch{{ $exam->id }}"
                                            {{ $exam->status == 1 ? 'checked' : '' }}
                                            onchange="changeStatus('{{ $exam->id }}', '{{ $type }}')">
                                        <label class="custom-control-label" for="switch{{ $exam->id }}"></label>
                                    </div>
                                </td>

                                <td class="text-center">

                                    <!-- View -->
                                    <button class="btn btn-sm btn-outline-info mx-1 previewBtn"
                                        data-title="{{ $exam->title }}"
                                        data-slug="{{ $exam->slug }}"
                                        data-status="{{ $exam->status }}"
                                        data-created="{{ $exam->created_at }}"
                                        data-updated="{{ $exam->updated_at }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- Edit -->
                                    <a href="{{ route('exams.edit', $exam->id) }}"
                                       class="btn btn-sm btn-outline-primary mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('exams.destroy', $exam->id) }}"
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
                    {{ $exams->links() }}
                </div>

            </div>

        </div>
    </section>

</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {

        $('.previewBtn').click(function () {

            $('#pvTitle').text($(this).data('title'));
            $('#pvSlug').text($(this).data('slug'));
            $('#pvStatus').text($(this).data('status'));
            $('#pvCreated').text($(this).data('created'));
            $('#pvUpdated').text($(this).data('updated'));

            $('#previewModal').modal('show');
        });

    });
</script>
@endsection
