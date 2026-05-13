@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Blog Information')}}</h5>
                <a href="{{ route('blog.index') }}" class="btn btn-link text-reset confirm-exit">
                    <i class="las la-angle-left"></i>
                    <span>{{translate('Back to blog list')}}</span>
                </a>
            </div>
            <div class="card-body">
                <form id="add_form" class="form-horizontal" action="{{ route('blog.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Blog Title')}}
                            <span class="text-danger">*</span>
                            <br>
                            <small>( {{ translate('Current characters: ') }} <span id="title-character-count">0</span> )</small>
                        </label>
                        <div class="col-md-10">
                            <input type="text" placeholder="{{translate('Blog Title')}}" onkeyup="makeSlug(this.value)" id="title" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row" id="category">
                        <label class="col-md-2 col-from-label">
                            {{translate('Category')}} 
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-10">
                            <select class="form-control aiz-selectpicker" name="category_id" id="category_id" data-live-search="true" required>
                                <option>--</option>
                                @foreach ($blog_categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{translate('Slug')}}
                            <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" placeholder="{{translate('Slug')}}" name="slug" id="slug" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="signinSrEmail">
                            {{translate('Banner')}} 
                            <small>(1300x650)</small>
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-10">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse')}}
                                    </div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="banner" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Short Description')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-10">
                        <textarea id="short_description" placeholder="{{translate('Short Description')}}" name="short_description" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-from-label">
                            {{translate('Description')}}
                        </label>
                        <div class="col-md-10">
                            <textarea class="tiny-text"  name="description" data-format="true"></textarea>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">{{translate('Meta Title')}}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="meta_title" placeholder="{{translate('Meta Title')}}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="signinSrEmail">
                            {{translate('Meta Image')}} 
                            <small>(200x200)+</small>
                        </label>
                        <div class="col-md-10">
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
                        <label class="col-md-2 col-form-label">
                            {{translate('Meta Description')}}
                            <br>
                            <small>( {{ translate('Max length: 1000 characters') }} )</small>
                            <br>
                            <small>( {{ translate('Current characters: ') }} <span id="meta_description-character-count">0</span> )</small>
                        </label>
                        <div class="col-md-10">
                            <textarea id="meta_description" onkeyup="countNumberChar(this.value)" placeholder="{{translate('Meta Description')}}" name="meta_description" rows="5" class="form-control" maxlength="1000"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            {{translate('Meta Keywords')}}
                        </label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="4" placeholder="{{translate('Meta Keywords')}}"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{translate('Save')}}
                        </button>
                        <a href="{{route('blog.index')}}" class="btn btn-outline-info confirm-exit">
                            {{translate('Cancel')}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('modals.exit_modal')
@endsection


@section('script')
<script>
    function makeSlug(val) {
        let str = val;
        let output = str.replace(/\s+/g, '-').toLowerCase();
        $('#slug').val(output);
        $('#title-character-count').text(str.length);
    }

    function countNumberChar(val) {
        $('#meta_description-character-count').text(val.length);
    }

    $(document).ready(function () {
        $(".confirm-exit").click(function (e) {
            e.preventDefault();
            var url = $(this).data("href");
            if (!url)
                url = $(this).attr("href");
            $("#exit-modal").modal("show");
            $("#exit-link").attr("href", url);
        });
    })
</script>
@endsection
