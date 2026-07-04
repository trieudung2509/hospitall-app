@extends('frontend.layouts.app')

@section('title', 'BeeLink — Khám Phá Phong Cách Của Bạn')

@section('content')

<main class="main" id="main-content">

    @foreach($ordered_blocks as $block)
        @if(isset($block['active']) && $block['active'])
            @php
                $type = $block['type'];
                $title = $block['title'];
                $subtitle = $block['subtitle'] ?? '';
                $style = $block['style'] ?? 'slide';
                $cols = $block['columns'] ?? 4;
            @endphp

            <!-- TRENDING TODAY BLOCK -->
            @if($type == 'trending')
                <section id="trending-section" class="home-section" aria-labelledby="trending-h">
                    <div class="sh">
                        <div class="st">
                            <h2 id="trending-h">{{ $title }}</h2>
                            @if($subtitle) <p>{{ $subtitle }}</p> @endif
                        </div>
                        <a href="/trending" class="va" id="va-trending">Xem tất cả <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></a>
                    </div>
                    
                    @if($style == 'slide')
                        <div class="scroll-wrap position-relative">
                            <div class="trending-slick-slider" data-cols="{{ $cols }}">
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
                    @else
                        <div class="dynamic-grid" style="--cols: {{ $cols }}">
                            @foreach($trending_outfits as $outfit)
                                <article class="card ocard" id="oc{{ $outfit->id }}" tabindex="0" style="margin-bottom:0;">
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
                    @endif
                </section>
            @endif

            <!-- NEW TODAY BLOCK -->
            @if($type == 'new_today')
                <section id="new-today-section" class="home-section" aria-labelledby="new-h">
                    <div class="sh">
                        <div class="st">
                            <h2 id="new-h">{{ $title }}</h2>
                            @if($subtitle) <p>{{ $subtitle }}</p> @endif
                        </div>
                        <a href="/new" class="va" id="va-new">Xem tất cả <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></a>
                    </div>
                    
                    @if($style == 'slide')
                        <div class="scroll-wrap position-relative">
                            <div class="new-slick-slider" data-cols="{{ $cols }}">
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
                    @else
                        <div class="dynamic-grid" style="--cols: {{ $cols }}">
                            @foreach($new_outfits as $outfit)
                                <article class="card scard" id="sc{{ $outfit->id }}" tabindex="0" style="margin-bottom:0; width:100%;">
                                    <a href="{{ route('outfits.detail', $outfit->slug) }}">
                                        <div class="scard-img-wrap" style="height:260px;">
                                            <img src="{{ uploaded_asset($outfit->cover_image) ?? static_asset('images/new_today_outfits.png') }}" alt="{{ $outfit->title }}" class="scard-img" style="height:100%; object-fit:cover;">
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
                    @endif
                </section>
            @endif


              <!-- CUSTOM COLLECTION BLOCK -->
            @if($type == 'custom_collection')
                @php
                    $cc_outfits = $block['outfits'] ?? collect();
                    $cc_slug = $block['collection_slug'] ?? '';
                @endphp
                <section class="home-section" style="margin-top: 48px;">
                    <div class="sh">
                        <div class="st">
                            <h2>{{ $title }}</h2>
                            @if($subtitle) <p>{{ $subtitle }}</p> @else <p>Bộ sưu tập thời trang đặc sắc</p> @endif
                        </div>
                        @if($cc_slug)
                            <a href="{{ route('collections.show', $cc_slug) }}" class="va">Xem tất cả <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></a>
                        @endif
                    </div>
                    
                    @if(count($cc_outfits) > 0)
                        @if($style == 'slide')
                            <div class="scroll-wrap position-relative">
                                <div class="custom-slick-slider" data-cols="{{ $cols }}">
                                    @foreach($cc_outfits as $outfit)
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
                                <button class="scroll-btn sbl custom-prev" aria-label="Scroll left">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <button class="scroll-btn sbr custom-next" aria-label="Scroll right">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>
                        @else
                            <div class="dynamic-grid" style="--cols: {{ $cols }}">
                                @foreach($cc_outfits as $outfit)
                                    <article class="card ocard" id="oc{{ $outfit->id }}" tabindex="0" style="margin-bottom:0;">
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
                        @endif
                    @else
                        <p class="text-muted text-center py-3">Chưa có bộ trang phục nào trong bộ sưu tập này.</p>
                    @endif
                </section>
            @endif

            <!-- VIDEO REELS BLOCK -->
            @if($type == 'reels' && get_setting('enable_video_reels', '1') === '1')
                <section id="reels-section" class="home-section" aria-labelledby="reel-h">
                    <div class="sh">
                        <div class="st">
                            <h2 id="reel-h">{{ $title }}</h2>
                            @if($subtitle) <p>{{ $subtitle }}</p> @endif
                        </div>
                        <a href="{{ route('frontend.reels.index') }}" class="va" id="va-reels">Xem tất cả <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></a>
                    </div>
                    
                    @if($style == 'slide')
                        <div class="scroll-wrap position-relative">
                            <div class="reels-slick-slider" data-cols="{{ $cols }}">
                                @forelse($reels as $reel)
                                    <article class="rcard" id="rc{{ $reel->id }}" tabindex="0" onclick="window.location.href='{{ route('frontend.reels.show', $reel->id) }}'" style="cursor: pointer;">
                                        <div class="rcard-img-wrap">
                                            <img src="{{ uploaded_asset($reel->thumbnail) }}" alt="{{ $reel->title }}" class="rcard-img" style="width:100%; height:100%; object-fit:cover;">
                                        </div>
                                        <div class="rov"></div>
                                        <div class="rplay"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21" fill="white"/></svg></div>
                                        <div class="rinfo">
                                            <div class="rtitle">{{ $reel->title }}</div>
                                            <div class="rstats">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>{{ $reel->formatted_views }}
                                            </div>
                                        </div>
                                    </article>
                                @empty
                                    @for($i=1; $i<=6; $i++)
                                        <article class="rcard" id="rc-placeholder-{{ $i }}" tabindex="0">
                                            <div class="rcard-img-wrap"><img src="{{ static_asset('images/video_reels.png') }}" alt="Placeholder" class="rcard-img" style="object-position:{{ (($i-1) % 3) * 50 }}% {{ (($i-1) > 2) ? 100 : 0 }}%;width:300%;height:100%;margin-left:-{{ (($i-1) % 3) * 100 }}%;"></div>
                                            <div class="rov"></div>
                                            <div class="rplay"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21" fill="white"/></svg></div>
                                            <div class="rinfo"><div class="rtitle">Reel thời trang #{{ $i }}</div><div class="rstats"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>1.5k</div></div>
                                        </article>
                                    @endfor
                                @endforelse
                            </div>
                            <button class="scroll-btn sbl reels-prev" aria-label="Scroll reels left">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button class="scroll-btn sbr reels-next" aria-label="Scroll reels right">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    @else
                        <div class="dynamic-grid" style="--cols: {{ $cols }}">
                            @forelse($reels as $reel)
                                <article class="rcard" id="rc{{ $reel->id }}" tabindex="0" onclick="window.location.href='{{ route('frontend.reels.show', $reel->id) }}'" style="cursor: pointer; width:100%; margin-bottom:0;">
                                    <div class="rcard-img-wrap" style="position: relative; padding-top: 140%; background: #000; overflow: hidden; border-radius: 16px;">
                                        <img src="{{ uploaded_asset($reel->thumbnail) }}" alt="{{ $reel->title }}" style="position: absolute; top:0; left:0; width:100%; height:100%; object-fit:cover;">
                                        <div class="rov" style="position: absolute; top:0; left:0; right:0; bottom:0; background: linear-gradient(to bottom, rgba(0,0,0,0) 60%, rgba(0,0,0,0.7) 100%);"></div>
                                        <div class="rplay"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21" fill="white"/></svg></div>
                                        <div class="rinfo" style="position: absolute; bottom:0; left:0; right:0; padding:16px; color:white; z-index:2;">
                                            <div class="rtitle" style="font-size: 14.5px; font-weight: 700; line-height: 1.3; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $reel->title }}</div>
                                            <div class="rstats" style="font-size:12px; margin-top:4px; display:flex; align-items:center; gap:4px; opacity:0.9;">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:14px; height:14px;"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>{{ $reel->formatted_views }}
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                @for($i=1; $i<=6; $i++)
                                    <article class="rcard" id="rc-placeholder-{{ $i }}" tabindex="0" style="width:100%; margin-bottom:0;">
                                        <div class="rcard-img-wrap" style="position: relative; padding-top: 140%; background: #000; overflow: hidden; border-radius: 16px;">
                                            <img src="{{ static_asset('images/video_reels.png') }}" alt="Placeholder" style="position: absolute; top:0; left:0; width:100%; height:100%; object-fit:cover;">
                                            <div class="rov" style="position: absolute; top:0; left:0; right:0; bottom:0; background: linear-gradient(to bottom, rgba(0,0,0,0) 60%, rgba(0,0,0,0.7) 100%);"></div>
                                            <div class="rplay"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21" fill="white"/></svg></div>
                                            <div class="rinfo" style="position: absolute; bottom:0; left:0; right:0; padding:16px; color:white; z-index:2;">
                                                <div class="rtitle" style="font-size: 14.5px; font-weight: 700; line-height: 1.3;">Reel thời trang #{{ $i }}</div>
                                                <div class="rstats" style="font-size:12px; margin-top:4px; display:flex; align-items:center; gap:4px; opacity:0.9;">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:14px; height:14px;"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>1.5k
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endfor
                            @endforelse
                        </div>
                    @endif
                </section>
            @endif

          

        @endif
    @endforeach

</main>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        // Dynamic trending sliders
        $('.trending-slick-slider').each(function() {
            var cols = parseInt($(this).data('cols')) || 4;
            $(this).slick({
                infinite: false,
                slidesToShow: cols,
                slidesToScroll: 2,
                prevArrow: $(this).siblings('.trending-prev'),
                nextArrow: $(this).siblings('.trending-next'),
                responsive: [
                    {
                        breakpoint: 1100,
                        settings: {
                            slidesToShow: Math.min(cols, 3),
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
        });

        // Dynamic new today sliders
        $('.new-slick-slider').each(function() {
            var cols = parseInt($(this).data('cols')) || 5;
            $(this).slick({
                infinite: false,
                slidesToShow: cols,
                slidesToScroll: 2,
                prevArrow: $(this).siblings('.new-prev'),
                nextArrow: $(this).siblings('.new-next'),
                responsive: [
                    {
                        breakpoint: 1100,
                        settings: {
                            slidesToShow: Math.min(cols, 3),
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
        });

        // Dynamic collections sliders
        $('.collections-slick-slider').each(function() {
            var cols = parseInt($(this).data('cols')) || 3;
            $(this).slick({
                infinite: false,
                slidesToShow: cols,
                slidesToScroll: 1,
                prevArrow: $(this).siblings('.col-prev'),
                nextArrow: $(this).siblings('.col-next'),
                responsive: [
                    {
                        breakpoint: 1100,
                        settings: {
                            slidesToShow: Math.min(cols, 3),
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
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });

        // Dynamic reels sliders
        $('.reels-slick-slider').each(function() {
            var cols = parseInt($(this).data('cols')) || 5;
            $(this).slick({
                infinite: false,
                slidesToShow: cols,
                slidesToScroll: 2,
                prevArrow: $(this).siblings('.reels-prev'),
                nextArrow: $(this).siblings('.reels-next'),
                responsive: [
                    {
                        breakpoint: 1100,
                        settings: {
                            slidesToShow: Math.min(cols, 4),
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
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
        });

        // Dynamic custom collections sliders
        $('.custom-slick-slider').each(function() {
            var cols = parseInt($(this).data('cols')) || 4;
            $(this).slick({
                infinite: false,
                slidesToShow: cols,
                slidesToScroll: 2,
                prevArrow: $(this).siblings('.custom-prev'),
                nextArrow: $(this).siblings('.custom-next'),
                responsive: [
                    {
                        breakpoint: 1100,
                        settings: {
                            slidesToShow: Math.min(cols, 3),
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
        });
    });
</script>
@endsection

@section('styles')
<style>
    .colcard-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }
    
    
    /* Dynamic Grid Layout */
    .dynamic-grid {
        display: grid;
        grid-template-columns: repeat(var(--cols, 4), 1fr);
        gap: 24px;
        margin-top: 16px;
    }
    
    @media (max-width: 1199px) {
        .dynamic-grid {
            grid-template-columns: repeat(min(var(--cols, 4), 3), 1fr);
        }
    }
    
    @media (max-width: 767px) {
        .dynamic-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 16px;
        }
    }
</style>
@endsection
