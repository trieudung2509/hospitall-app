<footer class="l-footer">
  <div class="container-large">
    <div class="l-footer__row">
      <div class="l-footer__col l-footer__col--flex l-footer__col--border-gold text-center js-footer-block">
        <a class="l-footer__logo reload-home" href="#" title="Archiplus Design" aria-label="Archiplus Design">
          <img class="l-footer__logo-icon" src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="Archiplus Design" />
        </a>
        <ul class="social mt-10em">
          <li class="social__item"><a class="social__link" href="{{ get_setting('facebook_link') }}" title="Our Facebook" target="_blank" rel="noopener noreferrer"> Facebook </a></li>
          <!-- <li class="social__item">
            <a class="social__link" href="https://www.linkedin.com/company/xavio-design" title="Our Linkedin" target="_blank" rel="noopener noreferrer"> Linkedin </a>
          </li> -->
        </ul>
        <div class="l-footer__bp">
          <span>Designed by</span>
          <a class="l-footer__bp-link" href="" target="_blank" rel="noopener noreferrer" title="Archiplus">Archiplus</a>
        </div>
      </div>
      <div class="l-footer__col l-footer__col--menu js-footer-block">
        <ul class="l-footer__menu">
          <li class="l-footer__menu-item">
            <a class="l-footer__menu-link reload-home" href="#" title="Trang chủ" >Trang chủ</a>
          </li>
          <?php 
            $list_categories = \App\BlogCategory::where(['status' => 1, 'is_show_menu' =>  1])->orderBy('display_order','ASC')->select('id', 'slug', 'category_name')->get();
          ?>
          @foreach( $list_categories as $cate)
          <li class="l-footer__menu-item">
            <a class="l-footer__menu-link" href="{{ route('news_page', ['slug' => $cate->slug]) }}" title="News">{{ $cate->category_name; }}</a>
          </li>
          @endforeach
          <li class="l-footer__menu-item">
            <a class="l-footer__menu-link" href="/about-us" title="Về chúng tôi">Về chúng tôi</a>
          </li>
          <li class="l-footer__menu-item">
            <a class="l-footer__menu-link" href="/contact" title="Liên Hệ">Liên Hệ </a>
          </li>
        </ul>
      </div>
      <div class="l-footer__col l-footer__col--contact-info text-center js-footer-block">
        <p class="headline-6 mb-5em">ĐỊA CHỈ</p>
        <address class="address">
          <p>
            <span>{{ get_setting('contact_address',null,'en') }}</span>
          </p>
        </address>
        <p class="headline-6 mt-10em mb-5em">ĐIỆN THOẠI</p>
        <a href="tel:{{ get_setting('contact_phone') }}" title="Call us">{{ get_setting('contact_phone') }}</a>
        <p class="headline-6 mt-10em mb-5em">Email</p>
        <a href="mailto:{{ get_setting('contact_email') }}" title="Email us"> {{ get_setting('contact_email') }}</a>
      </div>
    </div>
  </div>
  <div class="l-footer__bottom"> 
    <div class="container-super-narrow">
      <p> © Archiplus Design Ltd - Company Number: {{ get_setting('contact_phone') }}
      </p>
    </div>
  </div>
</footer>
<a id="edgtf-back-to-top" href="#">
  <span class="edgtf-btn-lines line-1"></span>
  <span class="edgtf-btn-lines line-2"></span>
  <span class="edgtf-icon-stack">Top</span>
  <span class="edgtf-btn-lines line-3"></span>
  <span class="edgtf-btn-lines line-4"></span>
</a>
