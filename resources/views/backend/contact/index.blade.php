@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Trang liên hệ')}}</h5>
            </div>
            <div class="card-body">
                <form id="add_form" class="form-horizontal" action="{{ route('contact.update') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Tiêu đề')}}
                        </label>
                        <div class="col-md-10">
                            <input type="text" placeholder="{{translate('Title')}}" id="title" name="title" class="form-control" value="{{ $contact->title != null ? $contact->title : '' }}">
                        </div>
                    </div>
      
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Mô tả ngắn')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-10">
                            <textarea name="short_description" rows="5" class="form-control" placeholder="{{translate('Mô tả ngắn')}}">{{ $contact->description != null ? $contact->description : '' }}</textarea>
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