@extends('student.layout.testapp')

@section('content')
<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $test->title }}</h5>
        <div class="timer" id="timer">00:00</div>
    </div>

    <div class="card-body">

        <form id="testForm" method="POST" action="{{ route('student.tests.answer.save') }}">
            @csrf

            <input type="hidden" name="test_id" value="{{ $test->id }}">
            <input type="hidden" name="question_id" value="{{ $question->id }}">
            <input type="hidden" name="qno" value="{{ $qno }}">

            <h6 class="mb-3">
                Q{{ $qno }}. {{ $question->question_text }}
            </h6>

            @foreach($question->options as $option)
                <div class="form-check my-2">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="option_id"
                        value="{{ $option->id }}"
                        id="option{{ $option->id }}"
                        {{ $selectedOption == $option->id ? 'checked' : '' }} >
                    <label class="form-check-label" for="option{{ $option->id }}">
                        {{ $option->option_text }}
                    </label>
                </div>
            @endforeach

            <!-- BUTTONS -->
            <div class="d-flex justify-content-between mt-4">

                @if($qno > 1)
                    <button type="submit" name="action" value="prev" class="btn btn-secondary">
                        ← Previous
                    </button>
                @else
                    <div></div>
                @endif

                @if($qno == $totalQuestions)
                    <button type="submit" name="action" value="submit" class="btn btn-danger">
                        Submit Test
                    </button>
                @else
                    <button type="submit" name="action" value="next" class="btn btn-primary">
                        Next →
                    </button>
                @endif

            </div>

        </form>

    </div>
</div>

{{-- TIMER --}}
<script>
let duration = 10 * 60;
const timerEl = document.getElementById('timer');

let remaining = localStorage.getItem('test_timer');
if (remaining) duration = parseInt(remaining);

const countdown = setInterval(() => {
    let m = Math.floor(duration / 60);
    let s = duration % 60;
    timerEl.textContent = `${m}:${s < 10 ? '0' : ''}${s}`;
    localStorage.setItem('test_timer', duration);

    if (--duration < 0) {
        clearInterval(countdown);
        localStorage.removeItem('test_timer');
        document.getElementById('testForm').submit();
    }
}, 1000);
</script>
@endsection
