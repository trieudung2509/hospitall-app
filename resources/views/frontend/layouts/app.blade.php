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
            --nav-h: 72px; --r-sm: 10px; --r-md: 14px; --r-lg: 18px;
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
        .logo { display:flex; align-items:center; gap:10px; flex: 1 0 0; }
        .logo-icon { width:40px; height:40px; background:linear-gradient(135deg,#F4C87A,#E8A44A); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:22px; }
        .logo-text { display:flex; flex-direction:column; }
        .logo-name { font-size:18px; font-weight:700; line-height:1.1; }
        .logo-tag { font-size:11px; color:var(--muted); line-height:1.3; }
        .search-bar { flex: 0 1 460px; margin: 0 20px; position:relative; }
        .search-bar input { width:100%; height:42px; background:#F0EDE8; border:1.5px solid transparent; border-radius:22px; padding:0 44px 0 18px; font-size:14.5px; color:var(--text1); outline:none; transition:var(--t); font-family:inherit; }
        .search-bar input::placeholder { color:var(--muted); }
        .search-bar input:focus { background:var(--surface); border-color:var(--border); box-shadow:0 0 0 3px rgba(201, 169, 110, 0.15); }
        .si { position:absolute; right:16px; top:50%; transform:translateY(-50%); color:var(--muted); pointer-events:none; }
        .nav-actions { display:flex; align-items:center; gap:6px; flex: 1 0 0; justify-content: flex-end; }
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
        @media(max-width:768px){ 
            .nb{padding:0 16px;gap:12px} 
            .main{padding:20px 16px 60px} 
            .tgrid{grid-template-columns:repeat(2,1fr);gap:10px} 
            .cgrid{grid-template-columns:repeat(3,1fr)} 
            .logo{flex: initial;}
            .search-bar{flex: 1; max-width:220px; margin: 0;} 
            .nav-actions{flex: initial; margin-left: auto;}
            .logo-tag{display:none} 
        }
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

    <!-- AI Stylist Chatbot UI -->
    <div id="bee-chatbot-trigger" aria-label="Mở Trợ lý thời trang AI" role="button" tabindex="0">
        <span class="trigger-icon">🐝</span>
        <span class="trigger-text">Stylist AI</span>
    </div>

    <div id="bee-chatbot-container">
        <div class="chat-header">
            <div class="header-info">
                <div class="logo-circle">🐝</div>
                <div class="header-text">
                    <span class="header-name">Stylist AI</span>
                    <span class="header-status"><span class="status-dot"></span>Đang trực tuyến</span>
                </div>
            </div>
            <button class="chat-close" aria-label="Đóng Chatbox">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        
        <div id="bee-chatbot-messages">
            <div class="msg-bubble bot">
                <div class="msg-text">Chào bạn thân mến! 🐝 Mình là Trợ lý Stylist của BeeLink. Bạn cần mình tư vấn phối đồ hay tìm kiếm outfit cho dịp gì hôm nay thế? 💖</div>
            </div>
        </div>

        <div class="chat-suggestions">
            <button class="sug-pill" data-query="Tìm outfit đi biển">🌴 Đi biển</button>
            <button class="sug-pill" data-query="Outfit phối với áo thun">👕 Áo thun</button>
            <button class="sug-pill" data-query="Phối đồ đi chơi cafe">☕ Đi cafe</button>
            <button class="sug-pill" data-query="Outfit Hàn Quốc">🎀 Style Hàn</button>
        </div>

        <div class="chat-input-area">
            <input type="text" id="bee-chatbot-input" placeholder="Hỏi stylist phối đồ, đi chơi..." autocomplete="off">
            <button id="bee-chatbot-send" aria-label="Gửi tin nhắn">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>
    </div>

    <style>
        /* Chatbot CSS styling */
        #bee-chatbot-trigger {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 9999;
            background: linear-gradient(135deg, #F4C87A, #E8A44A);
            color: white;
            padding: 12px 20px;
            border-radius: 30px;
            box-shadow: 0 4px 20px rgba(232, 164, 74, 0.4);
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            user-select: none;
        }
        #bee-chatbot-trigger:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 6px 24px rgba(232, 164, 74, 0.55);
        }
        #bee-chatbot-trigger .trigger-icon {
            font-size: 20px;
            display: inline-block;
            animation: hoverBee 3s ease-in-out infinite;
        }
        #bee-chatbot-container {
            position: fixed;
            bottom: 90px;
            right: 24px;
            width: 380px;
            height: 550px;
            z-index: 9999;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
            display: none;
            flex-direction: column;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #bee-chatbot-container.open {
            display: flex;
            animation: slideInChat 0.3s cubic-bezier(0.4, 0, 0.2, 1) both;
        }
        .chat-header {
            background: linear-gradient(135deg, #F4C87A, #E8A44A);
            color: white;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .header-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo-circle {
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .header-text {
            display: flex;
            flex-direction: column;
        }
        .header-name {
            font-weight: 700;
            font-size: 15px;
        }
        .header-status {
            font-size: 11px;
            opacity: 0.9;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .status-dot {
            width: 6px;
            height: 6px;
            background: #4CAF50;
            border-radius: 50%;
            display: inline-block;
            animation: pulse 1.5s infinite;
        }
        .chat-close {
            color: white;
            opacity: 0.8;
            transition: var(--t);
            padding: 4px;
            border-radius: 50%;
        }
        .chat-close:hover {
            opacity: 1;
            background: rgba(255, 255, 255, 0.1);
        }
        #bee-chatbot-messages {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .msg-bubble {
            max-width: 80%;
            padding: 10px 14px;
            border-radius: 16px;
            font-size: 13.5px;
            line-height: 1.5;
            word-break: break-word;
        }
        .msg-bubble.user {
            align-self: flex-end;
            background: #E8A44A;
            color: white;
            border-bottom-right-radius: 4px;
        }
        .msg-bubble.bot {
            align-self: flex-start;
            background: #F0EDE8;
            color: var(--text1);
            border-bottom-left-radius: 4px;
        }
        .chat-suggestions {
            display: flex;
            gap: 6px;
            padding: 10px 16px;
            overflow-x: auto;
            scrollbar-width: none;
            background: rgba(250, 249, 247, 0.5);
            border-top: 1px solid var(--border);
        }
        .chat-suggestions::-webkit-scrollbar {
            display: none;
        }
        .sug-pill {
            flex-shrink: 0;
            background: var(--surface);
            border: 1px solid var(--border);
            color: var(--text2);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            transition: var(--t);
        }
        .sug-pill:hover {
            background: var(--tag-bg);
            color: var(--tag-text);
            border-color: var(--tag-bg);
        }
        .chat-input-area {
            padding: 12px 16px;
            background: var(--surface);
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        #bee-chatbot-input {
            flex: 1;
            height: 38px;
            border: 1.5px solid var(--border);
            border-radius: 20px;
            padding: 0 16px;
            font-size: 13.5px;
            outline: none;
            transition: var(--t);
            font-family: inherit;
        }
        #bee-chatbot-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(201, 169, 110, 0.1);
        }
        #bee-chatbot-send {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #F4C87A, #E8A44A);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--t);
            flex-shrink: 0;
        }
        #bee-chatbot-send:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 8px rgba(232, 164, 74, 0.3);
        }

        /* Carousel inside chat */
        .chat-reels-carousel {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding: 4px 0 8px;
            margin-top: 8px;
            width: 100%;
            scrollbar-width: thin;
        }
        .chat-reels-carousel::-webkit-scrollbar {
            height: 4px;
        }
        .chat-reels-carousel::-webkit-scrollbar-thumb {
            background: #D5CEC4;
            border-radius: 4px;
        }
        .chat-card {
            flex-shrink: 0;
            width: 165px;
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            scroll-snap-align: start;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            display: flex;
            flex-direction: column;
        }
        .chat-card-img-wrap {
            aspect-ratio: 3/4;
            overflow: hidden;
            background: #E8E0D4;
        }
        .chat-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .chat-card-info {
            padding: 6px 8px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }
        .chat-card-title {
            font-size: 11px;
            font-weight: 600;
            color: var(--text1);
            line-height: 1.3;
            height: 2.6em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .chat-card-btn {
            display: block;
            text-align: center;
            background: var(--tag-bg);
            color: var(--tag-text);
            font-size: 10.5px;
            font-weight: 600;
            padding: 4px 0;
            border-radius: 6px;
            margin-top: auto;
            transition: var(--t);
        }
        .chat-card-btn:hover {
            background: var(--accent);
            color: white;
        }

        .typing-indicator {
            display: flex;
            gap: 4px;
            padding: 8px 12px;
            align-self: flex-start;
        }
        .typing-dot {
            width: 6px;
            height: 6px;
            background: var(--muted);
            border-radius: 50%;
            animation: typingBounce 1.4s infinite both;
        }
        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }

        @keyframes typingBounce {
            0%, 80%, 100% { transform: scale(0.6); opacity: 0.5; }
            40% { transform: scale(1); opacity: 1; }
        }
        @keyframes slideInChat {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes hoverBee {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-3px) rotate(-5deg); }
        }

        /* Mobile Adjustments */
        @media (max-width: 767px) {
            #bee-chatbot-trigger {
                bottom: 16px;
                right: 16px;
                padding: 10px 16px;
                font-size: 13px;
            }
            #bee-chatbot-container {
                bottom: 0 !important;
                right: 0 !important;
                width: 100% !important;
                height: 100% !important;
                max-height: 100% !important;
                border-radius: 0 !important;
                border: none !important;
                z-index: 100000;
            }
            .chat-header {
                padding: 14px 16px;
            }
            #bee-chatbot-messages {
                padding: 16px;
            }
        }
    </style>

    <script>
        $(document).ready(function() {
            let chatHistory = [];
            const $trigger = $('#bee-chatbot-trigger');
            const $container = $('#bee-chatbot-container');
            const $closeBtn = $('.chat-close');
            const $messages = $('#bee-chatbot-messages');
            const $input = $('#bee-chatbot-input');
            const $sendBtn = $('#bee-chatbot-send');

            // Toggle chat container
            $trigger.on('click', function() {
                $container.addClass('open');
                $trigger.fadeOut(200);
                $input.focus();
                scrollChatToBottom();
            });

            $closeBtn.on('click', function(e) {
                e.stopPropagation();
                $container.removeClass('open');
                $trigger.fadeIn(200);
            });

            // Handle suggestion pill clicks
            $('.sug-pill').on('click', function() {
                const query = $(this).data('query');
                $input.val(query);
                sendMessage();
            });

            // Send message on Enter or button click
            $input.on('keypress', function(e) {
                if (e.which === 13) {
                    sendMessage();
                }
            });

            $sendBtn.on('click', function() {
                sendMessage();
            });

            function scrollChatToBottom() {
                $messages.animate({ scrollTop: $messages[0].scrollHeight }, 300);
            }

            function sendMessage() {
                const text = $input.val().trim();
                if (!text) return;

                // Render User bubble
                $messages.append(`
                    <div class="msg-bubble user">
                        <div class="msg-text">${escapeHtml(text)}</div>
                    </div>
                `);
                
                $input.val('');
                scrollChatToBottom();

                // Append typing indicator
                const $typingIndicator = $(`
                    <div class="typing-indicator" id="bee-chatbot-typing">
                        <span class="typing-dot"></span>
                        <span class="typing-dot"></span>
                        <span class="typing-dot"></span>
                    </div>
                `);
                $messages.append($typingIndicator);
                scrollChatToBottom();

                // Call Chatbot API
                $.ajax({
                    url: '{{ route("chatbot.chat") }}',
                    method: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: JSON.stringify({
                        message: text,
                        history: chatHistory
                    }),
                    success: function(response) {
                        $('#bee-chatbot-typing').remove();
                        
                        if (response.success) {
                            // Render bot response bubble
                            $messages.append(`
                                <div class="msg-bubble bot">
                                    <div class="msg-text">${response.reply}</div>
                                </div>
                            `);

                            // Append Recommended Outfits if available
                            if (response.outfits && response.outfits.length > 0) {
                                let cardsHtml = `<div class="chat-reels-carousel">`;
                                response.outfits.forEach(outfit => {
                                    let itemsHtml = '';
                                    if (outfit.items && outfit.items.length > 0) {
                                        itemsHtml = `<div class="chat-card-products" style="margin-top: 6px; padding-top: 6px; border-top: 1px dashed var(--border); display: flex; flex-direction: column; gap: 4px;">`;
                                        outfit.items.slice(0, 2).forEach(item => {
                                            itemsHtml += `
                                                <div style="font-size: 10px; font-weight: 700; color: var(--text1); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 2px;" title="${item.name}">${escapeHtml(item.name)}</div>
                                                <div style="display: flex; gap: 4px; flex-wrap: wrap; margin-bottom: 4px;">
                                                    ${item.shopee_url ? `<a href="${item.shopee_url}" target="_blank" style="background:#FFF5F2; color:#EE4D2D; border: 1px solid rgba(238,77,45,0.15); font-size: 9px; font-weight: 700; padding: 2px 6px; border-radius: 4px; text-decoration:none; display:inline-flex; align-items:center; gap:2px; flex-grow: 1; justify-content: center;">🍊 Shopee ${item.shopee_price ? `<span style="font-size:8px; font-weight:600; opacity:0.85;">(${item.shopee_price})</span>` : ''}</a>` : ''}
                                                    ${item.tiktok_url ? `<a href="${item.tiktok_url}" target="_blank" style="background:#F8F8F8; color:#010101; border: 1px solid rgba(0,0,0,0.08); font-size: 9px; font-weight: 700; padding: 2px 6px; border-radius: 4px; text-decoration:none; display:inline-flex; align-items:center; gap:2px; flex-grow: 1; justify-content: center;">🎬 TikTok ${item.tiktok_price ? `<span style="font-size:8px; font-weight:600; opacity:0.85;">(${item.tiktok_price})</span>` : ''}</a>` : ''}
                                                </div>
                                            `;
                                        });
                                        if (outfit.items.length > 2) {
                                            itemsHtml += `<div style="font-size: 9.5px; color: var(--muted); text-align: center; font-weight: 500;">+ ${outfit.items.length - 2} món khác</div>`;
                                        }
                                        itemsHtml += `</div>`;
                                    }

                                    cardsHtml += `
                                        <div class="chat-card">
                                            <a href="${outfit.url}" class="chat-card-img-wrap">
                                                <img src="${outfit.cover_image}" alt="${outfit.title}" class="chat-card-img">
                                            </a>
                                            <div class="chat-card-info">
                                                <div class="chat-card-title">${escapeHtml(outfit.title)}</div>
                                                ${itemsHtml}
                                                <a href="${outfit.url}" class="chat-card-btn" style="margin-top: 8px;">Xem outfit</a>
                                            </div>
                                        </div>
                                    `;
                                });
                                cardsHtml += `</div>`;
                                $messages.append(cardsHtml);
                            }

                            scrollChatToBottom();

                            // Maintain chat history (limit to last 10 messages for performance)
                            chatHistory.push({ sender: 'user', text: text });
                            chatHistory.push({ sender: 'bot', text: response.reply });
                            if (chatHistory.length > 10) {
                                chatHistory = chatHistory.slice(-10);
                            }
                        } else {
                            renderErrorReply();
                        }
                    },
                    error: function() {
                        $('#bee-chatbot-typing').remove();
                        renderErrorReply();
                    }
                });
            }

            function renderErrorReply() {
                $messages.append(`
                    <div class="msg-bubble bot">
                        <div class="msg-text">Rất tiếc, đã xảy ra sự cố kết nối. Bạn thử lại nhé! 🥺</div>
                    </div>
                `);
                scrollChatToBottom();
            }

            function escapeHtml(text) {
                return text
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }
        });
    </script>
</body>
</html>
