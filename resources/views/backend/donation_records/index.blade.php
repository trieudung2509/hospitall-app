@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{ translate('Donation Records') }}</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('donation-records.create') }}" class="btn btn-circle btn-info">
                <span>{{ translate('Add New Record') }}</span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="filter_donation_records" method="GET">
            <div class="form-group row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="{{ translate('Search by ID') }}"
                        @isset($sort_search) value="{{ $sort_search }}" @endisset>
                </div>
                <div class="col-md-4">
                    <select class="form-control aiz-selectpicker" name="program_id" data-live-search="true">
                        <option value="">{{ translate('All programs') }}</option>
                        @foreach ($programs as $p)
                            <option value="{{ $p->id }}" @if ($sort_program == $p->id) selected @endif>{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control aiz-selectpicker" name="status">
                        <option value="">{{ translate('All statuses') }}</option>
                        <option value="Registered" @if ($sort_status === "Registered") selected @endif>{{ translate('Registered') }}</option>
                        <option value="Completed" @if ($sort_status === "Completed") selected @endif>{{ translate('Completed') }}</option>
                        <option value="Canceled" @if ($sort_status === "Canceled") selected @endif>{{ translate('Canceled') }}</option>
                    </select>
                </div>
            </div>
            <div class="offset-md-5 mb-0">
                <button class="btn btn-primary" type="submit">{{ translate('Search') }}</button>
                <a href="{{ route('donation-records.index') }}" class="btn btn-outline-info">{{ translate('Clear') }}</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-md-0 h6">{{ translate('Donation Records List') }}</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0 aiz-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ translate('User') }}</th>
                    <th>{{ translate('Program') }}</th>
                    <th>{{ translate('Status') }}</th>
                    <th>{{ translate('Blood Type') }}</th>
                    <th>{{ translate('Volume') }}</th>
                    <th>{{ translate('Reg Time') }}</th>
                    <th>{{ translate('Confirmed By') }}</th>
                    <th class="text-right">{{ translate('Options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donation_records as $key => $record)
                <tr>
                    <td>{{ ($key+1) + ($donation_records->currentPage() - 1) * $donation_records->perPage() }}</td>
                    <td>{{ $record->user ? $record->user->name : '--' }}</td>
                    <td>{{ $record->program ? $record->program->name : '--' }}</td>
                    <td>
                        @if($record->status == 'Completed')
                            <span class="badge badge-inline badge-success">{{ translate('Completed') }}</span>
                        @elseif($record->status == 'Canceled')
                            <span class="badge badge-inline badge-danger">{{ translate('Canceled') }}</span>
                        @else
                            <span class="badge badge-inline badge-info">{{ translate('Registered') }}</span>
                        @endif
                    </td>
                    <td>{{ $record->blood_type_verified ?? '--' }}</td>
                    <td>{{ $record->blood_volume ?? '--' }} ml</td>
                    <td>{{ $record->registration_time ? $record->registration_time->format('Y-m-d H:i') : '--' }}</td>
                    <td>{{ $record->EmailConfirm ?? '--' }}</td>
                    <td class="text-right">
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('donation-records.edit', $record->id) }}" title="{{ translate('Edit') }}">
                            <i class="las la-pen"></i>
                        </a>
                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('donation-records.destroy', $record->id) }}" title="{{ translate('Delete') }}">
                            <i class="las la-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $donation_records->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
