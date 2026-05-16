@extends('frontend.layouts.app')

@section('content')

<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-left">
                <h3>{{ translate('Đăng ký tài khoản') }}</h3>
                <p class="page-breadcrumb">
                    <a href="{{ route('home') }}">{{ translate('Trang chủ') }}</a> / {{ translate('Đăng ký') }}
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section-content-block">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="registration-form-area theme-custom-box-shadow">
                    <div class="section-heading-wrapper">
                        <h2 class="section-heading">{{ translate('Tham gia cùng chúng tôi') }}</h2>
                        <p>{{ translate('Tạo tài khoản để theo dõi và quản lý các hoạt động hiến máu của bạn.') }}</p>
                    </div>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ translate('Họ và tên') }}</label>
                            <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">{{ translate('Địa chỉ Email') }}</label>
                            <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">{{ translate('Mật khẩu') }}</label>
                            <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ translate('Xác nhận mật khẩu') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="form-group no-margin">
                            <button type="submit" class="btn btn-theme btn-block">
                                {{ translate('Đăng ký ngay') }}
                            </button>
                        </div>

                        <div class="form-group margin-top-20 text-center">
                            <p>{{ translate('Đã có tài khoản?') }} <a href="{{ route('login') }}">{{ translate('Đăng nhập') }}</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .registration-form-area {
        padding: 40px;
        background: #fff;
        border-radius: 8px;
    }
    .btn-theme {
        background: #fe3c47;
        color: #fff;
        border: none;
        padding: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-theme:hover {
        background: #e6353f;
        color: #fff;
    }
</style>

@endsection
