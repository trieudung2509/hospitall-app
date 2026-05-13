@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Edit Program') }}</h5>
                <a href="{{ route('programs.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{ translate('Back to programs') }}</span>
                </a>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('programs.update', $program->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Organization') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="org_id" data-live-search="true" required>
                                @foreach ($organizations as $o)
                                    <option value="{{ $o->id }}"
                                        @if ($o->id == $program->org_id) selected @endif>
                                        {{ $o->org_name }}@if ($o->status != 1 || $o->trashed()) ({{ translate('inactive') }}) @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Name') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" value="{{ $program->name }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Banner') }}</label>
                        <div class="col-md-10">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="banner" value="{{ $program->banner }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Short description') }}</label>
                        <div class="col-md-10">
                            <textarea class="tiny-text" name="short_description" rows={3}  data-format="true">{!! $program->short_description ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Description') }}</label>
                        <div class="col-md-10">
                            <textarea class="tiny-text" name="description" data-format="true">{!! $program->description ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Location') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="location" class="form-control" value="{{ $program->location }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Google Map (Embed Code/Link)') }}</label>
                        <div class="col-md-10">
                            <textarea name="google_map" class="form-control" rows="3" placeholder="{{ translate('Paste Google Map iframe or address link here') }}">{{ $program->google_map }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Start time') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="start_time" class="form-control" value="{{ $program->start_time ? utcToLocalTime($program->start_time)->format('Y-m-d\TH:i') : '' }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('End time') }} <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="datetime-local" name="end_time" class="form-control" value="{{ $program->end_time ? utcToLocalTime($program->end_time)->format('Y-m-d\TH:i') : '' }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Max participants') }}</label>
                        <div class="col-md-10">
                            <input type="number" min="0" name="max_participants" class="form-control" value="{{ $program->max_participants }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Note') }}</label>
                        <div class="col-md-10">
                            <textarea name="note" class="form-control" rows="3">{{ $program->note }}</textarea>
                        </div>
                    </div>

                    <div class="card-header px-0">
                        <h5 class="mb-0 h6">{{ translate('SEO Meta Tags') }}</h5>
                    </div>
                    <br>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Slug') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="slug" class="form-control" placeholder="{{ translate('Slug') }}" value="{{ $program->slug }}">
                            <small class="text-muted">{{ translate('Leave blank to generate from name') }}</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Meta Title') }}</label>
                        <div class="col-md-10">
                            <input type="text" name="meta_title" class="form-control" placeholder="{{ translate('Meta Title') }}" value="{{ $program->meta_title }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{ translate('Meta Description') }}</label>
                        <div class="col-md-10">
                            <textarea name="meta_description" class="form-control" rows="3">{{ $program->meta_description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        <a href="{{ route('programs.index') }}" class="btn btn-outline-info">{{ translate('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
