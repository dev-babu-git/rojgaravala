@extends('usersPage.layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Dashboard</h1>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid mt-4">

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card card-hover bg-primary text-white shadow-sm">
                <div class="card-body text-center">
                    <h6>Total Tests</h6>
                    <h3>{{ $totalTests ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-hover bg-success text-white shadow-sm">
                <div class="card-body text-center">
                    <h6>Completed Tests</h6>
                    <h3>{{ $completedTests ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-hover bg-warning text-dark shadow-sm">
                <div class="card-body text-center">
                    <h6>Pending Tests</h6>
                    <h3>{{ $pendingTests ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-hover bg-danger text-white shadow-sm">
                <div class="card-body text-center">
                    <h6>Score Avg</h6>
                    <h3>{{ $averageScore ?? 0 }}%</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Test List -->
    <div class="row g-3">
        @forelse($tests as $test)
            <div class="col-md-4">
                <div class="card card-hover test-card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $test->name }}</h5>
                        <p class="card-text mb-1"><strong>Duration:</strong> {{ $test->duration }} min</p>
                        <p class="card-text mb-2"><strong>Total Marks:</strong> {{ $test->total_marks }}</p>
                        <a href="{{ route('student.tests.start', $test->id) }}" class="btn btn-primary w-100">Start Test</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No tests available at the moment.
                </div>
            </div>
        @endforelse
    </div>

</div>


    </section>

</div>
@endsection
