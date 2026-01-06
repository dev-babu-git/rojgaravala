@extends('admin.layout.app')

@section('title', 'Tests')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tests</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('tests.create') }}" class="btn btn-outline-primary">New Test</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter -->
            <div class="card mb-2">
                <div class="card-body">
                    <form method="GET" action="{{ route('tests.index') }}" class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="title" class="form-control"
                                   placeholder="Search Test Title"
                                   value="{{ request('title') }}">
                        </div>

                        <div class="col-md-4">
                            <select name="status" class="form-control">
                                <option value="">-- All Status --</option>
                                <option value="1" {{ request('status')== 1 ?'selected':'' }}>Active</option>
                                <option value="0" {{ request('status')== 0 ?'selected':'' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <button class="btn btn-outline-primary">Filter</button>
                            <a href="{{ route('tests.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-body table-responsive p-0">

                    {{-- Showing X to Y of Z --}}
                    @if($testData->total() > 0)
                    <div class="mb-2 px-3">
                        Showing {{ $testData->firstItem() }} to {{ $testData->lastItem() }} of {{ $testData->total() }} entries
                    </div>
                    @endif

                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Exam</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Duration</th>
                                <th>Total Marks</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($testData as $test)
                            <tr>
                                <td>{{ ($testData->currentPage()-1)*$testData->perPage() + $loop->iteration }}</td>
                                <td>{{ $test->exam->title ?? '-' }}</td>
                                <td>{{ $test->title ?? '-' }}</td>
                                <td>{{ $test->slug ?? '-' }}</td>
                                <td>{{ $test->duration ?? '-' }} min</td>
                                <td>{{ $test->total_marks ?? '-' }}</td>
                                
                                <td>
                                @php $type = 'Test'; @endphp
                                <div class="custom-control custom-switch">
                                    <input type="checkbox"
                                        class="custom-control-input"
                                        id="switch{{ $test->id }}"
                                        {{ $test->status == 'active' ? 'checked' : '' }}
                                        onchange="changeStatus('{{ $test->id }}', '{{ $type }}')">
                                    <label class="custom-control-label" for="switch{{ $test->id }}"></label>
                                </div>
                            </td>
                                <td>
                                    <!-- Preview -->
                                    <button class="btn btn-sm btn-outline-info previewBtn"
                                        data-title="{{ $test->title ?? '-' }}"
                                        data-slug="{{ $test->slug ?? '-' }}"
                                        data-duration="{{ $test->duration ?? '-' }}"
                                        data-marks="{{ $test->total_marks ?? '-' }}"
                                        data-status="{{ $test->status ?? '-' }}"
                                        data-created="{{ $test->created_at ?? '-' }}"
                                        data-updated="{{ $test->updated_at ?? '-' }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- Edit -->
                                    <a href="{{ route('tests.edit',$test->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('tests.destroy',$test->id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No Tests Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-footer clearfix">
                    {{ $testData->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </section>
</div>

{{-- Preview Modal --}}
<div class="modal fade" id="previewModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Test Preview</h5>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr><th>Title</th><td id="pvTitle"></td></tr>
                    <tr><th>Slug</th><td id="pvSlug"></td></tr>
                    <tr><th>Duration</th><td id="pvDuration"></td></tr>
                    <tr><th>Total Marks</th><td id="pvMarks"></td></tr>
                    <tr><th>Status</th><td id="pvStatus"></td></tr>
                    <tr><th>Created At</th><td id="pvCreated"></td></tr>
                    <tr><th>Updated At</th><td id="pvUpdated"></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).on('click','.previewBtn',function(){
    $('#pvTitle').text($(this).data('title'));
    $('#pvSlug').text($(this).data('slug'));
    $('#pvDuration').text($(this).data('duration')+' min');
    $('#pvMarks').text($(this).data('marks'));
    $('#pvStatus').text($(this).data('status'));
    $('#pvCreated').text($(this).data('created'));
    $('#pvUpdated').text($(this).data('updated'));
    $('#previewModal').modal('show');
});
</script>
@endsection
