@extends('student.layout.app')

@section('title','Test Result')

@section('content')
 
<section class="content pt-4">
<div class="container-fluid">

<div class="card shadow-sm text-center">

    <div class="card-header bg-info text-white">
        <h4 class="mb-0">Test Result</h4>
    </div>

    <div class="card-body">

        <div class="row justify-content-center mb-4">

            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h6>Total Questions</h6>
                        <h3>{{ $totalQuestions }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6>Correct</h6>
                        <h3>{{ $right }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h6>Wrong</h6>
                        <h3>{{ $wrong }}</h3>
                    </div>
                </div>
            </div>

        </div>

        <h5>
            Score: <span class="fw-bold">{{ $percentage }}%</span>
        </h5>

        <h4 class="mt-2">
            Result:
            <span class="badge {{ $status == 'Pass' ? 'bg-success' : 'bg-danger' }}">
                {{ $status }}
            </span>
        </h4>

        <hr>

        <!-- WRONG QUESTION REVIEW -->
        @if(count($wrongQuestions))
            <h4 class="text-start mt-4">❌ Wrong Questions Review</h4>

            @foreach($wrongQuestions as $index => $item)
                <div class="card mt-3 border-danger">
                    <div class="card-body text-start">
                        <p class="fw-bold">
                            Q{{ $index + 1 }}. {{ $item['question'] }}
                        </p>

                        <p class="text-danger mb-1">
                            ❌ Your Answer: {{ $item['your_answer'] }}
                        </p>

                        <p class="text-success mb-0">
                            ✅ Correct Answer: {{ $item['correct_answer'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('student.dashboard') }}" class="btn btn-outline-info">
                Go to Dashboard
            </a>
            <a href="{{ route('student.dashboard') }}" class="btn btn-outline-secondary">
                My Tests
            </a>
        </div>

    </div>
</div>

</div>
</section>
 
@endsection
