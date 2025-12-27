@extends('front.layout.app')

@section('title', 'Home')

@section('content')
<div class="container">




    <section id="cardsection" class="section-one py-4 py-md-5">

        <div class="wrapper1 ">
            @foreach($categories->take(4) as $cat)
            <div class="cal">
                <a href="{{ url('category/'.$cat->slug) }}">
                    {{ $cat->name }}
                </a>
            </div>
            @endforeach
        </div>

        <div class="wrapper2">
            @foreach($categories->skip(4)->take(4) as $cat)
            <div class="cal">
                <a href="{{ url('category/'.$cat->slug) }}">
                    {{ $cat->name }}
                </a>
            </div>
            @endforeach
        </div>

    </section>
    <!---card section code end here-->
    <!---card section code end here-->


    <!-- top post section start -->
    <!-- top post section start -->

    <section class=" section-two  py-md-5">
        <div class="container">
            <div class="row justify-content-center g-4">

                {{-- Government Jobs --}}
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header text-center" style="background: #139bab; color: #fff;">
                            <h5 class="">Latest Government Jobs</h5>
                        </div>

                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @forelse($governmentJobs as $job)
                                <li class="list-group-item border-0 px-3 py-2 d-flex justify-content-between align-items-center">
                                    <a href="{{ url($job->slug) }}" target="_blank" class="text-primary nav-link p-0" style="text-decoration:none;">
                                        <i class="fa fa-angle-double-right "></i>
                                        {{ \Illuminate\Support\Str::limit($job->title, 60) }}
                                    </a>
                                </li>
                                @empty
                                <li class="list-group-item text-center text-muted border-0 py-2">
                                    No latest government jobs found.
                                </li>
                                @endforelse
                            </ul>
                        </div>

                        <div class="card-footer text-center">
                            <a href="{{ route('latest.updates', 'government-jobs') }}" class="btn btn-sm btn-outline-info">
                                View More
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Private Jobs --}}
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header text-center" style="background: #139bab; color: #fff;">
                            <h5 class=""> Latest Private Jobs</h5>
                        </div>

                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @forelse($privateJobs as $job)
                                <li class="list-group-item border-0 px-3 py-2 d-flex justify-content-between align-items-center">
                                    <a href="{{ url($job->slug) }}" target="_blank" class="text-primary nav-link p-0" style="text-decoration:none;">
                                        <i class="fa fa-angle-double-right "></i>
                                        {{ \Illuminate\Support\Str::limit($job->title, 60) }}
                                    </a>
                                </li>
                                @empty
                                <li class="list-group-item text-center text-muted border-0 py-2">
                                    No latest private jobs found.
                                </li>
                                @endforelse
                            </ul>
                        </div>

                        <div class="card-footer text-center">
                            <a href="{{ route('latest.updates', 'private-jobs') }}" class="btn btn-sm btn-outline-info">
                                View More
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>



    <section class="  section-three py-4 py-md-5 ">
        <div class="container">
            <div class="row g-4">
                @foreach($categoriesForTabs as $cat)
                <div class="col-md-6">

                    <div class="card shadow-sm">
                        <div class="card-header text-center text-white">
                            <h5>{{ $cat->name }}</h5>
                        </div>

                        <div class="card-body">

                            {{-- Tabs --}}
                            <ul class="nav nav-tabs  tab_btn_center">
                                @foreach($cat->subcategories as $index => $sub)

                                @php

                                $match = checkCategoryText($sub->name);
                                @endphp

                                @if($match)
                                <li>
                                    <button class=" btn btn-outline-info rounded-pill {{ $index==0 ? 'active' : '' }}"
                                        data-bs-toggle="tab"
                                        data-bs-target="#tab-{{ $sub->id }}">

                                        {{ $match }}

                                    </button>
                                </li>
                                @endif

                                @endforeach
                            </ul>

                            {{-- Tab Content --}}
                            <div class="tab-content">

                                @foreach($cat->subcategories as $index => $sub)
                                <div class="tab-pane fade {{ $index==0 ? 'show active' : '' }}"
                                    id="tab-{{ $sub->id }}">

                                    <ul class="list-group list-group-flush">

                                        @forelse($sub->pages as $page)
                                        <li class="list-group-item   border-0   py-2  ">
                                            <a href="{{ url($page->slug) }}" target="_blank" class="text-primary">
                                                <i class="fa fa-angle-double-right "></i> {{ $page->title }}
                                            </a>
                                        </li>
                                        @empty
                                        <li class="list-group-item text-center text-muted">
                                            No data found.
                                        </li>
                                        @endforelse

                                    </ul>
                                </div>
                                @endforeach

                            </div>

                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ url('category/'.$cat->slug) }}" class="btn btn-sm btn-outline-info">
                                View More
                            </a>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!---table section end here-->

    <!--category section code satrt here-->
    <!--category section code satrt here-->
    <section class="section-five py-4 py-md-5 ">
        <div class="container">
            <div class="row g-4">
                <div class="col-sm-6">
                    <table class="table table-bordered border-dark  text-center shadow-sm rounded">
                        <thead>
                            <tr class="bg-skyblue-dark text-white">
                                <th colspan="2" class="text-center "> EDUCATION WISE JOBS </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">

                            @foreach($educations->chunk(2) as $chunk)
                            <tr>
                                @foreach($chunk as $edu)
                                <td>
                                    <a href="{{ url('education-wise/'.$edu->id) }}">
                                        {{ $edu->title }} {{-- OR $edu->name --}}
                                    </a>
                                </td>
                                @endforeach

                                {{-- If row has only 1 item --}}
                                @if($chunk->count() == 1)
                                <td></td>
                                @endif
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <div class="col-sm-6">

                    <table class="table table-bordered border-dark  text-center shadow rounded">
                        <thead>
                            <tr class="bg-skyblue-dark text-white">
                                <th colspan="2" class="text-center"> STATE JOBS </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">

                            @foreach($jobStates->chunk(2) as $chunk)
                            <tr>
                                @foreach($chunk as $state)
                                <td>

                                    <a href="{{ url('state-wise/'.$state->id) }}">
                                        {{ $state->name }}
                                    </a>
                                </td>
                                @endforeach

                                {{-- If row has only 1 item --}}
                                @if($chunk->count() == 1)
                                <td></td>
                                @endif
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
    <section class="section-four py-4 py-md-5">
        <div class="container">
            <div class="card shadow-sm">

                <!-- Category Tabs -->
                <div class="border-bottom">
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach($categoriesData as $cat)
                        <li class="nav-item" role="presentation">
                            <button
                                class=" {{ $loop->first ? 'active' : '' }} btn btn-outline-info rounded-pill mx-1 my-2"
                                data-bs-toggle="tab"
                                data-bs-target="#cat{{ $cat->id }}"
                                type="button"
                                role="tab">
                                {{ $cat->name }}
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="card-body">
                    <div class="tab-content">

                        @foreach($categoriesData as $cat)
                        <div
                            class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                            id="cat{{ $cat->id }}"
                            role="tabpanel">

                            <div class="row row-cols-2 row-cols-md-6 ">

                                @forelse($cat->brands as $brand)
                                <div class="col">
                                    <a href="{{ url('brand/'.$brand->slug) }}" class="text-decoration-none">
                                        <div class="card h-100 border-0 shadow-sm">

                                            <img
                                                src="{{ asset('uploads/jobbrand/'.$brand->image) }}"
                                                class="card-img-top p-2"
                                                alt="{{ $brand->name }}"
                                                style="height:80px; object-fit:contain;">

                                            <div class="card-body p-2">
                                                <h6 class="text-center text-dark">
                                                    {{ $brand->name }}
                                                </h6>
                                            </div>

                                        </div>
                                    </a>
                                </div>
                                @empty
                                <div class="col-12">
                                    <p class="text-center text-danger">No Brands Found</p>
                                </div>
                                @endforelse

                            </div>

                        </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </section>

   

</div>
@endsection