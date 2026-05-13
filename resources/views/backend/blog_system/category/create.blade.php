@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Blog Category Information')}}</h5>
                <a href="{{ route('blog-category.index') }}" class="btn btn-link text-reset">
                    <i class="las la-angle-left"></i>
                    <span>{{translate('Back to blog category list')}}</span>
                </a>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ route('blog-category.store') }}">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Name')}} <span class="text-danger">*</span> </label>
                        <div class="col-md-9">
                            <input type="text" placeholder="{{translate('Name')}}" id="category_name" name="category_name" class="form-control" required>
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Parent Category')}}</label>
                        <div class="col-md-9">
                            <select type="text" placeholder="{{translate('Parent Category Id')}}" id="parent_id" name="parent_id" class="form-control aiz-selectpicker" data-live-search="true">
                                @foreach ( get_categories( $all_categories ) as $k => $v)
                                    <option value={{$k}}> {{$v}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            {{translate('Display Order')}}
                        </label>
                        <div class="col-md-9">
                            <input type="number" name="display_order" class="form-control" id="display_order" placeholder="{{translate('Display Order')}}">
                            <small>{{translate('Higher number has high priority')}}</small>
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Description')}}</label>
                        <div class="col-md-9">
                            <textarea name="description" rows="6" class="form-control" ></textarea>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Short Description')}}</label>
                        <div class="col-md-9">
                            <textarea name="short_description" rows="6" class="form-control" ></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Meta Title')}}</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="meta_title" placeholder="{{translate('Meta Title')}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">
                            {{translate('Meta Image')}}
                        </label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse')}}
                                    </div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="meta_img" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Meta Description')}}</label>
                        <div class="col-md-9">
                            <textarea name="meta_description" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{translate('Save')}}
                        </button>
                        <a href="{{route('blog-category.index')}}" class="btn btn-outline-info">
                            {{translate('Cancel')}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
