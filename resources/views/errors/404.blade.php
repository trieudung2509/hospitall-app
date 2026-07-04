@extends('frontend.layouts.app')

@section('title', '404 — Không Tìm Thấy Trang | BeeLink')

@section('content')
<main class="main" style="min-height: calc(100vh - var(--nav-h) - 180px); display: flex; align-items: center; justify-content: center; padding: 40px 24px;">
    <div style="text-align: center; max-width: 500px; width: 100%; animation: fadeInUp 0.6s ease both;">
        <div style="font-size: 120px; line-height: 1; font-weight: 800; background: linear-gradient(135deg, #F4C87A, #C9A96E); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 20px; filter: drop-shadow(0 4px 12px rgba(201, 169, 110, 0.15)); position: relative; display: inline-block;">
            404
            <span style="font-size: 40px; position: absolute; top: -10px; right: -30px; animation: hoverBee 3s ease-in-out infinite;">🐝</span>
        </div>
        <h1 style="font-size: 24px; font-weight: 700; color: var(--text1); margin-bottom: 12px;">Úi! Không tìm thấy trang</h1>
        <p style="font-size: 15px; color: var(--text2); line-height: 1.6; margin-bottom: 30px;">
            Đường dẫn bạn đang truy cập không tồn tại hoặc đã được chuyển sang địa chỉ khác. Cùng BeeLink tiếp tục khám phá phong cách thời trang nhé!
        </p>
        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
            <a href="/" style="display: inline-flex; align-items: center; justify-content: center; padding: 12px 28px; background: linear-gradient(135deg, #F4C87A, #E8A44A); color: white; font-weight: 600; font-size: 14.5px; border-radius: 30px; box-shadow: 0 4px 15px rgba(232, 164, 74, 0.3); transition: var(--t);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(232, 164, 74, 0.45)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 15px rgba(232, 164, 74, 0.3)';">
                Quay lại Trang Chủ
            </a>
        </div>
    </div>
</main>
@endsection

@section('styles')
<style>
    @keyframes hoverBee {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-8px) rotate(-10deg); }
    }
</style>
@endsection

