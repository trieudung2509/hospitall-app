@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{ translate('All Programs') }}</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('programs.create') }}" class="btn btn-circle btn-info">
                <span>{{ translate('Add New Program') }}</span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="filter_programs" method="GET">
            <div class="form-group row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="{{ translate('Search by name') }}"
                        @isset($sort_search) value="{{ $sort_search }}" @endisset>
                </div>
                <div class="col-md-4">
                    <select class="form-control aiz-selectpicker" name="org_id" data-live-search="true">
                        <option value="">{{ translate('All organizations') }}</option>
                        @foreach ($organizations as $o)
                            <option value="{{ $o->id }}" @if ($sort_org == $o->id) selected @endif>{{ $o->org_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control aiz-selectpicker" name="status">
                        <option value="">{{ translate('All statuses') }}</option>
                        <option value="activated" @if ($sort_status === "activated") selected @endif>{{ translate('Activated') }}</option>
                        <option value="inActived" @if ($sort_status === "inActived") selected @endif>{{ translate('Inactive') }}</option>
                    </select>
                </div>
            </div>
            <div class="offset-md-5 mb-0">
                <button class="btn btn-primary" type="submit">{{ translate('Search') }}</button>
                <a href="{{ route('programs.index') }}" class="btn btn-outline-info">{{ translate('Clear') }}</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-md-0 h6">{{ translate('All programs') }}</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0 aiz-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ translate('ID') }}</th>
                    <th>{{ translate('Banner') }}</th>
                    <th>{{ translate('Name') }}</th>
                    <th>{{ translate('Organization') }}</th>
                    <th>{{ translate('Start') }}</th>
                    <th>{{ translate('End') }}</th>
                    <th>{{ translate('Status') }}</th>
                    <th class="text-right">{{ translate('Options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $key => $program)
                <tr>
                    <td>{{ ($key+1) + ($programs->currentPage() - 1) * $programs->perPage() }}</td>
                    <td>{{ $program->id }}</td>
                    <td>
                        @if($program->banner)
                            <img src="{{ uploaded_asset($program->banner) }}" alt="" style="height: 40px; width: 60px; object-fit: cover;">
                        @else
                            --
                        @endif
                    </td>
                    <td>{{ $program->name }}</td>
                    <td>{{ $program->organization ? $program->organization->org_name : '--' }}</td>
                    <td>{{ $program->start_time ? utcToLocalTime($program->start_time) : '--' }}</td>
                    <td>{{ $program->end_time ? utcToLocalTime($program->end_time) : '--' }}</td>
                    <td>
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="checkbox" onchange="change_status(this)"
                                value="{{ $program->id }}" <?php if ($program->status === 'activated') echo "checked"; ?>>
                            <span></span>
                        </label>
                    </td>
                    <td class="text-right">
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('programs.edit', $program->id) }}" title="{{ translate('Edit') }}">
                            <i class="las la-pen"></i>
                        </a>
                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('programs.destroy', $program->id) }}" title="{{ translate('Delete') }}">
                            <i class="las la-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $programs->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
<script type="text/javascript">
    function change_status(el) {
        var status = el.checked ? 1 : 0;
        $.post('{{ route('programs.change-status') }}', { _token: '{{ csrf_token() }}', id: el.value, status: status }, function (data) {
            if (data == 1) {
                AIZ.plugins.notify('success', '{{ translate('Program status updated') }}');
            } else {
                AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
            }
        });
    }
</script>
@endsection
