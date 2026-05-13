<!doctype html>
<html dir="ltr" lang="en-GB" prefix="og: http://ogp.me/ns#">
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">
    <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">

    <meta charset="utf-8">
    <title>@yield('meta_description', get_setting('meta_description') )</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index, follow">
    
    <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">
    @yield('meta')

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ static_asset('assets/frontend/css/main.css') }}">
    <script>
      (function(w, d) {
        w.addEventListener('LazyLoad::Initialized', function(e) {
          w.lazyLoadInstance = e.detail.instance;
        }, false);
        var b = d.getElementsByTagName('head')[0];
        var s = d.createElement("script");
        s.async = true;
        var v = !("IntersectionObserver" in w) ? "lazyloadPolyfill.js" : "lazyloadIntersectionObserver.js";
        s.src = "/public/assets/scripts/" + v;
        w.lazyLoadOptions = {
          elements_selector: ".lazy",
          threshold: 0,
          callback_enter: function(element) {
            var css = element.getAttribute('data-style');
            if (css) {
              css = css.replace(/(\r\n|\n|\r)/gm, "");
              var style = document.createElement('style');
              var head = document.getElementsByTagName('head')[0];
              head.appendChild(style);
              style.setAttribute("type", "text/css");
              if (style.styleSheet) {
                style.styleSheet.cssText = css;
              } else {
                var styleText = document.createTextNode(css);
                style.appendChild(styleText);
              }
              setTimeout(function() {
                element.classList.add('lazy--loaded');
              }, 300);
            }
          }
        };
        b.appendChild(s);
      }(window, document));
    </script>
    <style>
      .aspect {
        position: relative;
        padding-top: calc(var(--height) / var(--width) * 100%);
        height: 0;
        display: block;
      }

      .aspect iframe,
      .aspect video {
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
      }
    </style>
   <script src="{{ static_asset('assets/frontend/js/jquery.min.js') }}"></script>
  <link rel="stylesheet" href="{{ static_asset('assets/frontend/css/all.min.css') }}" />
  <link rel='stylesheet' href="{{ static_asset('assets/frontend/css/slick.min.css') }}">
  <script src="{{ static_asset('assets/frontend/js/slick-animation.min.js') }}"></script>
  <script src="{{ static_asset('assets/frontend/js/slick.min.js') }}"></script>
  <link rel="stylesheet" href="{{ static_asset('assets/frontend/css/style.css') }}">

    </head>
    <body>
    <section class="edgtf-side-menu" style="overflow-y: hidden; outline: none;" tabindex="0">
      <div class="edgtf-close-side-menu-holder">
        <a class="edgtf-close-side-menu" href="#" target="_self">
          <i class="fal fa-times" style="font-size: 30px;"></i>
        </a>
      </div>
      <div class="widget edgtf-separator-widget">
        <div class="edgtf-separator-holder clearfix  edgtf-separator-center edgtf-separator-normal">
          <div class="edgtf-separator" style="border-color: transparent;border-style: solid;width: 10px;border-bottom-width: 20px;margin-top: 24px;margin-bottom: 10px"></div>
        </div>
      </div>
      <div id="text-10" class="widget edgtf-sidearea widget_text">
        <div class="textwidget">
          <p>
            <img decoding="async" loading="lazy" class="alignnone size-full wp-image-3841" src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="" width="70%">
          </p>
        </div>
      </div>
      <div class="widget edgtf-separator-widget">
        <div class="edgtf-separator-holder clearfix  edgtf-separator-center edgtf-separator-normal">
          <div class="edgtf-separator" style="border-color: transparent;border-style: solid;margin-top: 0px"></div>
        </div>
      </div>
      <div id="text-11" class="widget edgtf-sidearea widget_text">
        <div class="textwidget">
          <p style="font-size: 15px">
            <em>{{ get_setting('about_us_description'); }}</em>
          </p>
        </div>
      </div>
      <div class="widget edgtf-separator-widget">
        <div class="edgtf-separator-holder clearfix  edgtf-separator-center edgtf-separator-normal">
          <div class="edgtf-separator" style="border-style: solid;border-bottom-width: 0px;margin-top: 20px;margin-bottom: 0px"></div>
        </div>
      </div>
      <div class="widget edgtf-raw-html-widget  ">
        <div class="edgtf-icon-list-holder  edgtf-icon-list-inline-display" style="margin-bottom: 0px">
          <div class="edgtf-il-icon-holder">
            <i class="fal fa-headphones-alt" style="color: #fff;font-size: 21px"></i>
          </div>
          <p class="edgtf-il-text" style="color: #fff;font-size: 15px;padding-left: 13px">Call us on {{ get_setting('contact_phone') }}</p>
        </div>
        <div class="edgtf-icon-list-holder  edgtf-icon-list-inline-display" style="margin-bottom: 0px">
          <div class="edgtf-il-icon-holder">
            <i class="fal fa-map-marker-alt" style="color: #fff;font-size: 21px"></i>
          </div>
          <p class="edgtf-il-text" style="color: #fff;font-size: 15px;padding-left: 13px">{{ get_setting('contact_address') }}</p>
        </div>
        <div class="edgtf-icon-list-holder  edgtf-icon-list-inline-display" style="margin-bottom: 0px">
          <div class="edgtf-il-icon-holder">
            <i class="fal fa-clock" style="color: #fff;font-size: 21px"></i>
          </div>
          <p class="edgtf-il-text" style="color: #fff;font-size: 15px;padding-left: 13px">Mon - Sat 8 AM - 8 PM</p>
        </div>
        <div class="edgtf-icon-list-holder  edgtf-icon-list-inline-display" style="margin-bottom: 0px">
          <div class="edgtf-il-icon-holder">
            <i class="fal fa-envelope" style="color: #fff;font-size: 21px"></i>
          </div>
          <p class="edgtf-il-text" style="color: #fff;font-size: 15px;padding-left: 13px">{{ get_setting('contact_email') }}</p>
        </div>
      </div>
    </section>
      <div id="barba-wrapper">
        <div class="barba-container">
          <div class="l-navbar js-navbar-scroll ">
            <div class="l-navbar__logo ">
              <a class="l-navbar__logo-icon reload-home" href="#" title="Go to homepage">
                <span>Go to homepage</span>
                <img src="{{ uploaded_asset(get_setting('header_logo')) }}" style="width: 75%;" />
              </a>
            </div>
              <button class="l-navbar__burger js-burger-btn custom-cursor" type="button" aria-label="menu">
                <span class="l-navbar__burger-text">Menu</span>
                <span class="burger custom-cursor">
                  <span class="burger-item burger-item--first"></span>
                  <span class="burger-item burger-item--second"></span>
                </span>
              </button>
            </div>
          <div class="l-navbar-mobile l-navbar-mobile--hide js-nav-mobile"><a href="#" class="reload-home" title="Go to homepage"><img class="l-navbar-mobile__logo" src="{{ uploaded_asset(get_setting('header_logo')) }}" alt="Archiplus Design"></a><button class="burger js-burger-btn custom-cursor" type="button" aria-label="menu"><span class="burger-item burger-item--first"></span><span class="burger-item burger-item--second"></span></button></div>
          <!-- onclick icon show menu -->
          <nav class="l-menu-wrapper js-menu-wrapper hide">
            <div class="container-large">
              <div class="row row--no-gutters align-items-center l-menu">
                <ul class="col-lg-11 offset-pad-lg-1 l-menu-left">
                  <li class="l-menu-left__item"><a class="l-menu-left__link js-wordsplit reload-home" href="#" title="Trang Chủ">Trang Chủ</a></li>
                  <?php 
                    $categories_menu = \App\BlogCategory::where(['status' => 1, 'is_show_menu' =>  1])->get();
                  ?>
                  @foreach( $categories_menu as $cate)
                  <li class="l-menu-left__item"><a class="l-menu-left__link js-wordsplit" href="{{ route('news_page', ['slug' => $cate->slug]) }}" title="{{ $cate->category_name }}">{{ $cate->category_name }}</a></li>
                  @endforeach
                  <li class="l-menu-left__item"><a class="l-menu-left__link js-wordsplit" href="/about-us" title="About Us">Về chúng tôi</a></li>
                  <li class="l-menu-left__item"><a class="l-menu-left__link js-wordsplit" href="/contact" title="Contact">Liên Hệ</a></li>
                </ul>
                <div class="l-menu-right">
                  <p class="headline-6 mb-5em">ĐỊA CHỈ</p>
                  <address class="address">
                    <p><span>{{ get_setting('contact_address',null,'en') }}</span><br></p>
                  </address>
                  <p class="headline-6 mt-20em mb-5em">ĐIỆN THOẠI</p><a href="tel:{{ get_setting('contact_phone') }}" title="Call us"> {{ get_setting('contact_phone') }} </a>
                  <p class="headline-6 mt-20em mb-5em">Email</p><a href="mailto:{{ get_setting('contact_email') }}" title="Email us"> {{ get_setting('contact_email') }} </a>
                  <p class="headline-6 mt-20em mb-5em">Social</p>
                  <ul class="social">
                    <li class="social__item"><a class="social__link" href="{{ get_setting('facebook_link')}}" title="Our Instagram" target="_blank" rel="noopener noreferrer"> Facebook </a></li>
                    <!-- <li class="social__item"><a class="social__link" href="https://www.linkedin.com/company/xavio-design" title="Our Linkedin" target="_blank" rel="noopener noreferrer"> Linkedin </a></li> -->
                  </ul>
                </div>
              </div>
            </div>
          </nav>
    @include('frontend.layouts.header')
    @yield('content')
    @include('frontend.layouts.footer') 
    <div class="cursor" id="cursor"></div>
    <script src="{{ static_asset('assets/frontend/js/vendor.js') }}"></script>
    <script src="{{ static_asset('assets/frontend/js/app.js') }}"></script>
    @yield('script')
    <script>
      $(document).ready(function() {
        var body = $("html, body");
        let height = $(document).height();
        
        $(document).on("click", ".edgtf-side-menu-button-opener", function() {
          $(this).addClass("opened");
          $(body).addClass("edgtf-right-side-menu-opened")
        });

        $(document).on("click", ".edgtf-close-side-menu", function() {
          $(body).find(".edgtf-side-menu-button-opener").removeClass("opened");
          $(body).removeClass("edgtf-right-side-menu-opened")
        });

        $(window).scroll(function(){
            var top = $(this).scrollTop() // Get position of the body
            if(top >= height/6 )
            {
              $("#edgtf-back-to-top").addClass("on");
            } else {
              $("#edgtf-back-to-top").removeClass("on");
            }
          });
          $(document).on("click", "#edgtf-back-to-top", function() {
            body.stop().animate({scrollTop:0}, 500, 'swing');
          });

          $('.slider').slick({
            autoplay: true,
            speed: 500,
            autoplaySpeed: 3600,
            fade: true,
            lazyLoad: 'progressive',
            arrows: false,
            dots: false,
            cssEase: 'linear',
            infinite: true
          });
          $(document).on("click", ".reload-home", function(event) {
            event.preventDefault();
            console.log("asss");
            window.location.href = "/";
          });
      })
  
        
    </script>
</body>
</html>
