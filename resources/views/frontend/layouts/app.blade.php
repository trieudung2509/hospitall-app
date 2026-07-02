<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BeeLink - Khám phá phong cách thời trang của bạn. Tìm kiếm outfits trending, collections và video reels thời trang mỗi ngày.">
    <title>@yield('title', 'BeeLink — Khám Phá Phong Cách Của Bạn')</title>
    
    <!-- Lexend Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #FAF9F7; --surface: #FFFFFF; --border: #EBEBEB;
            --text1: #1A1A1A; --text2: #6B6B6B; --muted: #9E9E9E;
            --accent: #C9A96E; --tag-bg: #F0EDE8; --tag-text: #6B5E4A;
            --nav-h: 64px; --r-sm: 10px; --r-md: 14px; --r-lg: 18px;
            --shadow: 0 2px 12px rgba(0,0,0,0.07);
            --shadow-h: 0 8px 28px rgba(0,0,0,0.13);
            --t: 0.25s cubic-bezier(0.4,0,0.2,1);
        }
        html { font-size:16px; scroll-behavior:smooth; }
        body { font-family:'Lexend',sans-serif; background:var(--bg); color:var(--text1); -webkit-font-smoothing:antialiased; overflow-x:hidden; }
        img { display:block; max-width:100%; }
        a { text-decoration:none; color:inherit; }
        button { cursor:pointer; border:none; background:none; font-family:inherit; }
        ::-webkit-scrollbar { width:5px; height:5px; }
        ::-webkit-scrollbar-thumb { background:#D5CEC4; border-radius:10px; }

        /* NAVBAR */
        .navbar { position:sticky; top:0; z-index:100; background:rgba(250,249,247,0.92); backdrop-filter:blur(14px); border-bottom:1px solid var(--border); height:var(--nav-h); }
        .nb { display:flex; align-items:center; gap:20px; max-width:1280px; margin:0 auto; padding:0 24px; height:100%; }
        .logo { display:flex; align-items:center; gap:10px; flex-shrink:0; }
        .logo-icon { width:34px; height:34px; background:linear-gradient(135deg,#F4C87A,#E8A44A); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:18px; }
        .logo-text { display:flex; flex-direction:column; }
        .logo-name { font-size:15px; font-weight:700; line-height:1; }
        .logo-tag { font-size:10px; color:var(--muted); line-height:1.3; }
        .search-bar { flex:1; max-width:380px; position:relative; }
        .search-bar input { width:100%; height:38px; background:#F0EDE8; border:1.5px solid transparent; border-radius:20px; padding:0 40px 0 16px; font-size:13.5px; color:var(--text1); outline:none; transition:var(--t); font-family:inherit; }
        .search-bar input::placeholder { color:var(--muted); }
        .search-bar input:focus { background:var(--surface); border-color:var(--border); box-shadow:0 0 0 3px rgba(201, 169, 110, 0.15); }
        .si { position:absolute; right:13px; top:50%; transform:translateY(-50%); color:var(--muted); pointer-events:none; }
        .nav-actions { display:flex; align-items:center; gap:6px; margin-left:auto; }
        .ib { width:38px; height:38px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--text2); transition:var(--t); }
        .ib:hover { background:var(--tag-bg); color:var(--text1); }
        .ib svg { width:20px; height:20px; }
        .av { width:34px; height:34px; border-radius:50%; cursor:pointer; border:2px solid var(--border); transition:var(--t); display:flex; align-items:center; justify-content:center; background:linear-gradient(135deg,#E8D5B7,#C9A96E); font-size:13px; font-weight:600; color:white; }
        .av:hover { border-color:var(--accent); }

        /* CATEGORY TABS */
        .tabs-wrap { background:var(--bg); border-bottom:1px solid var(--border); position:sticky; top:var(--nav-h); z-index:90; }
        .tabs { display:flex; align-items:center; max-width:1280px; margin:0 auto; padding:0 16px; overflow-x:auto; scrollbar-width:none; }
        .tabs::-webkit-scrollbar { display:none; }
        .tab { display:flex; flex-direction:column; align-items:center; gap:5px; padding:12px 16px; font-size:12px; color:var(--muted); cursor:pointer; transition:var(--t); border-bottom:2px solid transparent; white-space:nowrap; flex-shrink:0; font-weight:500; }
        .tab:hover { color:var(--text1); }
        .tab.active { color:var(--accent); border-bottom-color:var(--accent); font-weight:600; }
        .tab-icon { font-size:20px; line-height:1; }
        .tab-arrow { width:32px; height:32px; border-radius:50%; background:var(--surface); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; cursor:pointer; flex-shrink:0; margin-left:4px; transition:var(--t); box-shadow:var(--shadow); }
        .tab-arrow:hover { background:var(--tag-bg); }

        /* MAIN */
        .main { max-width:1280px; margin:0 auto; padding:28px 24px 60px; }

        /* SECTION HEADER */
        .sh { display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:16px; }
        .st h2 { font-size:18px; font-weight:700; display:flex; align-items:center; gap:8px; }
        .st p { font-size:12.5px; color:var(--muted); margin-top:3px; }
        .va { display:flex; align-items:center; gap:4px; font-size:12.5px; font-weight:500; color:var(--text2); transition:var(--t); }
        .va:hover { color:var(--accent); }
        .va svg { width:14px; height:14px; }
        section { margin-bottom:40px; }

        /* TRENDING CARDS */
        .tgrid { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; }
        .ocard { border-radius:var(--r-lg); overflow:hidden; position:relative; cursor:pointer; background:#E8E0D4; transition:var(--t); box-shadow:var(--shadow); }
        .ocard:hover { transform:translateY(-3px); box-shadow:var(--shadow-h); }
        .ocard-img-wrap { aspect-ratio:3/4; overflow:hidden; }
        .ocard-img { width:100%; height:100%; object-fit:cover; transition:transform 0.4s ease; }
        .ocard:hover .ocard-img { transform:scale(1.04); }
        .play-btn { position:absolute; top:12px; right:12px; width:30px; height:30px; border-radius:50%; background:rgba(255,255,255,0.85); backdrop-filter:blur(4px); display:flex; align-items:center; justify-content:center; transition:var(--t); }
        .play-btn svg { width:13px; height:13px; fill:var(--text1); margin-left:2px; }
        .play-btn:hover { background:#fff; transform:scale(1.1); }
        .cbottom { padding:10px 12px; background:var(--surface); }
        .ctitle { font-size:13px; font-weight:600; margin-bottom:5px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .cmeta { display:flex; align-items:center; justify-content:space-between; }
        .ctags { display:flex; gap:4px; overflow:hidden; }
        .tag { font-size:10.5px; color:var(--tag-text); background:var(--tag-bg); padding:2px 7px; border-radius:20px; white-space:nowrap; }
        .csaves { display:flex; align-items:center; gap:4px; font-size:11.5px; color:var(--muted); font-weight:500; flex-shrink:0; }
        .csaves svg { width:12px; height:12px; }
        .cbm { position:absolute; bottom:60px; right:12px; width:28px; height:28px; background:rgba(255,255,255,0.85); backdrop-filter:blur(4px); border-radius:50%; display:flex; align-items:center; justify-content:center; opacity:0; transition:var(--t); }
        .ocard:hover .cbm { opacity:1; }
        .cbm svg { width:13px; height:13px; }

        /* SMALL CARDS */
        .scroll-wrap { position:relative; }
        .scroll-x { display:flex; gap:12px; overflow-x:auto; scrollbar-width:none; padding-bottom:4px; scroll-snap-type:x mandatory; }
        .scroll-x::-webkit-scrollbar { display:none; }
        .scard { flex-shrink:0; width:148px; border-radius:var(--r-md); overflow:hidden; position:relative; cursor:pointer; background:#E8E0D4; transition:var(--t); box-shadow:var(--shadow); scroll-snap-align:start; }
        .scard:hover { transform:translateY(-3px); box-shadow:var(--shadow-h); }
        .scard-img-wrap { aspect-ratio:3/4; overflow:hidden; }
        .scard-img { width:100%; height:100%; object-fit:cover; transition:transform 0.4s ease; }
        .scard:hover .scard-img { transform:scale(1.05); }
        .sbottom { padding:8px 10px; background:var(--surface); }
        .stitle { font-size:12px; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-bottom:3px; }
        .smeta { display:flex; align-items:center; justify-content:space-between; }
        .ssaves { font-size:11px; color:var(--muted); font-weight:500; }
        .sbm { color:var(--muted); }
        .sbm svg { width:13px; height:13px; }
        .scroll-btn { position:absolute; top:50%; transform:translateY(calc(-50% - 22px)); width:36px; height:36px; border-radius:50%; background:var(--surface); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; cursor:pointer; z-index:10; box-shadow:var(--shadow-h); transition:var(--t); }
        .scroll-btn:hover { background:var(--text1); border-color:var(--text1); color:white; }
        .scroll-btn svg { width:16px; height:16px; }
        .sbr { right:-4px; }
        .sbl { left:-4px; }
        .slick-slide { outline: none; margin: 0 6px; }
        .slick-list { margin: 0 -6px; }

        /* COLLECTIONS */
        .cgrid { display:grid; grid-template-columns:repeat(5,1fr); gap:12px; }
        .colcard { border-radius:var(--r-md); overflow:hidden; position:relative; cursor:pointer; aspect-ratio:3/4; transition:var(--t); box-shadow:var(--shadow); }
        .colcard:hover { transform:translateY(-3px); box-shadow:var(--shadow-h); }
        .colcard-img { width:100%; height:100%; object-fit:cover; transition:transform 0.4s ease; }
        .colcard:hover .colcard-img { transform:scale(1.05); }
        .col-ov { position:absolute; inset:0; background:linear-gradient(to top,rgba(0,0,0,0.65) 0%,rgba(0,0,0,0.1) 50%,transparent 100%); }
        .col-info { position:absolute; bottom:0; left:0; right:0; padding:14px 13px; color:white; }
        .col-name { font-size:13.5px; font-weight:700; line-height:1.3; margin-bottom:3px; }
        .col-count { font-size:11px; opacity:0.8; }

        /* REELS */
        .rscroll { display:flex; gap:12px; overflow-x:auto; scrollbar-width:none; padding-bottom:4px; }
        .rscroll::-webkit-scrollbar { display:none; }
        .rcard { flex-shrink:0; width:160px; border-radius:var(--r-md); overflow:hidden; position:relative; cursor:pointer; background:#1A1A1A; transition:var(--t); box-shadow:var(--shadow); }
        .rcard:hover { transform:translateY(-3px); box-shadow:var(--shadow-h); }
        .rcard-img-wrap { aspect-ratio:9/16; overflow:hidden; }
        .rcard-img { width:100%; height:100%; object-fit:cover; opacity:0.88; transition:transform 0.4s ease; }
        .rcard:hover .rcard-img { transform:scale(1.04); opacity:1; }
        .rov { position:absolute; inset:0; background:linear-gradient(to top,rgba(0,0,0,0.7) 0%,transparent 55%); }
        .rplay { position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:36px; height:36px; border-radius:50%; background:rgba(255,255,255,0.2); backdrop-filter:blur(4px); border:1.5px solid rgba(255,255,255,0.4); display:flex; align-items:center; justify-content:center; transition:var(--t); }
        .rcard:hover .rplay { background:rgba(255,255,255,0.3); transform:translate(-50%,-50%) scale(1.1); }
        .rplay svg { width:14px; height:14px; fill:white; margin-left:2px; }
        .rinfo { position:absolute; bottom:0; left:0; right:0; padding:12px 10px; color:white; }
        .rtitle { font-size:12px; font-weight:600; line-height:1.35; margin-bottom:5px; }
        .rstats { display:flex; align-items:center; gap:6px; font-size:10.5px; opacity:0.75; }
        .rstats svg { width:11px; height:11px; }

        /* FOOTER */
        .footer { background: #FAF9F7; border-top: 1px solid var(--border); padding: 40px 24px; text-align: center; margin-top: 40px; }
        .footer-logo { font-size: 20px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 12px; }
        .footer-copyright { font-size: 13px; color: var(--muted); }

        @keyframes fadeInUp { from{opacity:0;transform:translateY(18px)} to{opacity:1;transform:translateY(0)} }
        section { animation:fadeInUp 0.5s ease both; }
        section:nth-child(1){animation-delay:0.05s}
        section:nth-child(2){animation-delay:0.12s}
        section:nth-child(3){animation-delay:0.19s}
        section:nth-child(4){animation-delay:0.26s}

        @media(max-width:1100px){ .tgrid{grid-template-columns:repeat(3,1fr)} .cgrid{grid-template-columns:repeat(4,1fr)} }
        @media(max-width:768px){ .nb{padding:0 16px;gap:12px} .main{padding:20px 16px 60px} .tgrid{grid-template-columns:repeat(2,1fr);gap:10px} .cgrid{grid-template-columns:repeat(3,1fr)} .search-bar{max-width:220px} .logo-tag{display:none} }
        @media(max-width:480px){ .tgrid{grid-template-columns:repeat(2,1fr);gap:8px} .cgrid{grid-template-columns:repeat(2,1fr)} }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Header Include -->
    @include('frontend.layouts.header')

    <!-- Main Content Yield -->
    @yield('content')

    <!-- jQuery and Slick Carousel JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Footer Include -->
    @include('frontend.layouts.footer')

    @yield('scripts')
</body>
</html>
