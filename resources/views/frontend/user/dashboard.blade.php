@extends('frontend.layouts.app')

@section('content')

<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-left">
                <h3>{{ translate('Lịch sử đăng ký của tôi') }}</h3>
                <p class="page-breadcrumb">
                    <a href="{{ route('home') }}">{{ translate('Trang chủ') }}</a> / {{ translate('Lịch sử') }}
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section-content-block">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Chiến dịch') }}</th>
                                <th>{{ translate('Trạng thái') }}</th>
                                <th>{{ translate('Thời gian đăng ký') }}</th>
                                <th>{{ translate('Ghi chú') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donation_records as $key => $record)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if($record->program)
                                            <a href="{{ route('detail_campaign', $record->program->slug) }}">{{ $record->program->name }}</a>
                                        @else
                                            {{ translate('N/A') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($record->status == 'Completed')
                                            <span class="label label-success">{{ translate('Hoàn thành') }}</span>
                                        @elseif($record->status == 'Canceled')
                                            <span class="label label-danger">{{ translate('Đã hủy') }}</span>
                                        @else
                                            <span class="label label-info">{{ translate('Đã đăng ký') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $record->registration_time ? $record->registration_time->format('d-m-Y H:i') : $record->created_at->format('d-m-Y H:i') }}</td>
                                    <td>{{ $record->notes }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">{{ translate('Bạn chưa đăng ký chiến dịch nào.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                    {{ $donation_records->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .custom-table {
        margin-top: 20px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .custom-table th {
        background-color: #f8f9fa;
        color: #333;
    }
    .label {
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 500;
    }
</style>

@endsection
