@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{ translate('All Organizations') }}</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('organizations.create') }}" class="btn btn-circle btn-info">
                <span>{{ translate('Add New Organization') }}</span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="filter_organizations" method="GET">
            <div class="form-group row">
                <div class="col-md-6">
                    <input type="text" class="form-control mb-2" name="search" placeholder="{{ translate('Search by name') }}"
                        @isset($sort_search) value="{{ $sort_search }}" @endisset>
                    <input type="text" class="form-control" name="org_type" placeholder="{{ translate('Type') }}"
                        @isset($sort_type) value="{{ $sort_type }}" @endisset>
                </div>
                <div class="col-md-6">
                    <select class="form-control aiz-selectpicker" name="status">
                        <option value="">{{ translate('All statuses') }}</option>
                        <option value="1" @if ($sort_status === "1") selected @endif>{{ translate('Active') }}</option>
                        <option value="0" @if ($sort_status === "0") selected @endif>{{ translate('Inactive') }}</option>
                    </select>
                </div>
            </div>
            <div class="offset-md-5 mb-0">
                <button class="btn btn-primary" type="submit">{{ translate('Search') }}</button>
                <a href="{{ route('organizations.index') }}" class="btn btn-outline-info">{{ translate('Clear') }}</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-md-0 h6">{{ translate('All organizations') }}</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0 aiz-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ translate('ID') }}</th>
                    <th>{{ translate('Name') }}</th>
                    <th>{{ translate('Type') }}</th>
                    <th>{{ translate('Contact person') }}</th>
                    <th>{{ translate('Email') }}</th>
                    <th>{{ translate('Status') }}</th>
                    <th>{{ translate('Created') }}</th>
                    <th class="text-right">{{ translate('Options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($organizations as $key => $org)
                <tr>
                    <td>{{ ($key+1) + ($organizations->currentPage() - 1) * $organizations->perPage() }}</td>
                    <td>{{ $org->id }}</td>
                    <td>{{ $org->org_name }}</td>
                    <td>{{ $org->org_type ?? '--' }}</td>
                    <td>{{ $org->contact_person ?? '--' }}</td>
                    <td>{{ $org->contact_email }}</td>
                    <td>
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input type="checkbox" onchange="change_status(this)"
                                value="{{ $org->id }}" <?php if ($org->status == 1) echo "checked"; ?>>
                            <span></span>
                        </label>
                    </td>
                    <td>{{ utcToLocalTime($org->created_at) }}</td>
                    <td class="text-right">
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('organizations.edit', $org->id) }}" title="{{ translate('Edit') }}">
                            <i class="las la-pen"></i>
                        </a>
                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('organizations.destroy', $org->id) }}" title="{{ translate('Delete') }}">
                            <i class="las la-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $organizations->links() }}
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
        $.post('{{ route('organizations.change-status') }}', { _token: '{{ csrf_token() }}', id: el.value, status: status }, function (data) {
            if (data == 1) {
                AIZ.plugins.notify('success', '{{ translate('Organization status updated') }}');
            } else {
                AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
            }
        });
    }
</script>
@endsection
