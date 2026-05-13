<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background: #f4f4f4;
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        .content {
            padding: 20px;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.8em;
            color: #777;
            text-align: center;
        }
        .login-info {
            background: #eef;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #d9534f;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Chào mừng bạn đến với {{ get_setting('website_name') }}</h2>
        </div>
        <div class="content">
            <p>Xin chào {{ $array['name'] }},</p>
            <p>Tài khoản tổ chức của bạn đã được tạo thành công trên hệ thống của chúng tôi. Dưới đây là thông tin đăng nhập của bạn:</p>
            
            <div class="login-info">
                <p><strong>Email:</strong> {{ $array['email'] }}</p>
                <p><strong>Mật khẩu:</strong> {{ $array['password'] }}</p>
            </div>

            <p>Bạn có thể đăng nhập vào hệ thống tại đây:</p>
            <p><a href="{{ $array['link'] }}" class="btn">Đăng nhập ngay</a></p>

            <p>Vui lòng đổi mật khẩu sau khi đăng nhập lần đầu để đảm bảo an toàn.</p>
        </div>
        <div class="footer">
            <p>Trân trọng,<br>Đội ngũ {{ get_setting('website_name') }}</p>
        </div>
    </div>
</body>
</html>
