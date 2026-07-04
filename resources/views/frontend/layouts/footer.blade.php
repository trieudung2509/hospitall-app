<!-- FOOTER -->
<footer class="footer" style="padding: 24px 16px; text-align: center; border-top: 1px solid var(--border); background: var(--surface); margin-top: auto;">
    <div class="footer-logo" style="font-size: 18px; font-weight: 800; color: var(--text1); display: flex; align-items: center; justify-content: center; gap: 8px; font-family: 'Lexend', sans-serif;">
        @if(get_setting('footer_logo') != null)
            <img src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ get_setting('site_name', 'BeeLink') }}" style="height: 32px; max-width: 120px; object-fit: contain;">
        @else
            <span>🐝</span> {{ get_setting('site_name', 'BeeLink') }}
        @endif
    </div>
    
    @if(get_setting('show_social_links') == 'on')
        <div class="footer-social-links" style="display: flex; align-items: center; justify-content: center; gap: 16px; margin: 16px 0;">
            @if(get_setting('facebook_link'))
                <a href="{{ get_setting('facebook_link') }}" target="_blank" class="social-icon-btn facebook" style="width: 36px; height: 36px; background: #eef2ff; color: #3b5998; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease; border: 1px solid rgba(59, 89, 152, 0.15);" onmouseover="this.style.background='#3b5998'; this.style.color='#fff';" onmouseout="this.style.background='#eef2ff'; this.style.color='#3b5998';">
                    <svg fill="currentColor" viewBox="0 0 24 24" style="width: 18px; height: 18px;"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1V12h3v3h-3v6.8c4.56-.93 8-4.96 8-9.8z"/></svg>
                </a>
            @endif
            @if(get_setting('instagram_link'))
                <a href="{{ get_setting('instagram_link') }}" target="_blank" class="social-icon-btn instagram" style="width: 36px; height: 36px; background: #fff1f2; color: #e1306c; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease; border: 1px solid rgba(225, 48, 108, 0.15);" onmouseover="this.style.background='#e1306c'; this.style.color='#fff';" onmouseout="this.style.background='#fff1f2'; this.style.color='#e1306c';">
                    <svg fill="currentColor" viewBox="0 0 24 24" style="width: 18px; height: 18px;"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
            @endif
            @if(get_setting('twitter_link'))
                <a href="{{ get_setting('twitter_link') }}" target="_blank" class="social-icon-btn twitter" style="width: 36px; height: 36px; background: #f0f9ff; color: #1da1f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease; border: 1px solid rgba(29, 161, 242, 0.15);" onmouseover="this.style.background='#1da1f2'; this.style.color='#fff';" onmouseout="this.style.background='#f0f9ff'; this.style.color='#1da1f2';">
                    <svg fill="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                </a>
            @endif
            @if(get_setting('youtube_link'))
                <a href="{{ get_setting('youtube_link') }}" target="_blank" class="social-icon-btn youtube" style="width: 36px; height: 36px; background: #fff5f5; color: #ff0000; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease; border: 1px solid rgba(255, 0, 0, 0.15);" onmouseover="this.style.background='#ff0000'; this.style.color='#fff';" onmouseout="this.style.background='#fff5f5'; this.style.color='#ff0000';">
                    <svg fill="currentColor" viewBox="0 0 24 24" style="width: 18px; height: 18px;"><path d="M23.498 6.163a3.003 3.003 0 00-2.11-2.107C19.537 3.5 12 3.5 12 3.5s-7.537 0-9.388.556a3.003 3.003 0 00-2.11 2.107C0 8.017 0 12 0 12s0 3.983.502 5.837a3.003 3.003 0 002.11 2.107C4.463 20.5 12 20.5 12 20.5s7.537 0 9.388-.556a3.003 3.003 0 002.11-2.107C24 15.983 24 12 24 12s0-3.983-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
            @endif
        </div>
    @endif

    <div class="footer-links" style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin: 12px 0 16px; font-size: 13.5px; font-family: 'Lexend', sans-serif;">
        <a href="{{ route('about') }}" style="color: var(--text2); text-decoration: none; font-weight: 600; transition: color 0.2s;" onmouseover="this.style.color='var(--accent)';" onmouseout="this.style.color='var(--text2)';">Về BeeLink</a>
        <a href="{{ route('privacy') }}" style="color: var(--text2); text-decoration: none; font-weight: 600; transition: color 0.2s;" onmouseover="this.style.color='var(--accent)';" onmouseout="this.style.color='var(--text2)';">Chính sách bảo mật</a>
        <a href="{{ route('affiliate') }}" style="color: var(--text2); text-decoration: none; font-weight: 600; transition: color 0.2s;" onmouseover="this.style.color='var(--accent)';" onmouseout="this.style.color='var(--text2)';">Hợp tác Affiliate</a>
    </div>

    <div class="footer-copyright" style="font-size: 13px; color: var(--muted); margin-top: 8px;">&copy; {{ date('Y') }} {{ get_setting('site_name', 'BeeLink') }}. Khám phá phong cách thời trang của bạn.</div>
</footer>

<script>
    // TAB SWITCHING
    document.querySelectorAll('.tab').forEach(t => {
        t.addEventListener('click', function() {
            document.querySelectorAll('.tab').forEach(x => x.classList.remove('active'));
            this.classList.add('active');
        });
    });
    const tabsRight = document.getElementById('tabs-right');
    if (tabsRight) {
        tabsRight.addEventListener('click', () => {
            document.getElementById('category-tabs').scrollBy({left:200,behavior:'smooth'});
        });
    }

    // SCROLL BUTTONS
    const newRight = document.getElementById('new-right');
    if (newRight) {
        newRight.addEventListener('click', () => {
            document.getElementById('new-scroll').scrollBy({left:320,behavior:'smooth'});
        });
    }
    const reelsRight = document.getElementById('reels-right');
    if (reelsRight) {
        reelsRight.addEventListener('click', () => {
            document.getElementById('reels-scroll').scrollBy({left:340,behavior:'smooth'});
        });
    }

    // BOOKMARK TOGGLE
    document.querySelectorAll('.cbm, .sbm').forEach(btn => {
        btn.addEventListener('click', e => {
            e.stopPropagation();
            const saved = btn.dataset.saved === '1';
            btn.dataset.saved = saved ? '0' : '1';
            btn.style.color = saved ? '' : '#C9A96E';
        });
    });

    // KEYBOARD NAV
    document.querySelectorAll('[tabindex="0"]').forEach(el => {
        el.addEventListener('keydown', e => {
            if(e.key==='Enter'||e.key===' '){e.preventDefault();el.click();}
        });
    });

    // SMOOTH IMAGE FADE IN
    document.querySelectorAll('img').forEach(img => {
        img.style.opacity='0';
        img.style.transition='opacity 0.4s ease';
        const show=()=>{img.style.opacity='1';};
        if(img.complete) show();
        else img.addEventListener('load', show);
    });
</script>
