@extends('front.layout.app')

@section('title', $exam->title)

@section('content')

<style>
    .test-card {
        border-radius: 14px;
        transition: all 0.3s ease;
    }

    .test-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container my-5">

    <!-- EXAM HEADER -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body text-center">
            <h4 class="fw-bold">{{ $exam->title }}</h4>
            <p class="text-muted">Validity: 0 Month</p>
        </div>
    </div>

    <!-- SEARCH -->
    <div class="d-flex mb-4 gap-2">
        <input type="text" class="form-control"
               placeholder="Type here and press enter to search...">
        <button class="btn btn-primary">
            <i class="fa fa-search"></i>
        </button>
    </div>

    <!-- TESTS GRID -->
    <div class="row g-4">

        @forelse($tests as $test)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm test-card">

                <div class="card-body">

                    {{-- TITLE + DATE --}}
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold text-primary">
                            {{ $test->title }}
                        </h6>
                        <small class="text-muted">
                            {{ $test->updated_at->format('d M Y') }}
                        </small>
                    </div>

                    {{-- TEST INFO --}}
                    <div class="row text-center mb-3">
                        <div class="col-4">
                            <div class="p-2 bg-light rounded">
                                <b>{{ $test->questions()->count() }}</b><br>
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

                    
                        <a href="{{ route('student.login.to.attempt', $test->id) }}"
                           class="btn btn-primary w-100 rounded-pill">
                            Login to Attempt
                        </a>
                    

                </div>

            </div>
        </div>
        @empty
            <p class="text-center text-muted">No tests available</p>
        @endforelse

    </div>

</div>
@endsection
