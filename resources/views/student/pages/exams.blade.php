@extends('student.layout.app')

@section('title','My Tests')

@section('content')
<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">

            <h4 class="mb-3">Available Exams</h4>

            <div class="row g-3">
                @foreach($exams as $exam)
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="fw-bold">{{ $exam->title }}</h6>
                            <p class="text-muted small">{{ $exam->description ?? '' }}</p>

                            <a href="{{ route('student.exams.tests', $exam->id) }}" class="btn btn-outline-info btn-sm">
                                View Details
                            </a>    
                        </div>
                    </div>
                </div>
                
                @endforeach
            </div>

        </div>
    </section>
</div>
@endsection