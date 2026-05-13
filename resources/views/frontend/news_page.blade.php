@extends('frontend.layouts.app')

@section('content')

        <section class="page-header" data-stellar-background-ratio="1.2">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12 text-center">


                        <h3>
                            Bài viết tin tức
                        </h3>

                        <p class="page-breadcrumb">
                            <a href="{{ route('home') }}">Trang chủ</a> / Tin tức
                        </p>


                    </div>

                </div> <!-- end .row  -->

            </div> <!-- end .container  -->

        </section> <!-- end .page-header  -->

        <!--  MAIN CONTENT  -->

        <section class="main-content">

            <div class="container">

                <div class="row">

                    <div class="col-md-8 col-sm-12">

                        @if($list_posts->count() > 0)
                            @foreach($list_posts as $post)
                                <article class="post single-post">

                                    <div class="single-post-content">

                                        <a title="{{ $post->title }}" href="{{ route('detail_page', ['slug' => $post->slug]) }}">
                                            <img alt="{{ $post->title }}" src="{{ uploaded_asset($post->banner) }}" />
                                        </a>

                                    </div> <!-- end .bd-view  -->

                                    <div class="single-post-title">

                                        <h2>
                                            <a href="{{ route('detail_page', ['slug' => $post->slug]) }}">
                                                {{ $post->title }}
                                            </a>
                                        </h2> <!--  end blog-post-title  -->

                                        <p class="single-post-meta">                           

                                            <i class="fa fa-user"></i>
                                            &nbsp;Admin

                                            &nbsp;<i class="fa fa-calendar"></i>
                                            &nbsp;{{ date('F d, Y', strtotime($post->published_date)) }}

                                        </p>

                                        <p>
                                            {{ $post->short_description }}
                                        </p>


                                    </div> <!-- end col-sm-8  -->

                                </article>
                            @endforeach

                            <div class="blog-pagination text-center clearfix">                
                                {{ $list_posts->links() }}
                            </div>
                        @else
                            <div class="text-center">
                                <p>{{ translate('Hiện tại chưa có bài viết nào.') }}</p>
                            </div>
                        @endif

                    </div> <!--  end .col-md-8 -->


                    <div class="col-md-4 col-sm-12">

                        <div class="widget site-sidebar">

                            <h2 class="widget-title">Tìm kiếm</h2>

                            <form action="{{ route('news_page_list') }}" id="search-form" class="search-form" role="form" method="get">

                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="{{ translate('Tìm kiếm....') }}" value="{{ $search ?? '' }}">
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
                    </div> <!-- end .col-sm-4  -->

                </div> <!--  end row  -->

            </div> <!--  end container -->

        </section> <!-- end .main-content  -->

@endsection
