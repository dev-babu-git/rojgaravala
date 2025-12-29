@extends('admin.layout.app')

@section('title', 'Questions')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Questions</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('questions.create') }}" class="btn btn-outline-primary">
                        New Question
                    </a>
                    <button class="btn btn-success" id="importcsvdata">
                        Import CSV / Excel
                    </button>
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
                    <form method="GET" action="{{ route('questions.index') }}" class="row g-2">

                        <div class="col-md-4">
                            <input type="text"
                                   name="question"
                                   class="form-control"
                                   placeholder="Search Question"
                                   value="{{ request('question') }}">
                        </div>

                        <div class="col-md-4">
                            <select name="status" class="form-control">
                                <option value="">-- All Status --</option>
                                <option value="active" {{ request('status')=='active'?'selected':'' }}>Active</option>
                                <option value="inactive" {{ request('status')=='inactive'?'selected':'' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <button class="btn btn-outline-primary">Filter</button>
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">
                                Reset
                            </a>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Test</th>
                                <th>Question</th>
                                <th>Marks</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($questions as $question)
                            <tr>
                                <td>{{ ($questions->currentPage()-1)*$questions->perPage() + $loop->iteration }}</td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ $question->test->title ?? '-' }}
                                    </span>
                                </td>

                                <td>{{ Str::limit($question->question_text, 50) }}</td>

                                <td>{{ $question->marks }}</td>

                                <td>
                                    <span class="badge bg-{{ $question->status=='active'?'success':'danger' }}">
                                        {{ ucfirst($question->status) }}
                                    </span>
                                </td>

                                <td>
                                    <!-- Preview -->
                                    <button class="btn btn-sm btn-outline-info previewBtn"
                                        data-question="{{ $question->question_text }}"
                                        data-test="{{ $question->test->title ?? '-' }}"
                                        data-marks="{{ $question->marks }}"
                                        data-status="{{ $question->status }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- Edit -->
                                    <a href="{{ route('questions.edit', $question->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Options -->
                                    <a href="{{ route('options.index',['question_id'=>$question->id]) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="fa fa-list"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('questions.destroy', $question->id) }}"
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
                                <td colspan="6">No Questions Found</td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-footer clearfix">
                    {{ $questions->links() }}
                </div>
            </div>

        </div>
    </section>
</div>
 <!-- Import CSV / Excel Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content shadow">

            <form action="{{ route('questions.import') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <!-- Header -->
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title d-flex align-items-center gap-2">
                        <i class="fa fa-file-import"></i>
                        Import Questions
                    </h5>
                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">

                    <!-- Info Box -->
                    <div class="alert alert-light border small mb-3">
                        <ul class="mb-0 ps-3">
                            <li>Allowed formats: <strong>CSV, XLSX</strong></li>
                            <li>Follow the provided sample file format</li>
                        </ul>
                    </div>

                    <!-- File Input -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Upload File
                        </label>
                        <input type="file"
                               name="file"
                               class="form-control"
                               accept=".csv,.xlsx"
                               required>
                    </div>

                    <!-- Sample Download -->
                    <div class="text-end">
                        <a href="{{ asset('sample/questions_options_sample.xlsx') }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-download"></i>
                            Download Sample
                        </a>
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer bg-light">
                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button class="btn btn-success px-4">
                        <i class="fa fa-upload"></i>
                        Upload
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- Preview Modal -->
<div class="modal fade" id="previewModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Question Preview</h5>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr><th>Test</th><td id="pvTest"></td></tr>
                    <tr><th>Question</th><td id="pvQuestion"></td></tr>
                    <tr><th>Marks</th><td id="pvMarks"></td></tr>
                    <tr><th>Status</th><td id="pvStatus"></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).on('click','#importcsvdata',function(){
         $('#importModal').modal('show');
        
    });

$(document).on('click','.previewBtn',function(){
    $('#pvTest').text($(this).data('test'));
    $('#pvQuestion').text($(this).data('question'));
    $('#pvMarks').text($(this).data('marks'));
    $('#pvStatus').text($(this).data('status'));
    $('#previewModal').modal('show');
});
</script>
@endsection
