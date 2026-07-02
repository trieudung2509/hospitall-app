<!-- FOOTER -->
<footer class="footer">
    <div class="footer-logo">🐝 BeeLink</div>
    <div class="footer-copyright">&copy; {{ date('Y') }} BeeLink. Khám phá phong cách thời trang của bạn.</div>
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
