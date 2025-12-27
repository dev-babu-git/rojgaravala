@extends('front.layout.app')

@section('title',"{$pageName}")

@section('content')


<div class="container my-4">
    <div class="col-sm-8 mx-auto">
        <div class="card shadow-sm">

            {{-- Card Header --}}
            <div class="card-header text-center  text-white ">
                <h5 class="mb-0">{{$pageName}}</h5>
            </div>

            {{-- Card Body --}}
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">

                    @forelse($latestUpdates as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ url($item->slug) }}" class="text-primary nav-link p-0" style="text-decoration:none;">
                            <i class="fa fa-angle-double-right text-primary"></i> {{ $item->title }}
                        </a>


                    </li>


                    @empty
                    <li class="list-group-item text-center text-muted">
                        No records found.
                    </li>
                    @endforelse

                </ul>
            </div>

            {{-- Card Footer --}}
            <div class="card-footer  text-center">
                <a href="{{ route('latest.updates', 'latest-updates') }}" class="btn btn-sm btn-outline-info">
                    View More
                </a>
            </div>

        </div>
    </div>
</div>

@endsection