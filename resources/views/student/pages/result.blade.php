@extends('student.layout.app')

@section('title','Test Result')

@section('content')

<section class="content pt-4">
<div class="container-fluid">

<div class="card shadow-sm">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">{{ $test->title }} – Result</h4>

        {{-- 🔽 ATTEMPT DROPDOWN --}}
        @if($allAttempts->count() > 1)
            <div class="dropdown">
                <button class="btn btn-light btn-sm dropdown-toggle"
                        data-toggle="dropdown">
                    Attempt {{ $allAttempts->search(fn($a) => $a->id === $attempt->id) + 1 }}
                </button>

                <div class="dropdown-menu dropdown-menu-right">
                    @foreach($allAttempts as $index => $att)
                        <a class="dropdown-item {{ $att->id == $attempt->id ? 'active' : '' }}"
                           href="{{ route('student.tests.result', $att->id) }}">
                            Attempt {{ $index + 1 }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <div class="card-body text-center">

        {{-- SUMMARY --}}
        <div class="row justify-content-center mb-4">
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h6>Total Questions</h6>
                        <h3>{{ $total }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6>Correct</h6>
                        <h3>{{ $correct }}</h3>
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
            Score: <strong>{{ $percentage }}%</strong>
        </h5>

        <h4 class="mt-2">
            Result:
            <span class="badge {{ $resultStatus == 'Pass' ? 'bg-success' : 'bg-danger' }}">
                {{ $resultStatus }}
            </span>
        </h4>

        <hr>

        {{-- ❌ WRONG / REVIEW --}}
        <h4 class="text-start mt-4">Question Review</h4>

        @foreach($resultData as $i => $row)
            <div class="card mt-3
                {{ $row['status'] == 'correct' ? 'border-success' : ($row['status']=='wrong' ? 'border-danger' : 'border-secondary') }}">
                <div class="card-body text-start">
                    <p class="fw-bold">
                        Q{{ $i+1 }}. {{ $row['question'] }}
                    </p>

                    <p class="mb-1">
                        Your Answer:
                        <strong>{{ $row['your_answer'] }}</strong>
                    </p>

                    <p class="mb-0 text-success">
                        Correct Answer:
                        <strong>{{ $row['correct_answer'] }}</strong>
                    </p>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('student.dashboard') }}" class="btn btn-primary">
                Dashboard
            </a>

            <a href="{{ route('student.my-tests') }}" class="btn btn-outline-secondary">
                My Tests
            </a>
        </div>

    </div>
</div>

</div>
</section>

@endsection
