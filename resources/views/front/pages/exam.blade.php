@extends('front.layout.app')

@section('title','All Exams')

@section('content')
<div class="container my-5">
    <div class="row g-4">

        @foreach($exams as $exam)
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100 text-center">

                <img  src="{{ asset('front/images/logo/comlogo.webp')}}" class="img-fluid p-3">
 
                <div class="card-body">
                    <h6 class="fw-bold">{{ $exam->title }}</h6>

                    <a href="{{ route('front.exams.tests', $exam->slug) }}"
                       class="btn btn-primary mt-3 w-100">
                        View Details
                    </a>
                </div>

            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
