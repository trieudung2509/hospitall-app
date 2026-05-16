@extends('frontend.layouts.app')

@section('content')

<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-left">
                <h3>{{ translate('Đăng nhập') }}</h3>
                <p class="page-breadcrumb">
                    <a href="{{ route('home') }}">{{ translate('Trang chủ') }}</a> / {{ translate('Đăng nhập') }}
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section-content-block">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <div class="login-form-area theme-custom-box-shadow">
                    <div class="section-heading-wrapper">
                        <h2 class="section-heading">{{ translate('Chào mừng trở lại') }}</h2>
                        <p>{{ translate('Đăng nhập vào tài khoản của bạn để quản lý các chiến dịch hiến máu.') }}</p>
                    </div>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ translate('Email hoặc Số điện thoại') }}</label>
                            <input id="email" type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
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

                        <div class="form-group clearfix">
                            <div class="pull-left">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ translate('Ghi nhớ đăng nhập') }}
                                </label>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('password.request') }}">{{ translate('Quên mật khẩu?') }}</a>
                            </div>
                        </div>

                        <div class="form-group no-margin">
                            <button type="submit" class="btn btn-theme btn-block">
                                {{ translate('Đăng nhập') }}
                            </button>
                        </div>

                        <div class="form-group margin-top-20 text-center">
                            <p>{{ translate('Chưa có tài khoản?') }} <a href="{{ route('register') }}">{{ translate('Đăng ký ngay') }}</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .login-form-area {
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
