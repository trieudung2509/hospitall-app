@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Chỉnh sửa hồ sơ hiến máu') }}</h5>
                <a href="{{ route('donation-records.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{ translate('Quay lại danh sách hồ sơ') }}</span>
                </a>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('donation-records.update', $donationRecord->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('ID hồ sơ') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="{{ $donationRecord->id }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Người dùng') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="user_id" data-live-search="true" required disabled>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}" @if($u->id == $donationRecord->user_id) selected @endif>
                                        {{ $u->name }} ({{ $u->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Chương trình') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="program_id" data-live-search="true" required disabled>
                                @foreach ($programs as $p)
                                    <option value="{{ $p->id }}" @if($p->id == $donationRecord->program_id) selected @endif>
                                        {{ $p->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Trạng thái') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="status" required>
                                <option value="Registered" @if($donationRecord->status == 'Registered') selected @endif>{{ translate('Đã đăng ký') }}</option>
                                <option value="Completed" @if($donationRecord->status == 'Completed') selected @endif>{{ translate('Đã hoàn thành') }}</option>
                                <option value="Canceled" @if($donationRecord->status == 'Canceled') selected @endif>{{ translate('Đã hủy') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Thời gian Check-in') }}</label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="check_in_time" class="form-control" value="{{ $donationRecord->check_in_time ? utcToLocalTime($donationRecord->check_in_time)->format('Y-m-d\TH:i') : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Nhóm máu đã xác minh') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="blood_type_verified" class="form-control" value="{{ $donationRecord->blood_type_verified }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Thể tích máu (ml)') }}</label>
                        <div class="col-md-10">
                            <input type="number" min="0" name="blood_volume" class="form-control" value="{{ $donationRecord->blood_volume }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Tình trạng sức khỏe') }}</label>
                        <div class="col-md-10">
                            <textarea name="health_status" class="form-control" rows="3">{{ $donationRecord->health_status }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Lý do thất bại') }}</label>
                        <div class="col-md-10">
                            <textarea name="failure_reason" class="form-control" rows="3">{{ $donationRecord->failure_reason }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Ghi chú') }}</label>
                        <div class="col-md-10">
                            <textarea name="notes" class="form-control" rows="3">{{ $donationRecord->notes }}</textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Cập nhật') }}</button>
                        <a href="{{ route('donation-records.index') }}" class="btn btn-outline-info">{{ translate('Hủy') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
