@extends('frontend.layouts.app')

@section('content')

        <section class="page-header" data-stellar-background-ratio="1.2">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12 text-center">


                        <h3>
                            Chi tiết bài viết
                        </h3>

                        <p class="page-breadcrumb">
                            <a href="{{ route('home') }}">Trang chủ</a> / <a href="{{ route('news_page_list') }}">Tin tức</a> / {{ $post->title }}
                        </p>


                    </div>

                </div> <!-- end .row  -->

            </div> <!-- end .container  -->

        </section> <!-- end .page-header  -->

        <section class="section-content-block">

            <div class="container">

                <div class="row">

                    <div class="col-md-8 col-sm-12">

                        <article class="post single-post-inner">

                            <div class="post-inner-featured-content">
                                <img alt="{{ $post->title }}" src="{{ uploaded_asset($post->banner) }}">
                            </div>

                            <div class="single-post-inner-title">
                                <h2>{{ $post->title }}</h2>
                                <p class="single-post-meta">
                                    <i class="fa fa-user"></i>&nbsp; Admin &nbsp; &nbsp; 
                                    <i class="fa fa-calendar"></i>&nbsp; {{ date('F d, Y', strtotime($post->published_date)) }}
                                </p>
                            </div>

                            <div class="single-post-inner-content">
                                {!! $post->description !!}
                            </div>


                        </article> <!--  end single-post-container -->

                        <div class="article-author clearfix">

                            <div class="topic-bold-header clearfix">
                                <h4>Bài viết bởi <a href="">Admin</a></h4>
                            </div> <!-- end .topic-bold-header  -->

                            <figure class="author-avatar">
                                <a href="">
                                    <img src="{{ static_asset('assets/frontend/images/user_1.jpg') }}" alt="Avatar">
                                </a>
                            </figure>

                            <div class="about_author">
                                {{ get_setting('about_us_description') }}
                            </div>

                        </div> <!-- end .article-author  -->

                        <div class="post-nav-section clearfix">
                            @if($next_post)
                                <a class="btn btn-primary fr" href="{{ route('detail_page', ['slug' => $next_post->slug]) }}">Bài viết tiếp theo <i class="fa fa-angle-double-right"></i></a>
                            @endif
                            @if($prev_post)
                                <a class="btn btn-primary" href="{{ route('detail_page', ['slug' => $prev_post->slug]) }}"><i class="fa fa-angle-double-left"></i> Bài viết trước đó</a>
                            @endif
                        </div> <!-- end .post-nav-section  -->

                    </div> <!--  end .col-md-8 -->

                    <div class="col-md-4 col-sm-12">

                        <div class="widget site-sidebar">

                            <h2 class="widget-title">Tìm kiếm</h2>

                            <form action="{{ route('news_page_list') }}" id="search-form" class="search-form" role="form" method="get">

                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="{{ translate('Tìm kiếm....') }}">
                                    <span class="input-group-addon" onclick="document.getElementById('search-form').submit();" style="cursor: pointer;"><i class="fa fa-search"></i></span>
                                </div>

                            </form> <!-- end #search-form  -->

                        </div> <!--  end .widget -->            


                        <div class="widget site-sidebar">

                            <h2 class="widget-title">Danh mục</h2>

                            <ul class="widget-post-category clearfix">
                                @foreach($arrCategoryList as $category)
                                    <li>
                                        <a title="{{ $category->category_name }}" href="{{ route('news_page', ['slug' => $category->slug]) }}">{{ $category->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>


                        </div> <!--  end .widget -->

                        <div class="widget site-sidebar">

                            <h2 class="widget-title">Bài viết gần đây</h2>

                            @foreach($recent_posts as $recent)
                                <div class="single-recent-post">
                                    <a href="{{ route('detail_page', ['slug' => $recent->slug]) }}">{{ $recent->title }}</a>
                                    <span><i class="fa fa-calendar icon-color"></i>&nbsp; {{ date('F d, Y', strtotime($recent->published_date)) }}</span>
                                </div>
                            @endforeach

                        </div> <!--  end .widget -->

                        </div> <!--  end .widget -->
                    </div> <!-- end .col-sm-4  -->

                </div> <!--  end row  -->

            </div> <!--  end container -->

        </section> <!-- end .section-content-block  -->

@endsection