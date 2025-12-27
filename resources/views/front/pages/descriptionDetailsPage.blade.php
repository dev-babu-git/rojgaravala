@extends('front.layout.app')

@section('title', $desciption->title)

@section('content')

<section id="govtpage" class="mb-4">
    <div class="container">

        <div class="row">

            <!-- LEFT CONTENT -->
            <div class="col-lg-10 mx-auto">

                <!-- Title Block -->
                <div class="mb-4 pb-3 border-bottom">
                    <h2 class="text-danger fw-bold mb-1">
                        {{ $desciption->title }}
                    </h2>
                    <div class="text-muted small">
                        Published on: {{ $desciption->created_at->format('d M Y') }}
                    </div>
                </div>

                <!-- Summernote Content -->
                @if($desciption->content)
                {!! $desciption->content !!}
                @else
                <p>No description available.</p>
                @endif

            </div>

            <!-- RIGHT SIDEBAR SHARE -->

        </div>

    </div>
    <div class="share-floating">
      <div id="sharePanel" class="share-panel">

        <!-- WhatsApp -->
        <a target="_blank"
           href="https://api.whatsapp.com/send?text={{ urlencode($desciption->title . ' - ' . url()->current()) }}">
            <i class="fa fa-whatsapp text-success"></i>
        </a>

        <!-- Facebook -->
        <a target="_blank"
           href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}">
            <i class="fa fa-facebook text-primary"></i>
        </a>

        <!-- Telegram -->
        <a target="_blank"
           href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($desciption->title) }}">
            <i class="fa fa-telegram text-info"></i>
        </a>

        <!-- Twitter -->
        <a target="_blank"
           href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($desciption->title) }}">
            <i class="fa fa-twitter text-info"></i>
        </a>
    </div>
    <button id="shareToggle" class="btn-skyblue rounded-circle shadow" title="shere">
        <i class="fa fa-share-alt text-white"></i>
    </button>
</div>




</section>

@endsection