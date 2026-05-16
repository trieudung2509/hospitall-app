@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Chỉnh sửa tổ chức') }}</h5>
                <a href="{{ route('organizations.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{ translate('Quay lại danh sách tổ chức') }}</span>
                </a>
            </div>
            <div class="card-body">
                @if($linkedUser)
                    <p class="text-muted small">{{ translate('Người dùng liên kết') }}: #{{ $linkedUser->id }} ({{ $linkedUser->email }}). {{ translate('Chỉnh sửa tên/email/số điện thoại sẽ đồng bộ hóa với người dùng này.') }}</p>
                @else
                    <p class="text-warning small">{{ translate('Không tìm thấy người dùng liên kết cho tổ chức này. Việc đồng bộ người dùng sẽ bị bỏ qua.') }}</p>
                @endif

                <form class="form-horizontal" action="{{ route('organizations.update', $organization->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Tên tổ chức') }} <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="org_name" class="form-control" value="{{ $organization->org_name }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Loại') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="org_type" class="form-control" value="{{ $organization->org_type }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Người liên hệ') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="contact_person" class="form-control" value="{{ $organization->contact_person }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Số điện thoại liên hệ') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="contact_phone" class="form-control" value="{{ $organization->contact_phone }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Email liên hệ') }} <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="email" name="contact_email" class="form-control" value="{{ $organization->contact_email }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Trạng thái') }}</label>
                        <div class="col-md-9">
                            <input type="hidden" name="status" value="0">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" name="status" value="1" @if ($organization->status == 1) checked @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Cập nhật') }}</button>
                        <a href="{{ route('organizations.index') }}" class="btn btn-outline-info">{{ translate('Hủy') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
