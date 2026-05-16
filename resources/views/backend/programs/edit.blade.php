@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Chỉnh sửa chương trình') }}</h5>
                <a href="{{ route('programs.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{ translate('Quay lại danh sách chương trình') }}</span>
                </a>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('programs.update', $program->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Tổ chức') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="org_id" data-live-search="true" required>
                                @foreach ($organizations as $o)
                                    <option value="{{ $o->id }}"
                                        @if ($o->id == $program->org_id) selected @endif>
                                        {{ $o->org_name }}@if ($o->status != 1 || $o->trashed()) ({{ translate('ngừng hoạt động') }}) @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Tên') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" value="{{ $program->name }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Banner') }}</label>
                        <div class="col-md-10">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Duyệt') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Chọn tệp') }}</div>
                                <input type="hidden" name="banner" value="{{ $program->banner }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Mô tả ngắn') }}</label>
                        <div class="col-md-10">
                            <textarea class="tiny-text" name="short_description" rows={3}  data-format="true">{!! $program->short_description ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Mô tả') }}</label>
                        <div class="col-md-10">
                            <textarea class="tiny-text" name="description" data-format="true">{!! $program->description ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Địa điểm') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="location" class="form-control" value="{{ $program->location }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Google Map (Mã nhúng/Liên kết)') }}</label>
                        <div class="col-md-10">
                            <textarea name="google_map" class="form-control" rows="3" placeholder="{{ translate('Dán mã nhúng iframe Google Map hoặc liên kết địa chỉ tại đây') }}">{{ $program->google_map }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Thời gian bắt đầu') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="start_time" class="form-control" value="{{ $program->start_time ? utcToLocalTime($program->start_time)->format('Y-m-d\TH:i') : '' }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Thời gian kết thúc') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="end_time" class="form-control" value="{{ $program->end_time ? utcToLocalTime($program->end_time)->format('Y-m-d\TH:i') : '' }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Số người tham gia tối đa') }}</label>
                        <div class="col-md-10">
                            <input type="number" min="0" name="max_participants" class="form-control" value="{{ $program->max_participants }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Ghi chú') }}</label>
                        <div class="col-md-10">
                            <textarea name="note" class="form-control" rows="3">{{ $program->note }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Trạng thái') }}</label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="status" required @if(auth()->user()->user_type == 'organization') disabled @endif>
                                <option value="pending" @if($program->status == 'pending') selected @endif>{{ translate('Đang chờ') }}</option>
                                <option value="activated" @if($program->status == 'activated') selected @endif>{{ translate('Đã kích hoạt') }}</option>
                                <option value="inActived" @if($program->status == 'inActived') selected @endif>{{ translate('Ngừng hoạt động') }}</option>
                            </select>
                            @if(auth()->user()->user_type == 'organization')
                                <small class="text-muted">{{ translate('Chỉ Quản trị viên hoặc Nhân viên mới có thể thay đổi trạng thái chương trình.') }}</small>
                                <input type="hidden" name="status" value="{{ $program->status }}">
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Cập nhật') }}</button>
                        <a href="{{ route('programs.index') }}" class="btn btn-outline-info">{{ translate('Hủy') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
