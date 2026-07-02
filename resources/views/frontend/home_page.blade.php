@extends('frontend.layouts.app')

@section('title', 'BeeLink — Khám Phá Phong Cách Của Bạn')

@section('content')
<main class="main" id="main-content">

    <!-- TRENDING TODAY -->
    <section id="trending-section" aria-labelledby="trending-h">
        <div class="sh">
            <div class="st"><h2 id="trending-h">Thịnh Hành Hôm Nay 🔥</h2><p>Outfit mọi người đang lưu nhiều nhất</p></div>
            <a href="/trending" class="va" id="va-trending">Xem tất cả <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></a>
        </div>
        <div class="scroll-wrap position-relative">
            <div class="trending-slick-slider">
                @foreach($trending_outfits as $outfit)
                    <article class="card ocard" id="oc{{ $outfit->id }}" tabindex="0">
                        <a href="{{ route('outfits.detail', $outfit->slug) }}">
                            <div class="ocard-img-wrap">
                                <img src="{{ uploaded_asset($outfit->cover_image) ?? static_asset('images/trending_outfits.png') }}" alt="{{ $outfit->title }}" class="ocard-img">
                            </div>
                        </a>
                        @if($outfit->video_url)
                            <button class="play-btn"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21" fill="currentColor"/></svg></button>
                        @endif
                        <button class="cbm"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg></button>
                        <div class="cbottom">
                            <div class="ctitle"><a href="{{ route('outfits.detail', $outfit->slug) }}">{{ $outfit->title }}</a></div>
                            <div class="cmeta">
                                <div class="ctags">
                                    @foreach($outfit->collections as $collection)
                                        <span class="tag">#{{ Str::slug($collection->title) }}</span>
                                    @endforeach
                                </div>
                                <div class="csaves"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>{{ $outfit->formatted_saves }}</div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <button class="scroll-btn sbl trending-prev" aria-label="Scroll left">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button class="scroll-btn sbr trending-next" aria-label="Scroll right">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </section>

    <!-- NEW TODAY -->
    <section id="new-today-section" aria-labelledby="new-h">
        <div class="sh">
            <div class="st"><h2 id="new-h">Mới Hôm Nay ✨</h2><p>Những bộ trang phục mới nhất dành cho bạn</p></div>
            <a href="/new" class="va" id="va-new">Xem tất cả <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></a>
        </div>
        <div class="scroll-wrap position-relative">
            <div class="new-slick-slider">
                @foreach($new_outfits as $outfit)
                    <article class="card scard" id="sc{{ $outfit->id }}" tabindex="0">
                        <a href="{{ route('outfits.detail', $outfit->slug) }}">
                            <div class="scard-img-wrap">
                                <img src="{{ uploaded_asset($outfit->cover_image) ?? static_asset('images/new_today_outfits.png') }}" alt="{{ $outfit->title }}" class="scard-img">
                            </div>
                        </a>
                        <div class="sbottom">
                            <div class="stitle"><a href="{{ route('outfits.detail', $outfit->slug) }}">{{ $outfit->title }}</a></div>
                            <div class="smeta">
                                <span class="ssaves">{{ $outfit->formatted_saves }}</span>
                                <span class="sbm"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg></span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <button class="scroll-btn sbl new-prev" aria-label="Scroll left">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button class="scroll-btn sbr new-next" aria-label="Scroll right">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </section>

    <!-- COLLECTIONS -->
    <section id="collections-section" aria-labelledby="col-h">
        <div class="sh">
            <div class="st"><h2 id="col-h">Bộ Sưu Tập 🩷</h2><p>Phong cách được tuyển chọn cho từng tâm trạng</p></div>
            <a href="/collections" class="va" id="va-col">Xem tất cả <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></a>
        </div>
        <div class="cgrid">
            @foreach($collections as $collection)
                <article class="colcard" id="col{{ $collection->id }}" tabindex="0">
                    <img src="{{ uploaded_asset($collection->cover_image) ?? static_asset('images/collections_banner.png') }}" alt="{{ $collection->title }}" class="colcard-img">
                    <div class="col-ov"></div>
                    <div class="col-info">
                        <div class="col-name">{{ $collection->title }}</div>
                        <div class="col-count">{{ $collection->outfits_count }} Bộ trang phục</div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <!-- VIDEO REELS -->
    <section id="reels-section" aria-labelledby="reel-h">
        <div class="sh">
            <div class="st"><h2 id="reel-h">Video Reels 🎬</h2><p>Ý tưởng trang phục nhanh trong 15 giây</p></div>
            <a href="/reels" class="va" id="va-reels">Xem tất cả <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></a>
        </div>
        <div class="scroll-wrap position-relative">
            <div class="reels-slick-slider">

                <article class="rcard" id="rc1" tabindex="0">
                    <div class="rcard-img-wrap"><img src="{{ static_asset('images/video_reels.png') }}" alt="3 Beach Outfits Under 800k" class="rcard-img" style="object-position:0 0;width:300%;height:100%;margin-left:0;"></div>
                    <div class="rov"></div>
                    <div class="rplay"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21" fill="white"/></svg></div>
                    <div class="rinfo"><div class="rtitle">3 Outfit Biển Dưới 800k</div><div class="rstats"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>85.7k</div></div>
                </article>

                <article class="rcard" id="rc2" tabindex="0">
                    <div class="rcard-img-wrap"><img src="{{ static_asset('images/video_reels.png') }}" alt="5 Ways to Style Linen Shirt" class="rcard-img" style="object-position:50% 0;width:300%;height:100%;margin-left:-100%;"></div>
                    <div class="rov"></div>
                    <div class="rplay"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21" fill="white"/></svg></div>
                    <div class="rinfo"><div class="rtitle">5 Cách Mặc Áo Linen</div><div class="rstats"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>92.4k</div></div>
                </article>

                <article class="rcard" id="rc3" tabindex="0">
                    <div class="rcard-img-wrap"><img src="{{ static_asset('images/video_reels.png') }}" alt="What I Wore in Da Nang" class="rcard-img" style="object-position:100% 0;width:300%;height:100%;margin-left:-200%;"></div>
                    <div class="rov"></div>
                    <div class="rplay"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21" fill="white"/></svg></div>
                    <div class="rinfo"><div class="rtitle">Tôi Mặc Gì Ở Đà Nẵng</div><div class="rstats"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>64.3k</div></div>
                </article>

                <article class="rcard" id="rc4" tabindex="0">
                    <div class="rcard-img-wrap"><img src="{{ static_asset('images/video_reels.png') }}" alt="Summer Lookbook Part 1" class="rcard-img" style="object-position:0 100%;width:300%;height:100%;margin-left:0;"></div>
                    <div class="rov"></div>
                    <div class="rplay"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21" fill="white"/></svg></div>
                    <div class="rinfo"><div class="rtitle">Lookbook Mùa Hè Phần 1</div><div class="rstats"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>78.1k</div></div>
                </article>

                <article class="rcard" id="rc5" tabindex="0">
                    <div class="rcard-img-wrap"><img src="{{ static_asset('images/video_reels.png') }}" alt="Korean Girl Outfit Ideas" class="rcard-img" style="object-position:50% 100%;width:300%;height:100%;margin-left:-100%;"></div>
                    <div class="rov"></div>
                    <div class="rplay"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21" fill="white"/></svg></div>
                    <div class="rinfo"><div class="rtitle">Gợi Ý Outfit Phong Cách Hàn</div><div class="rstats"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>91.1k</div></div>
                </article>

                <article class="rcard" id="rc6" tabindex="0">
                    <div class="rcard-img-wrap"><img src="{{ static_asset('images/video_reels.png') }}" alt="Cafe Outfit Inspo" class="rcard-img" style="object-position:100% 100%;width:300%;height:100%;margin-left:-200%;"></div>
                    <div class="rov"></div>
                    <div class="rplay"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21" fill="white"/></svg></div>
                    <div class="rinfo"><div class="rtitle">Cảm Hứng Outfit Cà Phê</div><div class="rstats"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>53.2k</div></div>
                </article>

            </div>
            <button class="scroll-btn sbl reels-prev" aria-label="Scroll reels left">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button class="scroll-btn sbr reels-next" aria-label="Scroll reels right">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </section>

</main>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.trending-slick-slider').slick({
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 2,
            prevArrow: $('.trending-prev'),
            nextArrow: $('.trending-next'),
            responsive: [
                {
                    breakpoint: 1100,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('.new-slick-slider').slick({
            infinite: false,
            variableWidth: true,
            slidesToScroll: 2,
            prevArrow: $('.new-prev'),
            nextArrow: $('.new-next'),
        });

        $('.reels-slick-slider').slick({
            infinite: false,
            variableWidth: true,
            slidesToScroll: 2,
            prevArrow: $('.reels-prev'),
            nextArrow: $('.reels-next'),
        });
    });
</script>
@endsection
