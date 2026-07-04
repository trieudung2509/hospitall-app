<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảo Trì Hệ Thống — BeeLink</title>
    
    <!-- Lexend Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #FAF9F7; --surface: #FFFFFF; --border: #EBEBEB;
            --text1: #1A1A1A; --text2: #6B6B6B; --muted: #9E9E9E;
            --accent: #C9A96E; --tag-bg: #F0EDE8; --tag-text: #6B5E4A;
            --t: 0.25s cubic-bezier(0.4,0,0.2,1);
        }
        body {
            font-family: 'Lexend', sans-serif;
            background: var(--bg);
            color: var(--text1);
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .container {
            text-align: center;
            max-width: 500px;
            width: 100%;
            padding: 40px 30px;
            background: var(--surface);
            border-radius: 20px;
            border: 1px solid var(--border);
            box-shadow: 0 8px 30px rgba(0,0,0,0.04);
            animation: fadeInUp 0.6s ease both;
        }
        .logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
            text-decoration: none;
            color: inherit;
        }
        .logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #F4C87A, #E8A44A);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        .logo-text {
            display: flex;
            flex-direction: column;
            text-align: left;
        }
        .logo-name {
            font-size: 20px;
            font-weight: 700;
            line-height: 1.1;
        }
        .logo-tag {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.3;
        }
        .maintenance-img {
            max-width: 200px;
            width: 100%;
            height: auto;
            margin: 0 auto 24px;
            display: block;
            animation: float 4s ease-in-out infinite;
        }
        h1 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--text1);
        }
        p {
            font-size: 14.5px;
            color: var(--text2);
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #FFF9EB;
            color: #D98C00;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid rgba(217, 140, 0, 0.15);
            margin-bottom: 20px;
        }
        .status-dot {
            width: 8px;
            height: 8px;
            background: #D98C00;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        @keyframes pulse {
            0% { transform: scale(0.9); opacity: 0.6; }
            50% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(0.9); opacity: 0.6; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <div class="logo-icon">🐝</div>
            <div class="logo-text">
                <span class="logo-name">BeeLink</span>
                <span class="logo-tag">Khám phá phong cách của bạn</span>
            </div>
        </div>
        
        <img src="{{ static_asset('assets/img/maintainance.svg') }}" class="maintenance-img" alt="Bảo trì">
        
        <div class="status-badge">
            <span class="status-dot"></span>
            Hệ thống đang bảo trì
        </div>
        
        <h1>Chúng tôi sẽ quay lại sớm!</h1>
        <p>
            BeeLink hiện đang thực hiện bảo trì hệ thống để cải thiện dịch vụ. Xin vui lòng quay lại sau ít phút. Cảm ơn sự thông cảm của bạn!
        </p>
    </div>
</body>
</html>

