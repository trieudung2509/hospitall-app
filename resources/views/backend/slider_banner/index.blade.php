@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Slider Banners')}}</h5>
            </div>
            <div class="card-body">
                <form id="add_form" class="form-horizontal" action="{{ route('slider.update') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Short Description')}}
                        </label>
                        <div class="col-md-10">
                            <textarea name="short_description" rows="5" class="form-control" placeholder="{{translate('Short Description')}}">{{ $slider_banner->short_description != null ? $slider_banner->short_description : '' }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="signinSrEmail">
                            {{translate('Image Slider')}} 
                        </label>
                        <div class="col-md-10">
                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse')}}
                                    </div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="image_thumbnail" class="selected-files" value="{{ $slider_banner->image_thumb_ids != null ? $slider_banner->image_thumb_ids : '' }}">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{translate('Save')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection