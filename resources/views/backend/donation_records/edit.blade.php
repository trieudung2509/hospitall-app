@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Edit Donation Record') }}</h5>
                <a href="{{ route('donation-records.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{ translate('Back to records') }}</span>
                </a>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('donation-records.update', $donationRecord->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Record ID') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" value="{{ $donationRecord->id }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('User') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="user_id" data-live-search="true" required>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}" @if($u->id == $donationRecord->user_id) selected @endif>
                                        {{ $u->name }} ({{ $u->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Program') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="program_id" data-live-search="true" required>
                                @foreach ($programs as $p)
                                    <option value="{{ $p->id }}" @if($p->id == $donationRecord->program_id) selected @endif>
                                        {{ $p->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Status') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="status" required>
                                <option value="Registered" @if($donationRecord->status == 'Registered') selected @endif>{{ translate('Registered') }}</option>
                                <option value="Completed" @if($donationRecord->status == 'Completed') selected @endif>{{ translate('Completed') }}</option>
                                <option value="Canceled" @if($donationRecord->status == 'Canceled') selected @endif>{{ translate('Canceled') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Check-in Time') }}</label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="check_in_time" class="form-control" value="{{ $donationRecord->check_in_time ? utcToLocalTime($donationRecord->check_in_time)->format('Y-m-d\TH:i') : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Blood Type Verified') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="blood_type_verified" class="form-control" value="{{ $donationRecord->blood_type_verified }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Blood Volume (ml)') }}</label>
                        <div class="col-md-10">
                            <input type="number" min="0" name="blood_volume" class="form-control" value="{{ $donationRecord->blood_volume }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Health Status') }}</label>
                        <div class="col-md-10">
                            <textarea name="health_status" class="form-control" rows="3">{{ $donationRecord->health_status }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Failure Reason') }}</label>
                        <div class="col-md-10">
                            <textarea name="failure_reason" class="form-control" rows="3">{{ $donationRecord->failure_reason }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Notes') }}</label>
                        <div class="col-md-10">
                            <textarea name="notes" class="form-control" rows="3">{{ $donationRecord->notes }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Email Confirm') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="EmailConfirm" class="form-control" value="{{ $donationRecord->EmailConfirm }}">
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        <a href="{{ route('donation-records.index') }}" class="btn btn-outline-info">{{ translate('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
