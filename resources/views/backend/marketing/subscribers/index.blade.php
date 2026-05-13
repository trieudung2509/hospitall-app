@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('All Subscribers')}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Name')}}</th>
                    <th>{{translate('Phone')}}</th>
                    <th>{{translate('Email')}}</th>
                    <th data-breakpoints="lg">{{translate('Message')}}</th>
                    <th data-breakpoints="lg">{{translate('File')}}</th>
                    <th>{{translate('Date')}}</th>
                    <th class="text-right">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscribers as $key => $subscriber)
                <?php 
                    $file = \App\Upload::where('id', $subscriber->file_id)->select('id', 'file_original_name', 'extension')->first();
                ?>
                  <tr>
                      <td>{{ ($key+1) + ($subscribers->currentPage() - 1)*$subscribers->perPage() }}</td>
				      <td>{{ $subscriber->first_name }} {{ $subscriber->last_name }}</td>
                      <td>{{ $subscriber->phone_number }}</td>
                      <td><div class="text-truncate">{{ $subscriber->email }}</div></td>
                      <td>{{ $subscriber->message }}</td>
                      <td>
                        @if ($file != null)
                            <a href="{{ uploaded_asset($subscriber->file_id) }}"  download>
                                {{ $file->file_original_name.'.'.$file->extension }}
                            </a>
                        @endif 
                      </td>
                      <td>{{ date('d-m-Y', strtotime($subscriber->created_at)) }}</td>
                      <td class="text-right">
                          <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('subscriber.destroy', $subscriber->id)}}" title="{{ translate('Delete') }}">
                              <i class="las la-trash"></i>
                          </a>
                      </td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $subscribers->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
