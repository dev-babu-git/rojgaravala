@extends('admin.layout.app')

@section('title', 'Edit Question')

@section('content')

<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Question</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('questions.index') }}" class="btn btn-outline-primary">Back</a>
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
                    <form action="{{ route('questions.update', $question->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- TEST -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Test *</label>
                                    <select name="test_id" class="form-control" required>
                                        @foreach($tests as $test)
                                            <option value="{{ $test->id }}"
                                                {{ old('test_id', $question->test_id) == $test->id ? 'selected' : '' }}>
                                                {{ $test->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- MARKS -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Marks *</label>
                                    <input type="number"
                                           name="marks"
                                           class="form-control"
                                           value="{{ old('marks', $question->marks) }}"
                                           min="1" required>
                                </div>
                            </div>

                        </div>

                        <!-- QUESTION -->
                        <div class="mb-3">
                            <label>Question *</label>
                            <textarea name="question_text"
                                      class="form-control"
                                      rows="3"
                                      required>{{ old('question_text', $question->question_text) }}</textarea>
                        </div>

                        <!-- STATUS -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ old('status', $question->status)== 1 ?'selected':'' }}>Active</option>
                                        <option value="0" {{ old('status', $question->status)== 0 ?'selected':'' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- BUTTONS -->
                        <div class="pt-4">
                            <button class="btn btn-primary">Update Question</button>
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>

                    </form>
                    <!-- FORM END -->

                </div>
            </div>

        </div>
    </section>

</div>

@endsection
