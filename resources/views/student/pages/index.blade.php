@extends('student.layout.app')

@section('title', 'Dashboard')

@section('content')
<section class="content pt-3">
    <div class="container-fluid">

        {{-- STATS --}}
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-info text-white text-center">
                    <div class="card-body">
                        <h6>Total Tests</h6>
                        <h3>{{ $totalTests }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-success text-white text-center">
                    <div class="card-body">
                        <h6>Completed</h6>
                        <h3>{{ $completedTests }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-warning text-white text-center">
                    <div class="card-body">
                        <h6>Pending</h6>
                        <h3>{{ $pendingTests }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-danger text-white text-center">
                    <div class="card-body">
                        <h6>Score Avg</h6>
                        <h3>{{ $averageScore }}%</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- MY TESTS --}}
        <h5 class="mt-4 mb-3 fw-bold">My Tests</h5>

       <div class="row g-4">

        @forelse($myTests as $testId => $attempts)

        @php
        // $attempts is NOW a collection
        $latestAttempt = $attempts->first();
        $test = $latestAttempt->test;
        @endphp

        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-body">

                    {{-- EXAM NAME --}}
                    <span class="badge bg-info mb-2">
                        {{ $test->exam->title ?? 'Exam' }}
                    </span>

                    {{-- TEST NAME --}}
                    <h6 class="fw-bold text-dark">
                        {{ $test->title }}
                    </h6>

                    {{-- DATE --}}
                    <small class="text-muted">
                        Last Attempt: {{ $latestAttempt->created_at->format('d M Y') }}
                    </small>

                    {{-- STATS --}}
                    <div class="row text-center my-3">
                        <div class="col-4">
                            <div class="p-2 bg-light rounded">
                                <b>{{ $test->questions->count() }}</b><br>
                                <small>Questions</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 bg-light rounded">
                                <b>{{ $test->total_marks }}</b><br>
                                <small>Marks</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 bg-light rounded">
                                <b>{{ $test->duration }}</b><br>
                                <small>Minutes</small>
                            </div>
                        </div>
                    </div>

                    {{-- 🔥 ACTION BUTTONS --}}
                    <div class="d-grid gap-2">

                        {{-- FIRST TIME (NO ATTEMPT SUBMITTED) --}}
                        @if($attempts->count() == 1 && is_null($latestAttempt->submitted_at))

                        <a href="{{ route('student.tests.start', $test->id) }}"
                            class="btn btn-success rounded-pill">
                            Start Test
                        </a>

                        {{-- AFTER TEST SUBMITTED --}}
                        @else

                        <a href="{{ route('student.tests.start', $test->id) }}"
                            class="btn btn-warning rounded-pill">
                            Re-attempt Test
                        </a>

                        <a href="{{ route('student.tests.result', $latestAttempt->id) }}"
                            class="btn btn-outline-info rounded-pill">
                            View Result
                        </a>

                        @endif

                    </div>

                </div>
            </div>
        </div>

        @empty
        <p class="text-center text-muted">No tests found</p>
        @endforelse


    </div>

    </div>
</section>
@endsection