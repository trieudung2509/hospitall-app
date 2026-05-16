@extends('backend.layouts.app')

@section('content')
@if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
    <div class="">
        <div class="alert alert-danger d-flex align-items-center">
            {{translate('Vui lòng cấu hình SMTP để các tính năng gửi email hoạt động')}},
            <a class="alert-link ml-2" href="{{ route('smtp_settings.index') }}">{{ translate('Cấu hình ngay') }}</a>
        </div>
    </div>
@endif
@if(Auth::user()->canDo('1'))
<div class="row gutters-10">
    <div class="col-lg-12">
        <div class="row gutters-10">
            <div class="col-md-3">
                <div class="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Tổng cộng') }}</span>
                            {{ translate('Danh mục') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ \App\BlogCategory::where('status', 1)->count() }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-grad-4 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Tổng cộng') }}</span>
                            {{ translate('Bài viết') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ \App\Blog::where('status', 1)->count() }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-grad-2 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Tổng cộng') }}</span>
                            {{ translate('Tổ chức') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ $total_organizations }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col-md">
                <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Tổng cộng') }}</span>
                            {{ translate('Chương trình') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ $total_programs }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col-md">
                <div class="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Đang chờ') }}</span>
                            {{ translate('Chương trình') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ $pending_programs_count }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')
<div class="row gutters-10">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fs-14">{{ translate('Các chương trình đang chờ phê duyệt') }}</h6>
                <a href="{{ route('programs.index', ['status' => 'pending']) }}" class="btn btn-sm btn-primary">{{ translate('Xem tất cả') }}</a>
            </div>
            <div class="card-body">
                <table class="table mb-0 aiz-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{translate('Tên')}}</th>
                            <th>{{translate('Tổ chức')}}</th>
                            <th>{{translate('Trạng thái')}}</th>
                            <th>{{translate('Ngày tạo')}}</th>
                            <th class="text-right">{{translate('Tùy chọn')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pending_programs as $key => $program)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $program->name }}</td>
                            <td>{{ $program->organization ? $program->organization->org_name : '--' }}</td>
                            <td>
                                <span class="badge badge-inline badge-warning">{{ translate('Đang chờ') }}</span>
                            </td>
                            <td>{{ $program->created_at->format('Y-m-d H:i') }}</td>
                            <td class="text-right">
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('programs.edit', $program->id) }}" title="{{ translate('Chỉnh sửa / Phê duyệt') }}">
                                    <i class="las la-pen"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @if(count($pending_programs) == 0)
                            <tr>
                                <td colspan="6" class="text-center">{{ translate('Không có chương trình đang chờ') }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row gutters-10">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0 fs-14">{{ translate('Top 10 chương trình có người tham gia nhiều nhất') }}</h6>
            </div>
            <div class="card-body">
                <table class="table mb-0 aiz-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{translate('Tên')}}</th>
                            <th>{{translate('Tổ chức')}}</th>
                            <th data-breakpoints="sm">{{translate('Tổng người tham gia')}}</th>
                            <th data-breakpoints="sm">{{translate('Thời gian bắt đầu')}}</th>
                            <th data-breakpoints="sm">{{translate('Trạng thái')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($top_programs as $key => $program)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $program->name }}</td>
                            <td>{{ $program->organization ? $program->organization->org_name : '--' }}</td>
                            <td>
                                <span class="badge badge-inline badge-info">{{ $program->donation_records_count }}</span>
                            </td>
                            <td>{{ $program->start_time ? $program->start_time->format('Y-m-d H:i') : '--' }}</td>
                            <td>
                                @if($program->status == 'activated')
                                    <span class="badge badge-inline badge-success">{{ translate('Đã kích hoạt') }}</span>
                                @elseif($program->status == 'pending')
                                    <span class="badge badge-inline badge-warning">{{ translate('Đang chờ') }}</span>
                                @else
                                    <span class="badge badge-inline badge-danger">{{ translate('Ngừng hoạt động') }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row gutters-10">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0 fs-14">{{ translate('Top 15 bài viết tin tức mới nhất') }}</h6>
            </div>
            <div class="card-body">
                <table class="table mb-0 aiz-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{translate('Tên')}}</th>
                            <th>{{translate('Danh mục')}}</th>
                            <th data-breakpoints="sm">{{translate('Ngày đăng')}}</th>
                            <th data-breakpoints="sm">{{translate('Tác giả')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list_posts as $key => $post)
                        <tr>
                            <td>{{ ($key+1) + ($list_posts->currentPage() - 1) * $list_posts->perPage() }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category ? $post->category->category_name : '--' }}</td>
                            <td>{{ $post->published_date ? utcToLocalTime($post->published_date) : '--' }}</td>
                            <td>{{ $post->author ? $post->author->name : '--' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection