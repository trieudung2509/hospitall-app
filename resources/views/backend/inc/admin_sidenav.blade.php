<div class="aiz-sidebar-wrap">
    <div class="aiz-sidebar left c-scrollbar">
        <div class="aiz-side-nav-logo-wrap">
            <a href="{{ route('admin.dashboard') }}" class="d-block text-left">
                @if(get_setting('header_logo') != null)
                <img class="mw-100" src="{{ uploaded_asset(get_setting('header_logo')) }}" class="brand-icon" alt="{{ get_setting('site_name') }}" style="height: 40px; margin: 0 auto; display: block; ">
                @else
                <img class="mw-100" src="{{ static_asset('assets/img/logo.png') }}" class="brand-icon" alt="{{ get_setting('site_name') }}">
                @endif
            </a>
        </div>
        <div class="aiz-side-nav-wrap">
            <div class="px-20px mb-3">
                <input class="form-control bg-soft-secondary border-0 form-control-sm text-white" type="text" name="" placeholder="{{ translate('Tìm kiếm trong menu') }}" id="menu-search" onkeyup="menuSearch()">
            </div>
            <ul class="aiz-side-nav-list" id="search-menu">
            </ul>
            <ul class="aiz-side-nav-list" id="main-menu" data-toggle="aiz-side-menu">

            @if(Auth::user()->canDo('8'))
                <li class="aiz-side-nav-item">
                    <a href="{{route('admin.dashboard')}}" class="aiz-side-nav-link">
                        <i class="las la-home aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{translate('Bảng điều khiển')}}</span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->canDo('22'))
            <li class="aiz-side-nav-item">
                <a href="{{ route('uploaded-files.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['uploaded-files.create'])}}">
                    <i class="las la-folder-open aiz-side-nav-icon"></i>
                    <span class="aiz-side-nav-text">{{ translate('Tệp đã tải lên') }}</span>
                </a>
            </li>
            @endif

            <!-- @if(Auth::user()->canDo('23'))
            <li class="aiz-side-nav-item">
                <a href="#" class="aiz-side-nav-link">
                    <i class="las la-bullhorn aiz-side-nav-icon"></i>
                    <span class="aiz-side-nav-text">{{ translate('Blog System') }}</span>
                    <span class="aiz-side-nav-arrow"></span>
                </a>
                <ul class="aiz-side-nav-list level-2">
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('blog.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['blog.create', 'blog.edit'])}}">
                            <span class="aiz-side-nav-text">{{ translate('All Posts') }}</span>
                        </a>
                    </li>
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('blog-category.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['blog-category.create', 'blog-category.edit'])}}">
                            <span class="aiz-side-nav-text">{{ translate('Categories') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif -->

            @if(Auth::user()->canDo('24'))
            <!-- Organizations & Programs -->
            <li class="aiz-side-nav-item">
                <a href="#" class="aiz-side-nav-link">
                    <i class="las la-hospital aiz-side-nav-icon"></i>
                    <span class="aiz-side-nav-text">{{ translate('Tổ chức') }}</span>
                    <span class="aiz-side-nav-arrow"></span>
                </a>
                <ul class="aiz-side-nav-list level-2">
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('organizations.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['organizations.index', 'organizations.create', 'organizations.edit']) }}">
                            <span class="aiz-side-nav-text">{{ translate('Tất cả tổ chức') }}</span>
                        </a>
                    </li>
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('programs.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['programs.index', 'programs.create', 'programs.edit']) }}">
                            <span class="aiz-side-nav-text">{{ translate('Chương trình') }}</span>
                        </a>
                    </li>
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('donation-records.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['donation-records.index', 'donation-records.create', 'donation-records.edit']) }}">
                            <span class="aiz-side-nav-text">{{ translate('Hồ sơ hiến máu') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->canDo('9'))
            <li class="aiz-side-nav-item">
                <a href="{{ route('aboutus.edit') }}" class="aiz-side-nav-link {{ areActiveRoutes(['aboutus.edit'])}}">
                    <i class="las la-folder-open aiz-side-nav-icon"></i>
                    <span class="aiz-side-nav-text">{{ translate('Về chúng tôi') }}</span>
                </a>
            </li>
            @endif

            <!-- @if(Auth::user()->canDo('12'))
            <li class="aiz-side-nav-item">
                <a href="{{ route('slider.home') }}" class="aiz-side-nav-link {{ areActiveRoutes(['slider.home'])}}">
                    <i class="las la-folder-open aiz-side-nav-icon"></i>
                    <span class="aiz-side-nav-text">{{ translate('Slider Banners') }}</span>
                </a>
            </li>
            @endif -->

            <!-- marketing -->
            @if(Auth::user()->canDo('11'))
            <li class="aiz-side-nav-item">
                <a href="#" class="aiz-side-nav-link">
                    <i class="las la-bullhorn aiz-side-nav-icon"></i>
                    <span class="aiz-side-nav-text">{{ translate('Tiếp thị') }}</span>
                    <span class="aiz-side-nav-arrow"></span>
                </a>
                <ul class="aiz-side-nav-list level-2">
                    <!-- <li class="aiz-side-nav-item">
                        <a href="{{ route('subscribers.index') }}" class="aiz-side-nav-link">
                            <span class="aiz-side-nav-text">{{ translate('Subscribers') }}</span>
                        </a>
                    </li> -->
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('admin.contacts') }}" class="aiz-side-nav-link {{ areActiveRoutes(['admin.contacts'])}}">
                            <span class="aiz-side-nav-text">{{ translate('Tin nhắn liên hệ') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            <!-- Website Setup -->
            @if(Auth::user()->canDo('13'))
            <li class="aiz-side-nav-item">
                <a href="#" class="aiz-side-nav-link {{ areActiveRoutes(['website.footer', 'website.header'])}}">
                    <i class="las la-desktop aiz-side-nav-icon"></i>
                    <span class="aiz-side-nav-text">{{translate('Thiết lập Website')}}</span>
                    <span class="aiz-side-nav-arrow"></span>
                </a>
                <ul class="aiz-side-nav-list level-2">
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('website.header') }}" class="aiz-side-nav-link">
                            <span class="aiz-side-nav-text">{{translate('Đầu trang')}}</span>
                        </a>
                    </li>
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('website.footer', ['lang'=>  App::getLocale()] ) }}" class="aiz-side-nav-link {{ areActiveRoutes(['website.footer'])}}">
                            <span class="aiz-side-nav-text">{{translate('Chân trang')}}</span>
                        </a>
                    </li>
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('website.appearance') }}" class="aiz-side-nav-link">
                            <span class="aiz-side-nav-text">{{ translate('Giao diện') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            <!-- Setup & Configurations -->
            @if(Auth::user()->canDo('14'))
            <li class="aiz-side-nav-item">
                <a href="#" class="aiz-side-nav-link">
                    <i class="las la-dharmachakra aiz-side-nav-icon"></i>
                    <span class="aiz-side-nav-text">{{translate('Cài đặt & Cấu hình')}}</span>
                    <span class="aiz-side-nav-arrow"></span>
                </a>
                <ul class="aiz-side-nav-list level-2">
                    <li class="aiz-side-nav-item">
                        <a href="{{route('general_setting.index')}}" class="aiz-side-nav-link">
                            <span class="aiz-side-nav-text">{{translate('Cài đặt chung')}}</span>
                        </a>
                    </li>
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('smtp_settings.index') }}" class="aiz-side-nav-link">
                            <span class="aiz-side-nav-text">{{translate('Cài đặt SMTP')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            <!-- Staffs -->
            @if(Auth::user()->canDo('20'))
            <li class="aiz-side-nav-item">
                <a href="#" class="aiz-side-nav-link">
                    <i class="las la-user-tie aiz-side-nav-icon"></i>
                    <span class="aiz-side-nav-text">{{translate('Nhân viên')}}</span>
                    <span class="aiz-side-nav-arrow"></span>
                </a>
                <ul class="aiz-side-nav-list level-2">
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('staffs.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['staffs.index', 'staffs.create', 'staffs.edit'])}}">
                            <span class="aiz-side-nav-text">{{translate('Tất cả nhân viên')}}</span>
                        </a>
                    </li>
                    <li class="aiz-side-nav-item">
                        <a href="{{route('roles.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['roles.index', 'roles.create', 'roles.edit'])}}">
                            <span class="aiz-side-nav-text">{{translate('Quyền nhân viên')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            </ul><!-- .aiz-side-nav -->
        </div><!-- .aiz-side-nav-wrap -->
    </div><!-- .aiz-sidebar -->
    <div class="aiz-sidebar-overlay"></div>
</div><!-- .aiz-sidebar -->