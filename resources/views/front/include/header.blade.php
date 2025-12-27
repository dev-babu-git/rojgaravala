<section id="menubar">

    <div class="logo">
        <a href="{{route('home')}}"><img class="logoresponsive" src="{{ asset('front/images/logo/comlogo.webp')}}" height="100px"
                width="auto" alt="logo"></img></a>
    </div>
</section>

<!-- =================header Start=============== -->
<!-- =================header Start=============== -->
<!-- =================header Start=============== -->

<header class="header">
    <div class="header-main">
        <div class="logo">
            <a href="{{route('home')}}">ROJGARVALA</a>
        </div>

        <div class="open-nav-menu">
            <span></span>
        </div>
        <div class="menu-overlay">
        </div>
        <!-- navigation menu start -->
        <nav class="nav-menu">
            <div class="close-nav-menu">
                <img src="{{ asset('front/images/logo/close.webp')}}" alt="close" height="auto" width="auto">
            </div>
            <ul class="menu">

                @foreach($categoriesMenu as $cat)
                <li class="menu-item menu-item-has-children">

                    <a href="{{ url('category/'.$cat->slug) }}" data-toggle="sub-menu">
                        {{ $cat->name }}
                        <i class="plus"></i>
                    </a>

                    @if($cat->subcategories->count() > 0)
                    <ul class="sub-menu">
                        @foreach($cat->subcategories as $sub)
                        <li class="menu-item">
                            <a href="{{ url('subcategory/'.$sub->slug) }}">
                                {{ $sub->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif

                </li>
                @endforeach

            </ul>

        </nav>

    </div>
</header>
</section>

{{-- Global Flash Messages --}}
@if(session('success'))
    <div class="container my-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="container my-2">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
