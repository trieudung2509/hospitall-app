@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Edit Organization') }}</h5>
                <a href="{{ route('organizations.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{ translate('Back to organizations') }}</span>
                </a>
            </div>
            <div class="card-body">
                @php
                    $linkedUser = $organization->linkedUser();
                @endphp
                @if($linkedUser)
                    <p class="text-muted small">{{ translate('Linked user') }}: #{{ $linkedUser->id }} ({{ $linkedUser->email }}). {{ translate('Editing name/email/phone will sync to this user.') }}</p>
                @else
                    <p class="text-warning small">{{ translate('No linked user found for this organization. User sync will be skipped.') }}</p>
                @endif

                <form class="form-horizontal" action="{{ route('organizations.update', $organization->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Organization name') }} <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="org_name" class="form-control" value="{{ $organization->org_name }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Type') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="org_type" class="form-control" value="{{ $organization->org_type }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Contact person') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="contact_person" class="form-control" value="{{ $organization->contact_person }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Contact phone') }}</label>
                        <div class="col-md-9">
                            <input type="text" name="contact_phone" class="form-control" value="{{ $organization->contact_phone }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Contact email') }} <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="email" name="contact_email" class="form-control" value="{{ $organization->contact_email }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Status') }}</label>
                        <div class="col-md-9">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" name="status" value="1" @if ($organization->status == 1) checked @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        <a href="{{ route('organizations.index') }}" class="btn btn-outline-info">{{ translate('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
