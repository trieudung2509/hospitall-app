@extends('frontend.layouts.app')

@section('meta_title')
    {{ get_setting('meta_title').' | '.get_setting('site_motto') }}
@endsection

@section('canonical') {{ url('') }} @endsection

@section('content')
        <main class="l-main">
          <div class="l-header__container-wrapper">
            <div class="l-header__container">
              <h1 class="headline-2 letters js-wordsplit text-center">{{ $title ?: '' }}</h1>
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

          <section class="section section--post">
            <div class="container-fluid">
                <div class="row js-load-more-container">
                    @foreach($list_posts as $post)
                        <article class="col-lg-3 col-md-4 col-xs-12">
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
                    <p class="row__full-width-child text-center">
                      <button type="button" class="btn btn--bordered" onclick="javascript:App.loadMore({obj: this, target: '.js-load-more-container', url: '/ajax_category/{{ $slug }}?page=2'});">
                        <span class="btn__inner">Tải Thêm</span>
                      </button>
                    </p>
                </div>
            </div>
            <div class="loading"></div>
        </section>
        </main>
@endsection
@section('script')
<script>
  function onCategoryList(slug) {
    console.log({ slug })
  }
</script>
  
@endsection