        <!--  HEADER -->

        <header class="main-header clearfix" data-sticky_header="true">

            <div class="top-bar clearfix">

                <div class="container">

                    <div class="row">

                        <div class="col-md-8 col-sm-12">

                            <p>
                                <span><i class="fa fa-building-o"></i> {{ get_setting('contact_address') }}</span>
                                <span>&nbsp;<i class="fa fa-phone"></i> {{ get_setting('contact_phone') }}</span>
                            </p>

                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="top-bar-social">
                                @if(get_setting('facebook_link'))
                                    <a href="{{ get_setting('facebook_link') }}" target="_blank"><i class="fa fa-facebook rounded-box"></i></a>
                                @endif
                                @if(get_setting('twitter_link'))
                                    <a href="{{ get_setting('twitter_link') }}" target="_blank"><i class="fa fa-twitter rounded-box"></i></a>
                                @endif
                                @if(get_setting('instagram_link'))
                                    <a href="{{ get_setting('instagram_link') }}" target="_blank"><i class="fa fa-instagram rounded-box"></i></a>
                                @endif
                                @if(get_setting('youtube_link'))
                                    <a href="{{ get_setting('youtube_link') }}" target="_blank"><i class="fa fa-youtube rounded-box"></i></a>
                                @endif
                                @if(get_setting('linkedin_link'))
                                    <a href="{{ get_setting('linkedin_link') }}" target="_blank"><i class="fa fa-linkedin rounded-box"></i></a>
                                @endif
                            </div>   
                        </div> 

                    </div>

                </div> <!--  end .container -->

            </div> <!--  end .top-bar  -->

            <section class="header-wrapper navgiation-wrapper">

                <div class="navbar navbar-default">			
                    <div class="container">

                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="logo" href="{{ route('home') }}">
                                <img alt="{{ get_setting('website_name') }}" src="{{ uploaded_asset(get_setting('header_logo')) }}">
                            </a>
                        </div>

                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-right">
                                
                                <li>
                                    <a href="{{ route('home') }}">{{ translate('Trang chủ') }}</a>
                                </li>

                                
                                <li><a href="{{ route('about_page') }}" title="{{ translate('About Us') }}">{{ translate('Giới thiệu') }}</a></li>

                                <li>
                                    <a href="{{ route('campaign') }}">{{ translate('Chiến dịch') }}</a>
                                </li>

                                <li>
                                    <a href="{{ route('news_page_list') }}">{{ translate('Tin tức') }}</a>
                                </li>

                                <li><a href="{{ route('contact_us') }}">{{ translate('Liên hệ') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </section>

        </header> <!-- end main-header  -->