@extends('frontend.layouts.app')

@section('meta_title')
    {{ get_setting('meta_title').' | '.get_setting('site_motto') }}
@endsection

@section('canonical') {{ url('') }} @endsection

@section('content')
    <main>
        <section class="banner__slider">
            <div class="slider stick-dots">
                @php
                    $slider_bannerIds = $slider_banner != null ? explode(",", $slider_banner->image_thumb_ids) : [];
                @endphp
                @if (count($slider_bannerIds) > 0)
                    @foreach($slider_bannerIds as $bannerId)
                    <div class="slide">
                        <div class="slide__img">
                            <img src="{{ uploaded_asset($bannerId) }}" alt="" data-lazy="{{ uploaded_asset($bannerId) }}" class="full-image animated" data-animation-in="zoomInImage"/>
                        </div>
                        
                    </div>
                    @endforeach
                @endif
            </div>
            <div class="slide__content ">
                <div class="slide__content--headings text-center">
                    <h2 class="animated title" data-animation-in="fadeInUp">{{ $slider_banner->short_description ?? '' }}</h2>
                    <a class=" btn btn--bordered btn-introduct" href="{{ route('about_page') }}" title="Xem Thêm"><span class="btn__inner"> Xem Thêm </span></a>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle" fill="none" stroke="currentColor">
                    <circle r="20" cy="22" cx="22" id="test">
                </symbol>
            </svg>
        </section>
        <div class="vc_row wpb_row vc_row-fluid">
            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill">
                <div class="vc_column-inner vc_custom_1673165125400">
                <div class="wpb_wrapper">
                    <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_black vc_custom_1673165090760  vc_custom_1673165090760">
                    <span class="vc_sep_holder vc_sep_holder_l">
                        <span class="vc_sep_line"></span>
                    </span>
                    <span class="vc_sep_holder vc_sep_holder_r">
                        <span class="vc_sep_line"></span>
                    </span>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="vc_row wpb_row vc_row-fluid vc_custom_1673165220170">
            <div class="wpb_column vc_column_container vc_col-sm-12">
                <div class="vc_column-inner">
                <div class="wpb_wrapper">
                    <div class="edgtf-elements-holder   edgtf-one-column  edgtf-responsive-mode-768 ">
                    <div class="edgtf-eh-item   edgtf-horizontal-alignment-center " data-item-class="edgtf-eh-custom-8937" data-1024-1280="0 0 0 0" data-768-1024="0 0 0 0" data-680-768="0 4% 0 4%" data-680="0 0 0 0">
                        <div class="edgtf-eh-item-inner">
                        <div class="edgtf-eh-item-content edgtf-eh-custom-8937" style="padding: 0 17% 0 17%">
                            <div class="edgtf-section-title-holder  edgtf-st-standard  edgtf-st-position-left edgtf-appear-fx" style="text-align: center">
                            <div class="edgtf-st-inner">
                                <div class="edgtf-st-title-holder">
                                <h1 class="edgtf-st-title" style="color: #fff"> 150+ Dự <br> Án </h1>
                                </div>
                                <div class="edgtf-st-text-holder">
                                <h6 class="edgtf-st-text" style="color: #fff"> Trong hơn 08 năm, trên hơn 150 khách hàng từ cá nhân cho đến các tổ chức, đội ngũ của chúng tôi đã hoàn thiện quá trình thúc đẩy kinh doanh thông qua thiết kế. Các công trình mục đích thương mại hay nhà ở, chúng tôi đều đã có những sản phẩm hoàn thiện và được khách hàng đánh giá cao. <br> Chúng tôi tự hào về tính minh bạch tinh thần xây dựng, và hợp tác. Luôn học hỏi, tìm hiểu những điều mới để thúc đẩy công việc thiết kế. Chúng tôi tin rằng thiết kế mang lại những giá trị thiết thực và giá trị thiết thực đó phục vụ cho sự phát triển của xã hội. <br> Chúng tôi mong muốn hợp tác để tìm kiếm cơ hội với những dự án mới, những thử thách mới, cung cấp những dịch vụ tốt nhất tới khách hàng. Và đó là cơ sở để chúng tôi xây dựng, phát triển doanh nghiệp bền vững. </h6>
                                </div>
                            </div>
                            </div>
                            <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_50 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_black vc_custom_1673230930921  vc_custom_1673230930921">
                            <span class="vc_sep_holder vc_sep_holder_l">
                                <span class="vc_sep_line"></span>
                            </span>
                            <span class="vc_sep_holder vc_sep_holder_r">
                                <span class="vc_sep_line"></span>
                            </span>
                            </div>
                            <div class="edgtf-section-title-holder  edgtf-st-standard  edgtf-st-position-left edgtf-appear-fx" style="text-align: center">
                            <div class="edgtf-st-inner">
                                <div class="edgtf-st-text-holder">
                                <h5 class="edgtf-st-text" style="font-weight: 300; text-transform: uppercase;"> - Giá trị cốt lõi của chúng tôi chính là sự hài lòng của khách hàng - </h5>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="vc_row wpb_row vc_row-fluid">
            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill">
                <div class="vc_column-inner vc_custom_1673165125400">
                <div class="wpb_wrapper">
                    <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_black vc_custom_1673165090760  vc_custom_1673165090760">
                    <span class="vc_sep_holder vc_sep_holder_l">
                        <span class="vc_sep_line"></span>
                    </span>
                    <span class="vc_sep_holder vc_sep_holder_r">
                        <span class="vc_sep_line"></span>
                    </span>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="vc_row wpb_row vc_row-fluid section--post">
            <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-has-fill">
                <div class="vc_column-inner vc_custom_1673232448314">
                <div class="wpb_wrapper">
                    <div class="edgtf-link-section-holder edgtf-appear-fx edgtf-appear">
                        <div class="edgtf-link-section-title-holder">
                            <h2 class="edgtf-link-section-title"> DỰ ÁN </h2>
                        </div>
                        <?php 
                            $categories_menu = \App\BlogCategory::where(['status' => 1, 'is_home_page' =>  1])->orderBy('display_order','ASC')->get();
                        ?>
                        @foreach( $categories_menu as $cate)
                            <div class="edgtf-single-link-section-holder">
                                <a href="{{ route('news_page', ['slug' => $cate->slug]) }}" class="edgtf-link-section">
                                <div class="edgtf-single-link-title-holder">
                                    <h5 class="edgtf-single-link-title"> {{ $cate->category_name }} </h5>
                                </div>
                                </a>
                            </div>
                            <?php 
                                $item_posts = \App\Blog::where(['status' => 1, 'category_id' => $cate->id])->orderBy('published_date', 'DESC')
                                    ->take(3)->select('id','slug', 'banner', 'title', 'published_date', 'short_description', 'description')->get();
                            ?>
                            <div class="row" style="margin: 15px 0px 0px;">
                                @foreach($item_posts as $post)
                                    <article class="col-lg-4 col-md-6">
                                        <a href="{{ route('detail_page', ['slug' => $post->slug]) }}" class="tile tile--full-height">
                                        <div class="tile__img">
                                            <div class="tile__img-box tile__img-box--height-sm animation-imageScale lazy" id="news_{{ $post->id }}" data-name="news_{{ $post->id }}" data-style="    @media screen and (max-width:500px) {  #news_{{ $post->id }} {  background-position: 100% 100%; background-image: url('{{ uploaded_asset($post->banner);  }}?w=600&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:501px) and (max-width:768px) {  #news_{{ $post->id }} { background-position: 100% 100%; background-image: url('{{ uploaded_asset($post->banner) }}?w=700&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:769px) and (max-width:991px) {  #news_{{ $post->id }} { background-position: 100% 100%; background-image: url('{{ uploaded_asset($post->banner) }}?w=500&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:992px) and (max-width:1199px) {  #news_{{ $post->id }} { background-position: 100% 100%; background-image: url('{{ uploaded_asset($post->banner) }}?w=500&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:1200px) and (max-width:1400px) {  #news_{{ $post->id }} { background-position: 100% 100%; background-image: url('{{ uploaded_asset($post->banner) }}?w=600&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }    @media screen and (min-width:1401px) {  #news_{{ $post->id }} { background-position: 100% 100%; background-image: url('{{ uploaded_asset($post->banner) }}?w=600&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges')  } }   ">
                                                <picture>
                                                <source data-srcset="{{ uploaded_asset($post->banner) }}?w=499&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges" media="(max-width: 499px)">
                                                <source data-srcset="{{ uploaded_asset($post->banner) }}?w=500&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges" media="(max-width: 500px)">
                                                <source data-srcset="{{ uploaded_asset($post->banner) }}?w=641&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges" media="(max-width: 641px)">
                                                <source data-srcset="{{ uploaded_asset($post->banner) }}?w=769&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges" media="(max-width: 769px)">
                                                <source data-srcset="{{ uploaded_asset($post->banner) }}?w=902&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges" media="(max-width: 902px)">
                                                <source data-srcset="{{ uploaded_asset($post->banner) }}?w=1025&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges" media="(max-width: 1025px)">
                                                <source data-srcset="{{ uploaded_asset($post->banner) }}?w=1200&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges" media="(max-width: 1200px)">
                                                <source data-srcset="{{ uploaded_asset($post->banner) }}?w=1582&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges" media="(max-width: 1582px)">
                                                <source data-srcset="{{ uploaded_asset($post->banner) }}?w=1920&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges" media="(max-width: 1920px)">
                                                <img class=" lazy" data-src="{{ uploaded_asset($post->banner) }}?w=3860&h=&fit=crop&q=80&auto=format&fm=png&crop=faces,edges" alt="{{ $post->title }}">
                                                </picture>
                                            </div>
                                            <span class="tile__img-curtain slideInUp"></span>
                                        </div>
                                        <div class="tile__content content">
                                            <h2 class="headline-5">{{ $post->title }}</h2>
                                            <p class="content__small-text"><?php 
                                                    $description = $post->description;
                                                    preg_match_all("/<img/",$description,$m);
                                                    echo count($m[0]);
                                                     ?> pics</p>
                                            <svg version="1.1" id="btn-arrow-1949404842" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="4px" viewBox="0 0 18 4" enable-background="new 0 0 18 4" xml:space="preserve">
                                            <polyline fill="none" stroke="#fff" stroke-miterlimit="10" points="0,3.508 16.809,3.508 13.686,0.342 "></polyline>
                                            </svg>
                                        </div>
                                        </a>
                                    </article>
                                @endforeach
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
