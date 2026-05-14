<div class="appointment-form-wrapper theme-custom-box-shadow text-center clearfix wow zoomIn">
    <h3 class="join-heading join-heading-alt">{{ translate('Yêu cầu đặt hẹn') }}</h3>
    <form class="appoinment-form" action="{{ route('appointment.store') }}" method="POST">
        @csrf
        <input type="hidden" name="email_subject" value="Yêu cầu hẹn lịch">
        
        <div class="form-group col-md-6">
            <input name="user_name" class="form-control" placeholder="{{ translate('Tên') }}" type="text" required>
        </div>
        <div class="form-group col-md-6">
            <input name="user_email" class="form-control" placeholder="{{ translate('Email') }}" type="email" required>
        </div>
        <div class="form-group col-md-6">
            <input name="user_phone" class="form-control" placeholder="{{ translate('Số điện thoại') }}" type="text">
        </div>
        <div class="form-group col-md-6">
            <div class="select-style">                                    
                <select class="form-control" name="program_id">
                    <option value="">{{ translate('Chọn chiến dịch') }}</option>
                    @php
                        $programs = \App\Program::where('status', 1)->where('end_time', '>=', now())->get();
                    @endphp
                    @foreach($programs as $program)
                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <textarea name="email_message" class="form-control" rows="4" placeholder="{{ translate('Lời nhắn của bạn...') }}"></textarea>
        </div>         

        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <button class="btn btn-theme" type="submit">{{ translate('Đặt hẹn ngay') }}</button>
        </div>

    </form>
</div> <!-- end .appointment-form-wrapper  -->
