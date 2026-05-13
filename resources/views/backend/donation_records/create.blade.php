@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Donation Record Information') }}</h5>
                <a href="{{ route('donation-records.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{ translate('Back to records') }}</span>
                </a>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('donation-records.store') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('User') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="user_id" data-live-search="true" required>
                                <option value="">--</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Program') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="program_id" data-live-search="true" required>
                                <option value="">--</option>
                                @foreach ($programs as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Status') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="status" required>
                                <option value="Registered">{{ translate('Registered') }}</option>
                                <option value="Completed">{{ translate('Completed') }}</option>
                                <option value="Canceled">{{ translate('Canceled') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Check-in Time') }}</label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="check_in_time" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Blood Type Verified') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="blood_type_verified" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Blood Volume (ml)') }}</label>
                        <div class="col-md-10">
                            <input type="number" min="0" name="blood_volume" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Health Status') }}</label>
                        <div class="col-md-10">
                            <textarea name="health_status" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Failure Reason') }}</label>
                        <div class="col-md-10">
                            <textarea name="failure_reason" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Notes') }}</label>
                        <div class="col-md-10">
                            <textarea name="notes" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Email Confirm') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="EmailConfirm" class="form-control">
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                        <a href="{{ route('donation-records.index') }}" class="btn btn-outline-info">{{ translate('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
