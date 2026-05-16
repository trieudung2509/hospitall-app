@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Thông tin chương trình') }}</h5>
                <a href="{{ route('programs.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{ translate('Quay lại danh sách chương trình') }}</span>
                </a>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('programs.store') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Tổ chức') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="org_id" data-live-search="true" required>
                                <option value="">--</option>
                                @foreach ($organizations as $o)
                                    <option value="{{ $o->id }}">{{ $o->org_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Tên') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Banner') }} <small>(1300x650)</small></label>
                        <div class="col-md-10">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Duyệt') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Chọn tệp') }}</div>
                                <input type="hidden" name="banner" class="selected-files">
                            </div>
                            <div class="file-preview box sm"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Mô tả ngắn') }}</label>
                        <div class="col-md-10">
                            <textarea class="tiny-text" name="short_description" data-format="true"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Mô tả') }}</label>
                        <div class="col-md-10">
                            <textarea class="tiny-text" name="description" data-format="true"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Địa điểm') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="location" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Google Map (Mã nhúng/Liên kết)') }}</label>
                        <div class="col-md-10">
                            <textarea name="google_map" class="form-control" rows="3" placeholder="{{ translate('Dán mã nhúng iframe Google Map hoặc liên kết địa chỉ tại đây') }}"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Thời gian bắt đầu') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="start_time" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Thời gian kết thúc') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="end_time" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Số người tham gia tối đa') }}</label>
                        <div class="col-md-10">
                            <input type="number" min="0" name="max_participants" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Ghi chú') }}</label>
                        <div class="col-md-10">
                            <textarea name="note" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Lưu') }}</button>
                        <a href="{{ route('programs.index') }}" class="btn btn-outline-info">{{ translate('Hủy') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
