@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('Liên hệ')}}</h1>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Tin nhắn liên hệ')}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th>{{translate('Họ tên')}}</th>
                    <th>{{translate('Email')}}</th>
                    <th data-breakpoints="lg">{{translate('Tiêu đề')}}</th>
                    <th data-breakpoints="lg">{{translate('Nội dung')}}</th>
                    <th data-breakpoints="lg">{{translate('Ngày gửi')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $key => $contact)
                    @if($contact->name || $contact->email)
                    <tr>
                        <td>{{ ($key+1) + ($contacts->currentPage() - 1)*$contacts->perPage() }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->subject }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>{{ $contact->created_at }}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $contacts->links() }}
        </div>
    </div>
</div>

@endsection
