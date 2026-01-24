@extends('front.layout.app')

@section('title', $desciption->title)

@section('content')

<section id="govtpage" class="py-4 bg-light">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                @if($desciption->category)
                <li class="breadcrumb-item"><a href="#">{{ $desciption->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active">{{ Str::limit($desciption->title, 50) }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Title & Meta Info -->
                <div class="mb-4">
                    <h1 class="fw-bold mb-3">{{ $desciption->title }}</h1>
                    <div class="d-flex flex-wrap gap-3 text-muted mb-3">
                        <span><i class="fa fa-calendar me-1"></i> {{ $desciption->created_at->format('d M Y') }}</span>
                        <span><i class="fa fa-user me-1"></i> {{ $desciption->user->name ?? 'Admin' }}</span>
                        @if($desciption->category)
                        <span><i class="fa fa-folder me-1"></i> {{ $desciption->category->name }}</span>
                        @endif
                    </div>

                    <!-- Tags/Labels -->
                    @if($desciption->eligibility || $desciption->state || $desciption->jobbrand)
                    <div class="mb-3">
                        @if($desciption->eligibility)
                        <span class="badge bg-primary me-2"><i class="fa fa-graduation-cap me-1"></i>{{ $desciption->eligibility }}</span>
                        @endif
                        @if($desciption->state)
                        <span class="badge bg-success me-2"><i class="fa fa-map-marker-alt me-1"></i>{{ $desciption->state }}</span>
                        @endif
                        @if($desciption->jobbrand)
                        <span class="badge bg-info"><i class="fa fa-building me-1"></i>{{ $desciption->jobbrand }}</span>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Featured Image -->
                @if($desciption->image)
                <div class="mb-4">
                    <img src="{{ asset($desciption->image) }}" 
                         alt="{{ $desciption->title }}" 
                         class="img-fluid rounded shadow-sm w-100">
                </div>
                @endif

                <!-- Main Content from CKEditor -->
                <div class="post-content mb-4">
                    @if($desciption->content)
                    {!! $desciption->content !!}
                    @else
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle me-2"></i>No description available.
                    </div>
                    @endif
                </div>

                <!-- Share Section -->
               

                <!-- Important Links (if applicable) -->
                @if($desciption->category_id && in_array($desciption->category_id, [1,2,3])) {{-- Job categories --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3"><i class="fa fa-link me-2"></i>Important Links</h5>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-outline-primary" target="_blank">
                                <i class="fa fa-file-pdf me-2"></i>Official Notification
                            </a>
                            <a href="#" class="btn btn-outline-primary" target="_blank">
                                <i class="fa fa-laptop me-2"></i>Apply Online
                            </a>
                            <a href="#" class="btn btn-outline-primary" target="_blank">
                                <i class="fa fa-id-card me-2"></i>Admit Card
                            </a>
                            <a href="#" class="btn btn-outline-primary" target="_blank">
                                <i class="fa fa-trophy me-2"></i>Result
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Related Posts -->
                @if(isset($relatedPosts) && $relatedPosts->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3"><i class="fa fa-newspaper me-2"></i>Related Posts</h5>
                        <div class="row">
                            @foreach($relatedPosts as $post)
                            <div class="col-md-6 mb-3">
                                <div class="border-bottom pb-3">
                                    <a href="{{ route('description.show', $post->slug) }}" class="text-decoration-none text-dark">
                                        <h6 class="fw-bold mb-1">{{ Str::limit($post->title, 60) }}</h6>
                                        <small class="text-muted d-block mb-1">
                                            {{ Str::limit(strip_tags($post->content), 80) }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="fa fa-calendar me-1"></i>{{ $post->created_at->format('d M Y') }}
                                        </small>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Info Card -->
                <div class="card shadow-sm mb-4 bg-primary text-white">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-3">Quick Info</h5>
                        @if($desciption->jobbrand)
                        <div class="mb-3">
                            <strong>Organization</strong><br>
                            <span class="fs-6">{{ $desciption->jobbrand }}</span>
                        </div>
                        @endif
                        @if($desciption->state)
                        <div class="mb-3">
                            <strong>Location</strong><br>
                            <span class="fs-6">{{ $desciption->state }}</span>
                        </div>
                        @endif
                        @if($desciption->eligibility)
                        <div class="mb-3">
                            <strong>Eligibility</strong><br>
                            <span class="fs-6">{{ $desciption->eligibility }}</span>
                        </div>
                        @endif
                        <div class="mb-3">
                            <strong>Published On</strong><br>
                            <span class="fs-6">{{ $desciption->created_at->format('d M Y') }}</span>
                        </div>
                        <a href="#" class="btn btn-light w-100 mt-2">
                            <i class="fa fa-external-link-alt me-2"></i>Apply Now
                        </a>
                    </div>
                </div>

                <!-- Latest Jobs -->
                @if(isset($recentPosts) && $recentPosts->count() > 0)
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3"><i class="fa fa-newspaper me-2"></i>Latest Posts</h5>
                        <ul class="list-unstyled mb-0">
                            @foreach($recentPosts as $recent)
                            <li class="mb-3 pb-3 border-bottom">
                                <a href="{{ route('description.show', $recent->slug) }}" class="text-decoration-none text-dark">
                                    <strong>{{ Str::limit($recent->title, 50) }}</strong><br>
                                    <small class="text-muted">
                                        <i class="fa fa-calendar me-1"></i>{{ $recent->created_at->format('d M Y') }}
                                    </small>
                                </a>
                            </li>
                            @endforeach

                            
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Categories -->
                @if(isset($categories) && $categories->count() > 0)
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3"><i class="fa fa-tags me-2"></i>Categories</h5>
                        <div class="list-group">
                            @foreach($categories as $cat)
                            <a href="{{ route('category.show', $cat->slug) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                {{ $cat->name }}
                                <span class="badge bg-primary rounded-pill">{{ $cat->description_pages_count ?? 0 }}</span>
                            </a>
                            @endforeach
                             
                        </div>
                    </div>
                </div>
                @endif

              
            </div>
        </div>
    </div>

    <!-- Floating Share Button (Desktop Only) -->
    <div class="share-floating d-none d-lg-block">
        <div id="sharePanel" class="share-panel">
            <a target="_blank" href="https://api.whatsapp.com/send?text={{ urlencode($desciption->title . ' - ' . url()->current()) }}">
                <i class="fab fa-whatsapp text-success"></i>
            </a>
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}">
                <i class="fab fa-facebook text-primary"></i>
            </a>
            <a target="_blank" href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($desciption->title) }}">
                <i class="fab fa-telegram text-info"></i>
            </a>
            <a target="_blank" href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($desciption->title) }}">
                <i class="fab fa-twitter text-info"></i>
            </a>
        </div>
        <button id="shareToggle" class="btn-skyblue rounded-circle shadow" title="Share">
            <i class="fa fa-share-alt text-white"></i>
        </button>
    </div>
</section>

@endsection
 