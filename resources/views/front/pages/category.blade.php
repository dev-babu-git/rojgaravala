@extends('front.layout.app')

@section('title', 'Home')

@section('content')
<style>
    .bg-info {
        background-color: #139bab !important;
    }
    .study-card {
        transition: transform 0.2s;
        cursor: pointer;
        
    }
    .study-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .study-icon {
        font-size: 40px;
    }

    #govtpage .card .card-body  {
        min-height: 200px;
        border-radius: 12px;
    }   
    
</style>

<section id="govtpage" class="mt-4">
    <div class="container">
        <h1 class="text-center">{{$category->name}}</h1>

        {{-- If study materials, show type cards --}}
        @if($category->slug === 'study-materials')
            <div class="row ">
                @foreach($subcategories as $subCat)
                <div class=" col-sm-4">
                    <div class="card shadow-sm study-card mb-4">

                        {{-- Card Body --}}
                        <div class="card-body text-center p-4">
                            {{-- Icon based on type --}}
                            @php
                                $icon = 'fa-book'; // default icon
                                if(strtolower($subCat->name) == 'pdf') $icon = 'fa-file-pdf-o ';
                                elseif(strtolower($subCat->name) == 'notes') $icon = 'fa-sticky-note';
                                elseif(strtolower($subCat->name) == 'video') $icon = 'fa-video';
                            @endphp

                            <i class="fa {{ $icon }} text-info study-icon mb-3"></i>
                            <h5 class="card-title">{{ $subCat->name }}</h5>
                            <p class="card-text">
                                {{ $subCat->pages->count() }} {{ $subCat->pages->count() > 1 ? 'items' : 'item' }}
                            </p>
                            <a href="{{ url('subcategory/'.$subCat->slug) }}" class="btn btn-sm btn-outline-info">
                                View
                            </a>
                        </div>
                    </div>
                    
                </div>
                @endforeach
            </div>
        @else
            {{-- For other categories, show normal subcategory cards --}}
            <div class="row justify-content-center">
                @foreach ($subcategories as $subCat)
                <div class="col-12 col-md-6 col-lg-6 mb-4">
                    <div class="card shadow-sm cal">

                        {{-- Card Header --}}
                        <div class="card-header text-center bg-info text-white">
                            <h5 class="mb-0">{{ $subCat->name }}</h5>
                        </div>

                        {{-- Card Body --}}
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @forelse($subCat->pages as $item)
                                <li class="list-group-item border-0 px-3 py-2 d-flex justify-content-between align-items-center">
                                    <a href="{{ url($item->slug) }}" class="text-dark nav-link p-0" style="text-decoration:none;">
                                        <i class="fa fa-angle-double-right text-primary"></i> {{ $item->title }}
                                    </a>
                                </li>
                                @empty
                                <li class="list-group-item text-center text-muted border-0 py-2">
                                    No pages available.
                                </li>
                                @endforelse
                            </ul>
                        </div>

                        {{-- Card Footer --}}
                        <div class="card-footer text-center">
                            <a href="{{ url('subcategory/'.$subCat->slug) }}" class="btn btn-sm btn-outline-info">
                                View All
                            </a>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
@endsection
