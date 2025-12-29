@extends('admin.layout.app')

@section('title', 'Edit Option')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Option</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('options.index') }}" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('options.update', $option->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Question -->
                        <div class="mb-3">
                            <label class="form-label">Question</label>
                            <select name="question_id" class="form-control @error('question_id') is-invalid @enderror" required>
                                <option value="">-- Select Question --</option>
                                @foreach($questions as $q)
                                    <option value="{{ $q->id }}"
                                        {{ $option->question_id == $q->id ? 'selected' : '' }}>
                                        {{ $q->question_text }}
                                    </option>
                                @endforeach
                            </select>
                            @error('question_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Option Text -->
                        <div class="mb-3">
                            <label class="form-label">Option Text</label>
                            <input type="text"
                                   name="option_text"
                                   class="form-control @error('option_text') is-invalid @enderror"
                                   value="{{ old('option_text', $option->option_text) }}"
                                   required>
                            @error('option_text')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Correct Answer -->
                        <div class="mb-3">
                            <label>
                                <input type="checkbox" name="is_correct"
                                    {{ $option->is_correct ? 'checked' : '' }}>
                                Correct Answer
                            </label>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="active" {{ $option->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $option->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button class="btn btn-primary">Update Option</button>
                    </form>

                </div>
            </div>
        </div>
    </section>

</div>

@endsection
