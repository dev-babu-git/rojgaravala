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

<div class="row g-3">

@forelse($myTests as $attempt)

@php
    $test = $attempt->test;
@endphp

<div class="col-md-4">
    <div class="card shadow-sm border-0 h-100">

        <div class="card-body">

            {{-- EXAM --}}
            <span class="badge bg-light text-dark mb-2">
                {{ $test->exam->title ?? 'Exam' }}
            </span>

            {{-- TEST --}}
            <h6 class="fw-bold text-primary mt-2">
                {{ $test->title }}
            </h6>

            {{-- DATE --}}
            <p class="small text-muted mb-2">
                <i class="fa fa-calendar"></i>
                {{ $attempt->created_at->format('d M Y') }}<br>
                <i class="fa fa-clock"></i>
                {{ $attempt->created_at->format('h:i A') }}
            </p>

            {{-- STATUS --}}
            <span class="badge {{ $attempt->status == 'completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                {{ ucfirst($attempt->status) }}
            </span>

        </div>

        {{-- ACTION --}}
        <div class="card-footer bg-white border-0">
            @if($attempt->status === 'completed')
                <a href="{{ route('student.tests.result', $attempt->id) }}"
                   class="btn btn-outline-primary btn-sm w-100">
                    View Result
                </a>
            @else
                <a href="{{ route('student.tests.start', $test->id) }}"
                   class="btn btn-primary btn-sm w-100">
                    Resume Test
                </a>
            @endif
        </div>

    </div>
</div>

@empty
<div class="col-12">
    <div class="alert alert-info text-center">
        No tests attempted yet.
    </div>
</div>
@endforelse

</div>

</div>
</section>
@endsection
