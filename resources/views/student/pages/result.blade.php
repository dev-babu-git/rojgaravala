@extends('student.layout.app')

@section('title','Test Result')

@section('content')
<section class="content pt-3">
<div class="container-fluid">

{{-- SUMMARY --}}
<div class="card shadow-sm mb-4">
    <div class="card-body text-center">

        <h4 class="fw-bold">{{ $test->title }}</h4>
        <p class="text-muted">{{ $test->exam->title ?? '' }}</p>

        <div class="row mt-4">

            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h6>Total</h6>
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

            <div class="col-md-3">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <h6>Unattempted</h6>
                        <h3>{{ $unattempted }}</h3>
                    </div>
                </div>
            </div>

        </div>

        <hr>

        <h5>Score : <b>{{ $percentage }}%</b></h5>
        <span class="badge {{ $resultStatus == 'Pass' ? 'bg-success' : 'bg-danger' }}">
            {{ $resultStatus }}
        </span>

    </div>
</div>

{{-- QUESTION WISE RESULT --}}
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Question Analysis</h5>
    </div>

    <div class="card-body">

        @foreach($resultData as $index => $row)
        <div class="mb-4 p-3 border rounded">

            <h6 class="fw-bold">
                Q{{ $index + 1 }}. {{ $row['question'] }}
            </h6>

            <p class="mb-1">
                <b>Your Answer:</b>
                <span class="
                    {{ $row['status']=='correct' ? 'text-success' : 
                       ($row['status']=='wrong' ? 'text-danger' : 'text-warning') }}">
                    {{ $row['your_answer'] }}
                </span>
            </p>

            <p class="mb-1">
                <b>Correct Answer:</b>
                <span class="text-success">
                    {{ $row['correct_answer'] }}
                </span>
            </p>

            <span class="badge 
                {{ $row['status']=='correct' ? 'bg-success' : 
                   ($row['status']=='wrong' ? 'bg-danger' : 'bg-warning text-dark') }}">
                {{ ucfirst($row['status']) }}
            </span>

        </div>
        @endforeach

    </div>
</div>

</div>
</section>
@endsection
