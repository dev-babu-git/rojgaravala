@extends('usersPage.layout.testapp')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $test->name ?? 'Test' }}</h5>
        <div class="timer" id="timer">00:00</div>
    </div>

    <div class="card-body">
        <form id="testForm" action="{{ route('student.answer.save') }}" method="POST">
            @csrf

            <input type="hidden" name="test_id" value="{{ $test->id }}">
            <input type="hidden" name="question_id" value="{{ $question->id }}">
            <input type="hidden" name="next_qno" value="{{ $qno + 1 }}">

            <h6>Q{{ $qno }}. {{ $question->question_text }}</h6>

            @foreach($question->options as $option)
                <div class="form-check my-2">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="option_id"
                        value="{{ $option->id }}"
                        id="option{{ $option->id }}"
                        required
                    >
                    <label class="form-check-label" for="option{{ $option->id }}">
                        {{ $option->option_text }}
                    </label>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary mt-3">
                {{ $test->questions->count() == $qno ? 'Submit Test' : 'Next' }}
            </button>
        </form>
    </div>
</div>

<script>
let duration = 10 * 60;
const timerEl = document.getElementById('timer');

let remaining = localStorage.getItem('test_timer');
if (remaining) duration = parseInt(remaining);

const countdown = setInterval(() => {
    let m = Math.floor(duration / 60);
    let s = duration % 60;
    timerEl.textContent = `${m}:${s}`;
    localStorage.setItem('test_timer', duration);

    if (--duration < 0) {
        clearInterval(countdown);
        localStorage.removeItem('test_timer');
        document.getElementById('testForm').submit();
    }
}, 1000);
</script>
@endsection
