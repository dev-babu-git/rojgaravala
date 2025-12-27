@extends('admin.layout.app')

@section('title', 'Options')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Options</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('options.create') }}" class="btn btn-outline-primary">New Option</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
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
                    <form method="GET" action="{{ route('options.index') }}" class="row g-2 mb-2">
                        <div class="col-md-4">
                            <select name="question_id" class="form-control">
                                <option value="">-- All Questions --</option>
                                @foreach($questions as $q)
                                    <option value="{{ $q->id }}" {{ request('question_id')==$q->id?'selected':'' }}>
                                        {{ $q->question_text ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Search Option Text" value="{{ request('search') }}">
                        </div>

                        <div class="col-md-4">
                            <button class="btn btn-outline-primary">Filter</button>
                            <a href="{{ route('options.index') }}" class="btn btn-outline-secondary">Reset</a>
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
                                <th>Question</th>
                                <th>Option Text</th>
                                <th>Correct</th>
                               
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($options as $option)
                            <tr>
                                <td>{{ ($options->currentPage()-1)*$options->perPage() + $loop->iteration }}</td>
                                <td>{{ $option->question->question_text ?? '-' }}</td>
                                 
                                <td>{{ $option->option_text ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $option->is_correct ? 'success' : 'danger' }}">
                                        {{ $option->is_correct ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                              
                                <td>
                                    <!-- Preview -->
                                    <button class="btn btn-sm btn-outline-info previewBtn"
                                        data-question="{{ $option->question->question_text ?? '-' }}"
                                        data-option="{{ $option->option_text ?? '-' }}"
                                        data-correct="{{ $option->is_correct ? 'Yes' : 'No' }}"
                                        data-status="{{ $option->status ?? '-' }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- Edit -->
                                    <a href="{{ route('options.edit',$option->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('options.destroy',$option->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                                <td colspan="6">No Options Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-footer clearfix">
                    {{ $options->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </section>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Option Preview</h5>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr><th>Question</th><td id="pvQuestion"></td></tr>
                    <tr><th>Option</th><td id="pvOption"></td></tr>
                    <tr><th>Correct</th><td id="pvCorrect"></td></tr>
                    <tr><th>Status</th><td id="pvStatus"></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).on('click','.previewBtn',function(){
    $('#pvQuestion').text($(this).data('question'));
    $('#pvOption').text($(this).data('option'));
    $('#pvCorrect').text($(this).data('correct'));
    $('#pvStatus').text($(this).data('status'));
    $('#previewModal').modal('show');
});
</script>
@endsection
