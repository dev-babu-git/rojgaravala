@extends('front.layout.app')

@section('title', $subcategory->name)

@section('content')
<div class="container my-4">
    <div class="col-sm-8 mx-auto">

        <div class="card shadow-sm">

            {{-- Card Header --}}
            <div class="card-header text-center text-white" style="background: #139bab;">
                <h5 class="mb-0">All {{ $subcategory->name }}</h5>
            </div>

            {{-- Card Body --}}
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($pages as $page)
                        <li class="list-group-item border-0 px-3 py-2 d-flex justify-content-between align-items-center">
                            <a href="{{ url($page->slug) }}" class="text-dark nav-link p-0" style="text-decoration:none;">
                                <i class="fa fa-angle-double-right text-primary"></i> {{ $page->title }}
                            </a>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted border-0 py-2">
                            No pages available.
                        </li>
                    @endforelse
                </ul>
            </div>

        </div>

    </div>
</div>
@endsection
