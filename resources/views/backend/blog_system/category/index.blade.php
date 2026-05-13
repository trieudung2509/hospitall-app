@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('All Blog Categories')}}</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ url('admin/blog-category/create') }}" class="btn btn-primary">
                <span>{{translate('Add New category')}}</span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="sort_categories" action="" method="GET">
            <div class="form-group row">
                <label class="col-md-3 col-form-label">{{ translate('Name') }}</label>
                <div class="col-md-7">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" name="search"
                               @isset($sort_search) value="{{ $sort_search }}" @endisset>
                    </div>
                </div>
            </div>

            <div class="offset-md-5 mb-0 ">
                    <button class="btn btn-primary" type="submit">{{ translate('Search') }}</button>
                    <a href="{{route('blog-category.index')}}" class="btn btn-outline-info confirm-exit">
                            {{translate('Clear')}}
                        </a>
                </div>
        </form>
    </div>
</div>


<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">{{ translate('Blog Categories') }}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                <th width="5%">#</th>
                    <th>{{translate('Name')}}</th>
                    <th>{{translate('Parent')}}</th>
                    <th >{{ translate('Display Order') }}</th>
                    <th data-breakpoints="xs">{{translate('Is Home Page')}}</th>
                    <th data-breakpoints="xs">{{translate('Is Show Menu')}}</th>
                    <th data-breakpoints="lg">{{ translate('Slug') }}</th>
                    <th data-breakpoints="lg">{{ translate('Status') }}</th>
                    <th>{{translate('Blogs')}}</th>
                    <th>{{translate('Status')}}</th>
                    <th width="10%" class="text-right">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $key => $category)
                <tr>
                    <td>{{ ($key+1) + ($categories->currentPage() - 1)*$categories->perPage() }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->parent_id ? $category->parent->category_name : '' }}</td>
                    <td>{{ $category->display_order }}</td>
                    <td>
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="checkbox" onchange="change_home_page_status(this)"
                                   value="{{ $category->id }}" <?php if ($category->is_home_page == 1) echo "checked";?>>
                            <span></span>
                        </label>
                    </td>
                    <td>
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="checkbox" onchange="change_show_menu_status(this)"
                                   value="{{ $category->id }}" <?php if ($category->is_show_menu == 1) echo "checked";?>>
                            <span></span>
                        </label>
                    </td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="checkbox" onchange="change_status(this)" value="{{ $category->id }}" <?php if($category->status == 1) echo "checked";?>>
                            <span></span>
                        </label>
                    </td>
                    <td>{{ $category->posts->count() }}</td>
                    <td>{{ $category->status == 0 ? "Draft" : "Publish" }}</td>
                    <td class="text-right">
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{url('admin/blog-category/'.$category->id.'/edit')}}" title="{{ translate('Edit') }}">
                            <i class="las la-edit"></i>
                        </a>
                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('blog-category.destroy', $category->id)}}" title="{{ translate('Delete') }}">
                            <i class="las la-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    function change_status(el) {
        var status = 0;
        if (el.checked) {
            var status = 1;
        }
        $.post('{{ route('blog-category.change-status') }}', {
            _token: '{{ csrf_token() }}',
            id: el.value,
            status: status
        }, function (data) {
            if (data == 1) {
                AIZ.plugins.notify('success', '{{ translate('Change Category status successfully') }}');
            } else {
                AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
            }
        });
    }

    function change_home_page_status(el){
            var status = 0;
            if(el.checked){
                var status = 1;
            }
            $.post('{{ route('blog-category.change-home-page-status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Change status home page successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function change_show_menu_status(el){
            var status = 0;
            if(el.checked){
                var status = 1;
            }
            $.post('{{ route('blog-category.change-show-menu-status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Change status menu successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
</script>
@endsection

@section('modal')
@include('modals.delete_modal')
@endsection
