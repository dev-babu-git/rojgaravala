@extends('admin.layout.app')

@section('title','Add Question')

@section('content')
<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid my-2">
        <h1>Add Question</h1>
    </div>
</section>

<section class="content">
<div class="container-fluid">

<div class="card">
<div class="card-body">

<form action="{{ route('questions.store') }}" method="POST">
@csrf

<!-- Select Test -->
<div class="mb-3">
    <label>Test *</label>
    <select name="test_id" class="form-control" required>
        <option value="">-- Select Test --</option>
        @foreach($tests as $test)
            <option value="{{ $test->id }}">{{ $test->title }}</option>
        @endforeach
    </select>
</div>

<!-- Question -->
<div class="mb-3">
    <label>Question *</label>
    <textarea name="question_text" class="form-control" rows="3" required></textarea>
</div>

<!-- Marks -->
<div class="mb-3">
    <label>Marks *</label>
    <input type="number" name="marks" class="form-control" value="1" min="1">
</div>

<!-- Status -->
<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>
</div>

<button class="btn btn-primary">Save Question</button>
<a href="{{ route('questions.index') }}" class="btn btn-secondary">Cancel</a>

</form>

</div>
</div>

</div>
</section>
</div>
@endsection
