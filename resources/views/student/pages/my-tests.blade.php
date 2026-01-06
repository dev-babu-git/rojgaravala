@extends('student.layout.app')

@section('title','My Tests')

@section('content')
 
<section class="content pt-3">
  

    <div class="row g-4">

        @forelse($myTests as $row)
        @php
            $test = $row->test;
        @endphp

        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 rounded-4">

                <div class="card-body">

                    {{-- EXAM NAME --}}
                    <span class="badge bg-primary mb-2">
                        {{ $test->exam->title ?? 'Exam' }}
                    </span>

                    {{-- TEST NAME --}}
                    <h6 class="fw-bold text-dark">
                        {{ $test->title }}
                    </h6>

                    {{-- DATE --}}
                    <small class="text-muted">
                        {{ $row->created_at->format('d M Y') }}
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

                    {{-- ACTION --}}
                    <a href="{{ route('student.tests.start', $test->id) }}"
                       class="btn btn-success w-100 rounded-pill">
                        Start Test
                    </a>

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
