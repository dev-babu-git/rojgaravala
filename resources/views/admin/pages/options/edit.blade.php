@extends('admin.layout.app')

@section('title','Edit Question & Options')

@section('content')
<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Edit Question & Options</h1></div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('questions.index') }}" class="btn btn-outline-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<form action="{{ route('questions.update', $test->id) }}" method="POST">
@csrf
@method('PUT')

<!-- Question -->
<div class="mb-3">
    <label>Question *</label>
    <input type="text" name="question_text" class="form-control" value="{{ old('question_text',$test->title) }}" required>
</div>

<!-- Existing Options -->
<div id="optionsWrapper">
@foreach($test->options as $option)
<div class="optionRow mb-2 d-flex align-items-center">
    <input type="hidden" name="options[{{ $option->id }}][id]" value="{{ $option->id }}">
    <input type="text" name="options[{{ $option->id }}][option_text]" class="form-control mr-2" value="{{ $option->option_text }}" required>
    <label class="mr-2">
        <input type="checkbox" name="options[{{ $option->id }}][is_correct]" {{ $option->is_correct ? 'checked' : '' }}> Correct
    </label>
    <select name="options[{{ $option->id }}][status]" class="form-control mr-2">
        <option value="active" {{ $option->status=='active'?'selected':'' }}>Active</option>
        <option value="inactive" {{ $option->status=='inactive'?'selected':'' }}>Inactive</option>
    </select>
    <button type="button" class="btn btn-sm btn-outline-danger removeOption">Remove</button>
</div>
@endforeach
</div>

<!-- Add New Option -->
<button type="button" id="addOption" class="btn btn-sm btn-outline-secondary mb-2">Add Option</button>

<button class="btn btn-primary">Update</button>
</form>

</div>
</div>
</div>
</section>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const maxOptions = 4;
    const optionsWrapper = document.getElementById('optionsWrapper');
    const addBtn = document.getElementById('addOption');

    addBtn.addEventListener('click', function() {
        const currentOptions = optionsWrapper.querySelectorAll('.optionRow').length;
        if (currentOptions < maxOptions) {
            const newOption = document.createElement('div');
            newOption.classList.add('optionRow','mb-2','d-flex','align-items-center');
            newOption.innerHTML = `
                <input type="text" name="new_options[][option_text]" class="form-control mr-2" placeholder="Option text" required>
                <label class="mr-2">
                    <input type="checkbox" name="new_options[][is_correct]"> Correct
                </label>
                <select name="new_options[][status]" class="form-control mr-2">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <button type="button" class="btn btn-sm btn-outline-danger removeOption">Remove</button>
            `;
            optionsWrapper.appendChild(newOption);
        } else {
            alert('Maximum 4 options allowed!');
        }
    });

    // Remove option
    optionsWrapper.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('removeOption')) {
            e.target.parentElement.remove();
        }
    });
});
</script>
@endsection
