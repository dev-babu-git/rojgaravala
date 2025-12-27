@extends('admin.layout.app')

@section('title', 'Edit Test')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Test</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('tests.index') }}" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <!-- FORM START -->
                    <form action="{{ route('tests.update', $test->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- EXAM TYPE -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Exam Type *</label>
                                    <select name="exam_id" class="form-control @error('exam_id') is-invalid @enderror" required>
                                        <option value="">-- Select Exam --</option>
                                        @foreach($examData as $exam)
                                            <option value="{{ $exam->id }}"
                                                {{ old('exam_id', $test->exam_id) == $exam->id ? 'selected' : '' }}>
                                                {{ $exam->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('exam_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- TITLE -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Test Title *</label>
                                    <input type="text"
                                        name="title"
                                        id="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $test->title) }}"
                                        placeholder="Test Title"
                                        required>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- SLUG -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Slug *</label>
                                    <input type="text"
                                        name="slug"
                                        id="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug', $test->slug) }}"
                                        placeholder="Slug"
                                        required>
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- DURATION -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Duration (Minutes) *</label>
                                    <input type="number"
                                        name="duration"
                                        class="form-control @error('duration') is-invalid @enderror"
                                        value="{{ old('duration', $test->duration) }}"
                                        min="1"
                                        placeholder="Duration"
                                        required>
                                    @error('duration')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- TOTAL MARKS -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Total Marks *</label>
                                    <input type="number"
                                        name="total_marks"
                                        class="form-control @error('total_marks') is-invalid @enderror"
                                        value="{{ old('total_marks', $test->total_marks) }}"
                                        min="1"
                                        placeholder="Total Marks"
                                        required>
                                    @error('total_marks')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- STATUS -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Status *</label>
                                    <select name="status" class="form-control">
                                        <option value="active"
                                            {{ old('status', $test->status) == 'active' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $test->status) == 'inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <!-- BUTTONS -->
                        <div class="pt-4">
                            <button class="btn btn-primary">Update</button>
                            <a href="{{ route('tests.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>

                    </form>
                    <!-- FORM END -->

                </div>
            </div>

        </div>
    </section>

</div>

@endsection

@section('scripts')
<script>
    // Auto-generate slug ONLY if slug is empty
    document.getElementById('title').addEventListener('keyup', function () {
        let slugInput = document.getElementById('slug');
        if (slugInput.value.trim() === '') {
            slugInput.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
        }
    });
</script>
@endsection
