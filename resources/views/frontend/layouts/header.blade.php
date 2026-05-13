 <header class="l-header l-header--mt-none-desktop text-center home-page" style="background: #000; padding: 20px 40px;">
    <div class="l-header__logo l-header__logo--cover js-header-logo">
      <a class="l-header__logo-icon reload-home" href="#" title="Go to homepage">
        <img src="{{ uploaded_asset(get_setting('header_logo')) }}" />
      </a>
      <div class="l-navbar-right">
            <div class="edgtf-position-right-inner">
              <nav class="edgtf-main-menu edgtf-drop-down edgtf-default-nav">
                <ul id="menu-main-menu-main-navigation-mobile-navigation" class="clearfix">
                  <li id="nav-menu-item-3541" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-108 current_page_item edgtf-active-item narrow">
                    <a href="#" class="reload-home current ">
                      <span class="item_outer">
                        <span class="item_text">Trang Chủ</span>
                      </span>
                    </a>
                  </li>
                  <li id="nav-menu-item-3667" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children  has_sub narrow">
                    <a href="#" class="">
                      <span class="item_outer">
                        <span class="item_text">Dự Án</span>
                        <i class="edgtf-menu-arrow fa fa-angle-down"></i>
                      </span>
                    </a>
                    <div class="second">
                      <div class="inner">
                        <ul>
                        <?php 
                            $categories_menu = \App\BlogCategory::where(['status' => 1, 'is_show_menu' =>  1])->orderBy('display_order','ASC')->get();
                          ?>
                          @foreach( $categories_menu as $cate)
                          <li class="menu-item menu-item-type-post_type menu-item-object-page ">
                            <a href="{{ route('news_page', ['slug' => $cate->slug]) }}" class="">
                              <span class="item_outer">
                                <span class="item_text">{{ $cate->category_name }}</span>
                              </span>
                            </a>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </li>
                  <li class="menu-item menu-item-type-post_type menu-item-object-page  narrow">
                    <a href="/about-us" class="">
                      <span class="item_outer">
                        <span class="item_text">Về Chúng tôi</span>
                      </span>
                    </a>
                  </li>
                  <li class="menu-item menu-item-type-post_type menu-item-object-page  narrow">
                    <a href="/contact" class="">
                      <span class="item_outer">
                        <span class="item_text">Liên Hệ</span>
                      </span>
                    </a>
                  </li>
                </ul>
              </nav>
              <a class="edgtf-side-menu-button-opener edgtf-icon-has-hover" href="javascript:void(0)">
                <span class="edgtf-side-menu-icon">
                  <span class="edgtf-line"></span>
                  <span class="edgtf-line"></span>
                  <span class="edgtf-line"></span>
                </span>
              </a>
            </div>
      </div>
      </div>
  </header>