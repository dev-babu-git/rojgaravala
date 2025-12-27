<footer class="bg-skyblue-dark text-light pt-5 pb-4">
  <div class="container">

    <div class="row">

      <!-- Find Us On -->
      <div class="col-md-4 col-sm-12 mb-4">
        <h5 class="text-uppercase fw-bold mb-3">Find Us On</h5>

        <!-- Social Icons -->

        <div class="social mt-2 mb-3">
          <div class="wrapper">
            <a href="https://chat.whatsapp.com/Fyv4jLnlsP6KeBdiJqUpsA" rel="noopener noreferrer" class="icon whatsapp">
              <div class="tooltip">Whatsapp</div>
              <span><i class="fa fa-whatsapp"></i></span>
            </a>
            <a href="https://www.facebook.com/profile.php?id=100086948814117&mibextid=ZbWKwL" rel="noopener noreferrer" class="icon facebook">
              <div class="tooltip">Facebook</div>
              <span><i class="fa fa-facebook"></i></span>
            </a>
            <a href="https://www.twitter.com/@rojgarvala/" target="_blank" rel="noopener noreferrer" class="icon twitter">
              <div class="tooltip">Twitter</div>
              <span><i class="fa fa-twitter"></i></span>
            </a>
            <a href="https://www.instagram.com/rojgarvala/" target="_blank" rel="noopener noreferrer" class="icon instagram">
              <div class="tooltip">Instagram</div>
              <span><i class="fa fa-instagram"></i></span>
            </a>
            <a href="https://t.me/rojgarvaladotcom" target="_blank" rel="noopener noreferrer" class="icon telegram">
              <div class="tooltip">Telegram</div>
              <span><i class="fa fa-telegram"></i></span>
            </a>
            <a href="https://www.youtube.com/@rojgarvala" target="_blank" rel="noopener noreferrer" class="icon youtube">
              <div class="tooltip">Youtube</div>
              <span><i class="fa fa-youtube"></i></span>
            </a>
          </div>
        </div>


        <h4 class="fw-bold text-warning">ROJGARVALA</h4>
        <p>
          <a href="https://rojgarvala.com/" class="text-warning">Rojgarvala.com</a> is a free website providing the latest jobs information with all support.
        </p>
      </div>

      <!-- Quick Links -->
      <div class="col-md-3 col-sm-6 mb-4">
        <h5 class="text-uppercase fw-bold mb-3">Quick Links</h5>
        <ul class="list-unstyled">
          @foreach($footerCategories->take(4) as $cat)

          <li>
            <a href="{{ url('category/'.$cat->slug) }}" class="text-light">
              {{ $cat->name }}
            </a>
          </li>
          @endforeach
        </ul>

      </div>



      <!-- Important Links -->
      <div class="col-md-3 col-sm-6 mb-4">
        <h5 class="text-uppercase fw-bold mb-3">Important Links</h5>
        <ul class="list-unstyled">
          @foreach($footerCategories->skip(4)->take(4) as $link)

          <li>
            <a href="{{ url('category/'.$link->slug) }}" class="text-light">
              {{ $link->name }}
            </a>
          </li>
          @endforeach
        </ul>
      </div>


      <!-- Pages -->
      <div class="col-md-2 col-sm-6 mb-4">
        <h5 class="text-uppercase fw-bold mb-3">Pages</h5>
        <ul class="list-unstyled">
          <ul class="list-unstyled">
            @foreach($websitePage as $link)
            <li>
              <a href="{{ url('page-data/'.$link->slug) }}" class="text-light">
                {{ $link->name }}
              </a>
            </li>
            @endforeach

          </ul>
        </ul>
      </div>

    </div>

    <hr class="border-secondary">

    <div class="text-center mt-3">
      <p class="mb-0">
        &copy; {{ date('Y') }}
        <a href="{{ route('home') }}" class="text-decoration-none text-dark">
          Rojgarvala.com
        </a>
        | All Rights Reserved.
      </p>
    </div>

    <button id="scrollTopBtn" class="btn-skyblue rounded-circle shadow" title="Go to top">
      <i class="fa fa-arrow-up text-white"></i>
    </button>


  </div>
</footer>

<script src="{{ asset('front/js/menubar.js')}}"></script>
<script src="{{ asset('front/js/custom.js')}}"></script>
<script src="{{ asset('front/js/bootstrap.bundle.min.js')}}"></script>