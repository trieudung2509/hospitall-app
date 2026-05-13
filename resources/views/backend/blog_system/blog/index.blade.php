@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{translate('All Posts')}}</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('blog.create') }}" class="btn btn-circle btn-info">
                <span>{{translate('Add New Post')}}</span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="filter_blogs" method="GET">
            <div class="form-group row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="search" name="search" placeholder="{{translate('Title')}}"
                                    @isset($sort_search) value="{{ $sort_search }}"
                                @endisset>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="text"
                                    class="form-control aiz-date-range"
                                    name="published_date_range"
                                    data-time-picker="true"
                                    data-format="DD-MM-Y HH:mm:ss"
                                    data-separator=" to "
                                    autocomplete="off"
                                    placeholder="{{translate('Published Date')}}"
                                    @isset ($sort_published_date_range) value="{{ $sort_published_date_range }}" @endisset>
                        </div>
                    </div>
                    <div class="from-group row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="author" placeholder="{{translate('Author')}}"
                                    @isset ($sort_author) value="{{$sort_author}}" @endisset>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Status') }}</label>
                        <div class="col-md-9">
                            <select class="aiz-selectpicker" name="status">
                                <option value="">{{ translate('All') }}</option>
                                <option value="0" @if ($sort_status === "0") selected @endif >{{ translate('Draft') }}</option>
                                <option value="1" @if ($sort_status === "1") selected @endif >{{ translate('Published') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{translate('Sort by Category')}}</label>
                        <div class="col-md-9">
                            <select id="demo-ease" class="form-control aiz-selectpicker" name="category_ids[]" multiple>
                                @foreach ($list_categories as $key => $category)
                                <option value="{{ $category->id }}"
                                            @if($sort_category_ids != null && in_array($category->id, $sort_category_ids)) selected @endif >{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-md-5 mb-0 ">
                <button class="btn btn-primary" type="submit">{{ translate('Search') }}</button>
                <a href="{{route('blog.index')}}" class="btn btn-outline-info confirm-exit">
                        {{translate('Clear')}}
                    </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <form class="" id="sort_blogs" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">{{ translate('All blog posts') }}</h5>
            </div>
            
            <div class="col-md-2">
                <div class="form-group mb-0">
                    <input type="text" class="form-control form-control-sm" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type & Enter') }}">
                </div>
            </div>
        </div>
        </from>
        <div class="card-body">
            <table class="table mb-0 aiz-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Id</th>
                        <th>{{translate('Title')}}</th>
                        <th data-breakpoints="md" style="width: 15%">{{translate('Category')}}</th>
                        <th data-breakpoints="xs">{{translate('Status')}}</th>
                        <th data-breakpoints="sm">{{translate('Published date')}}</th>
                        <th data-breakpoints="sm">{{translate('Author')}}</th>
                        <th data-breakpoints="sm">{{translate('Last edited by')}}</th>
                        <th class="text-right">{{translate('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $key => $blog)
                    <tr>
                        <td>
                            {{ ($key+1) + ($blogs->currentPage() - 1) * $blogs->perPage() }}
                        </td>
                        <td>
                            {{ $blog->id }}
                        </td>
                        <td>
                            {{ $blog->title }}
                        </td>
                        <td>
                            @if($blog->category != null)
                                {{ $blog->category->category_name }}
                            @else
                                --
                            @endif
                        </td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" onchange="change_status(this)"
                                       value="{{ $blog->id }}" <?php if ($blog->status == 1) echo "checked";?>>
                                <span></span>
                            </label>
                        </td>
                        <td  class="text-left">
                            @if($blog->published_date != null)
                                {{ utcToLocalTime($blog->published_date) }}
                            @else
                                --
                            @endif
                        </td>
                        <td>
                            {{ $blog->author != null ? $blog->author->name : "" }}
                        </td>
                        <td>
                            @if($blog->post_modified != null)
                                {{ utcToLocalTime($blog->post_modified) }}
                            @else
                                --
                            @endif
                        </td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('blog.edit',$blog->id)}}" title="{{ translate('Edit') }}">
                                <i class="las la-pen"></i>
                            </a>
                            
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('blog.destroy', $blog->id)}}" title="{{ translate('Delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $blogs->links() }}
            </div>
        </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

    <script type="text/javascript">
        function change_status(el){
            var status = 0;
            if(el.checked){
                var status = 1;
            }
            $.post('{{ route('blog.change-status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Change blog status successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>

@endsection
