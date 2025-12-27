@extends('front.layout.app')

@section('title','All Exams & Tests')

@section('content')

<div class="container my-5">

    <!-- Page Heading -->
    <div class="text-center mb-4">
        <h2 class="fw-bold">Available Exams & Tests</h2>
        <p class="text-muted">Choose an exam and start your test</p>
    </div>

    <div class="row">

        @forelse($tests as $test)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 exam-card">

                    <div class="card-body d-flex flex-column">

                        <!-- Exam Badge -->
                        <span class="badge bg-primary mb-2 align-self-start">
                            {{ $test->exam->title ?? 'General Exam' }}
                        </span>

                        <!-- Test Title -->
                        <h5 class="card-title fw-bold">
                            {{ $test->title }}
                        </h5>

                        <!-- Details -->
                        <p class="text-muted mb-1">
                            🕒 Duration: <b>{{ $test->duration }} min</b>
                        </p>

                        <p class="text-muted mb-1">
                            🎯 Total Marks: <b>{{ $test->total_marks }}</b>
                        </p>

                        <p class="text-muted mb-3">
                            🏷 Job Brand: <b>{{ $test->exam->jobbrand ?? '-' }}</b>
                        </p>

                        <!-- Action -->
                        <a href="{{ route('student.tests.start', $test->id) }}"
                           class="btn btn-outline-primary mt-auto w-100">
                            Start Test
                        </a>

                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No tests available</p>
        @endforelse

    </div>

   

</div>

@endsection
