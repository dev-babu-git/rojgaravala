@extends('usersPage.layout.testapp')

@section('content')
<div class="container mt-5">

    <!-- Score Summary -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body text-center">
                    <h5>Total Questions</h5>
                    <h2>{{ $totalQuestions }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body text-center">
                    <h5>Right Answers</h5>
                    <h2>{{ $right }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body text-center">
                    <h5>Wrong Answers</h5>
                    <h2>{{ $wrong }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Score Progress -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="mb-2">Score: {{ $score }} / {{ $totalQuestions }}</h5>
            @php
                $percentage = $totalQuestions ? round(($score/$totalQuestions) * 100) : 0;
            @endphp
            <div class="progress" style="height: 25px;">
                <div class="progress-bar 
                    {{ $percentage >= 75 ? 'bg-success' : ($percentage >= 50 ? 'bg-warning' : 'bg-danger') }}"
                    role="progressbar" 
                    style="width: {{ $percentage }}%;" 
                    aria-valuenow="{{ $percentage }}" 
                    aria-valuemin="0" 
                    aria-valuemax="100">
                    {{ $percentage }}%
                </div>
            </div>
        </div>
    </div>

    <!-- Wrong Questions Review -->
    @if(count($wrongQuestions) > 0)
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Wrong Questions Review</h5>
        </div>
        <div class="card-body">
            @foreach($wrongQuestions as $index => $wq)
                <div class="mb-3 p-3 border rounded shadow-sm">
                    <p><strong>Q{{ $index+1 }}:</strong> {{ $wq['question'] }}</p>
                    <p class="mb-1"><strong>Your Answer:</strong> <span class="text-danger">{{ $wq['user_answer'] }}</span></p>
                    <p class="mb-0"><strong>Correct Answer:</strong> <span class="text-success">{{ $wq['correct_answer'] }}</span></p>
                </div>
            @endforeach
        </div>
    </div>
    @else
        <div class="alert alert-success text-center">
            🎉 Congratulations! All answers are correct.
        </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('student.tests.index') }}" class="btn btn-outline-primary btn-lg">Back to Tests</a>
    </div>

</div>
@endsection
