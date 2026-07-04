<!-- NAVBAR -->
<nav class="navbar">
    <div class="nb">
        <a href="/" class="logo" id="logo-link">
            @if(get_setting('header_logo') != null)
                <img src="{{ uploaded_asset(get_setting('header_logo')) }}" alt="{{ get_setting('site_name', 'BeeLink') }}" style="height: 38px; max-width: 150px; object-fit: contain;">
            @else
                <div class="logo-icon"><span class="logo-bee-emoji">🐝</span></div>
                <div class="logo-text">
                    <span class="logo-name">{{ get_setting('site_name', 'BeeLink') }}</span>
                    <span class="logo-tag">Khám phá phong cách của bạn</span>
                </div>
            @endif
        </a>
        <form action="{{ route('frontend.search') }}" method="GET" class="search-bar">
            <input type="search" name="search" id="main-search" placeholder="Tìm outfit, phong cách, vibe..." aria-label="Tìm kiếm" value="{{ request('search') }}">
            <span class="si" onclick="this.closest('form').submit();" style="cursor: pointer;">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            </span>
        </form>
        <div class="nav-actions">
            <!-- Search Toggle for Mobile -->
            <button class="ib mobile-search-toggle-btn" id="mobile-search-toggle" aria-label="Tìm kiếm">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            </button>
            <button class="ib" id="notif-btn" aria-label="Thông báo">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </button>
            <button class="ib" id="wish-btn" aria-label="Yêu thích">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </button>
            <div class="av" id="user-avatar" role="button" tabindex="0" aria-label="Hồ sơ">M</div>
        </div>
    </div>

    <!-- Dropdown Mobile Search bar -->
    <div class="mobile-search-dropdown" id="mobile-search-bar">
        <form action="{{ route('frontend.search') }}" method="GET" style="position: relative; width: 100%;">
            <input type="search" name="search" placeholder="Tìm outfit, phong cách, vibe..." value="{{ request('search') }}">
            <span class="si-mobile-click" onclick="this.closest('form').submit();">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            </span>
        </form>
    </div>
</nav>

<style>
    .logo-bee-emoji {
        display: inline-block;
        animation: hoverBee 3s ease-in-out infinite;
    }

    /* Desktop vs Mobile Header adjustments */
    .mobile-search-toggle-btn {
        display: none !important;
    }
    
    .mobile-search-dropdown {
        display: none;
        padding: 8px 16px;
        background: rgba(250, 249, 247, 0.98);
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        width: 100%;
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }
    
    .mobile-search-dropdown.show {
        display: block;
    }
    
    .mobile-search-dropdown input {
        width: 100%;
        height: 40px;
        background: #F0EDE8;
        border: 1.5px solid transparent;
        border-radius: 20px;
        padding: 0 40px 0 16px;
        font-size: 14.5px;
        color: var(--text1);
        outline: none;
        font-family: inherit;
        transition: var(--t);
    }
    
    .mobile-search-dropdown input:focus {
        background: var(--surface);
        border-color: var(--border);
        box-shadow: 0 0 0 3px rgba(201, 169, 110, 0.15);
    }
    
    .si-mobile-click {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        cursor: pointer;
    }

    @media(max-width: 768px) {
        .navbar {
            height: auto !important;
            min-height: 60px;
        }
        .nb {
            height: 60px !important;
            padding: 0 16px !important;
            gap: 12px !important;
        }
        .navbar .search-bar {
            display: none !important;
        }
        .mobile-search-toggle-btn {
            display: flex !important;
        }
        .logo-tag {
            display: none !important;
        }
        .logo-name {
            font-size: 16px !important;
        }
        .logo img {
            height: 30px !important;
        }
    }
    
    @media(max-width: 480px) {
        #wish-btn {
            display: none !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('mobile-search-toggle');
        const searchDropdown = document.getElementById('mobile-search-bar');
        
        if (toggleBtn && searchDropdown) {
            toggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                searchDropdown.classList.toggle('show');
                if (searchDropdown.classList.contains('show')) {
                    const input = searchDropdown.querySelector('input');
                    if (input) input.focus();
                }
            });
            
            // Close dropdown if clicking elsewhere
            document.addEventListener('click', function(e) {
                if (!searchDropdown.contains(e.target) && e.target !== toggleBtn && !toggleBtn.contains(e.target)) {
                    searchDropdown.classList.remove('show');
                }
            });
        }
    });
</script>

<!-- CATEGORY TABS -->
<div class="tabs-wrap">
    <div class="tabs" id="category-tabs" role="tablist">
        <div class="tab {{ request()->is('/') ? 'active' : '' }}" role="tab" id="tab-foryou" onclick="window.location.href='{{ route('home') }}'"><span class="tab-icon">✨</span><span>Dành cho bạn</span></div>
        <div class="tab {{ request()->is('trending') ? 'active' : '' }}" role="tab" id="tab-trending" onclick="window.location.href='{{ route('frontend.trending') }}'"><span class="tab-icon">🔥</span><span>Xu hướng</span></div>
        @if(get_setting('enable_video_reels', '1') === '1')
            <div class="tab {{ request()->is('reels') || request()->is('reels/*') ? 'active' : '' }}" role="tab" id="tab-reels" onclick="window.location.href='{{ route('frontend.reels.index') }}'"><span class="tab-icon">🎬</span><span>Video Reels</span></div>
        @endif
        
        @php
            $header_collections = \App\Collection::where('show_on_header', 1)->orderBy('created_at', 'asc')->get();
        @endphp
        @foreach($header_collections as $collection)
            <div class="tab {{ request()->is('collections/' . $collection->slug) ? 'active' : '' }}" role="tab" onclick="window.location.href='{{ route('collections.show', $collection->slug) }}'">
                <span class="tab-icon">{{ $collection->icon ?? '🎀' }}</span>
                <span>{{ $collection->title }}</span>
            </div>
        @endforeach

        <button class="tab-arrow" id="tabs-right" aria-label="Thêm danh mục">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</div>
