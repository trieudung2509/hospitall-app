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
            <p class="content__small-text">13 pics</p>
            <svg version="1.1" id="btn-arrow-1949404842" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="4px" viewBox="0 0 18 4" enable-background="new 0 0 18 4" xml:space="preserve">
            <polyline fill="none" stroke="#fff" stroke-miterlimit="10" points="0,3.508 16.809,3.508 13.686,0.342 "></polyline>
            </svg>
        </div>
        </a>
    </article>
@endforeach
@if (count($list_posts) > 0)
<p class="row__full-width-child text-center">
    <button type="button" class="btn btn--bordered" onclick="javascript:App.loadMore({obj: this, target: '.js-load-more-container', url: '/ajax_category/{{ $slug }}?page={{ $page }}'});">
        <span class="btn__inner">Tải Thêm</span>
    </button>
</p>
@endif