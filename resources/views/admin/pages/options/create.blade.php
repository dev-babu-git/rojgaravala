@extends('admin.layout.app')

@section('title', 'Create Options')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Create Options</h1></div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('options.index') }}" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('options.store') }}" method="POST">
                        @csrf

                        <!-- Question Dropdown -->
                        <div class="mb-2">
                            <select name="question_id" class="form-control @error('question_id') is-invalid @enderror" required>
                                <option value="">-- Select Question --</option>
                                @foreach($questions as $q)
                                    <option value="{{ $q->id }}"
                                        {{ old('question_id') == $q->id ? 'selected' : '' }}>
                                        {{ $q->question_text }}
                                    </option>
                                @endforeach
                            </select>
                            @error('question_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Options Wrapper -->
                        <div id="optionsWrapper">
                            @php
                                $oldOptions = old('option_text', ['']);
                                $oldCorrect = old('is_correct', []);
                            @endphp
                            @foreach($oldOptions as $i => $val)
                            <div class="optionRow mb-2 d-flex align-items-center">
                                <input type="text" name="option_text[]" 
                                       class="form-control mb-1 mr-2 @error('option_text.'.$i) is-invalid @enderror" 
                                       placeholder="Option text" value="{{ $val }}" required>

                                <label class="mr-2">
                                    <input type="checkbox" name="is_correct[]" value="1"
                                        {{ isset($oldCorrect[$i]) ? 'checked' : '' }}> Correct Answer
                                </label>

                                <button type="button" class="btn btn-sm btn-outline-danger removeOption">Remove</button>

                                @error('option_text.'.$i)
                                    <span class="text-danger ml-2">{{ $message }}</span>
                                @enderror
                            </div>
                            @endforeach
                        </div>

                        <!-- Add Option Button -->
                        <button type="button" id="addOption" class="btn btn-sm btn-outline-secondary mb-2">Add Option</button>

                        <!-- Status -->
                        <select name="status" class="form-control mb-2 @error('status') is-invalid @enderror">
                            <option value="active" {{ old('status')=='active'?'selected':'' }}>Active</option>
                            <option value="inactive" {{ old('status')=='inactive'?'selected':'' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <button class="btn btn-primary">Save</button>
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

    // Add Option
    addBtn.addEventListener('click', function() {
        const currentOptions = optionsWrapper.querySelectorAll('.optionRow').length;
        if (currentOptions < maxOptions) {
            const newOption = document.createElement('div');
            newOption.classList.add('optionRow', 'mb-2', 'd-flex', 'align-items-center');
            newOption.innerHTML = `
                <input type="text" name="option_text[]" class="form-control mb-1 mr-2" placeholder="Option text" required>
                <label class="mr-2">
                    <input type="checkbox" name="is_correct[]"> Correct Answer
                </label>
                <button type="button" class="btn btn-sm btn-outline-danger removeOption">Remove</button>
            `;
            optionsWrapper.appendChild(newOption);
        } else {
            alert('Maximum 4 options allowed!');
        }
    });

    // Remove Option
    optionsWrapper.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('removeOption')) {
            e.target.parentElement.remove();
        }
    });
});
</script>
@endsection
