@extends('frontend.layouts.app')

@section('content')

        <section class="page-header" data-stellar-background-ratio="1.2">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12 text-center">

                        <h3>
                            Danh sách chiến dịch
                        </h3>

                        <p class="page-breadcrumb">
                            <a href="{{ route('home') }}">Trang chủ</a> / Tất cả chiến dịch
                        </p>


                    </div>

                </div> <!-- end .row  -->

            </div> <!-- end .container  -->

        </section> <!-- end .page-header  -->

        <!--  MAIN CONTENT  -->

        <!--  SECTION CAMPAIGNS   -->

        <section class="section-content-block section-secondary-bg" >

            <div class="container">

                <div class="row section-heading-wrapper">

                    <div class="col-md-12 col-sm-12 text-left no-img-separator">
                        <h2>TẤT CẢ CHIẾN DỊCH</h2>
                        <span class="heading-separator heading-separator-horizontal"></span>
                        <h4>Khuyến khích những người hiến máu mới tham gia và tiếp tục hiến máu. Chúng tôi có tổng cộng sáu mươi nghìn trung tâm hiến máu và ghé thăm hàng nghìn địa điểm khác vào các dịp khác nhau. </h4>
                    </div> <!-- end .col-sm-12  -->                       

                </div> <!-- end .row  -->
                
                <div class="row margin-top-48">
                    @if($programs->count() > 0)
                        @foreach($programs as $program)
                            <div class="col-md-6 col-sm-12">
                                <div class="event-layout-1 theme-custom-box-shadow clearfix"> 
                                    <figure class="event-img">
                                        <a href="{{ route('detail_campaign', ['slug' => $program->slug ?? $program->id]) }}">
                                            <img src="{{ uploaded_asset($program->banner) }}" alt="{{ $program->name }}">
                                        </a>
                                    </figure>
                                    <div class="event-info"> 
                                        <a class="event-date" href="#"><i class="fa fa-calendar-o"></i> {{ $program->start_time ? $program->start_time->format('d F, Y') : '' }}</a>
                                        <h4>
                                            <a href="{{ route('detail_campaign', ['slug' => $program->slug ?? $program->id]) }}">{{ $program->name }}</a>
                                        </h4>
                                        <div class="event-exceprt">{!! $program->short_description !!}</div>
                                        <div class="event-time">
                                            <a href="#"><i class="fa fa-clock-o"></i> {{ $program->start_time ? $program->start_time->format('H:i') : '' }} - {{ $program->end_time ? $program->end_time->format('H:i') : '' }}</a>
                                            <a href="#"> <i class="fa fa-map-marker"></i> {{ $program->location }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12 text-center">
                            <p>{{ translate('Hiện tại chưa có chiến dịch nào.') }}</p>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="blog-pagination text-center clearfix">                
                            {{ $programs->links() }}
                        </div> 
                    </div>
                </div>

            </div> <!--  end .container  --> 

        </section>

        <!-- SECTION CTA  -->   

        <section class="cta-section-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h2>Chúng tôi đã giúp đỡ mọi người được 40 năm</h2>
                        <p>
                            Bạn có thể hiến máu tại bất kỳ địa điểm hiến máu nào của chúng tôi trên khắp thế giới. Chúng tôi có tổng cộng sáu mươi nghìn trung tâm hiến máu và ghé thăm hàng nghìn địa điểm khác vào các dịp khác nhau.                            
                        </p>
                        <a class="btn btn-theme btn-theme-invert margin-top-24" href="#">TRỞ THÀNH TÌNH NGUYỆN VIÊN</a>
                    </div> <!--  end .col-md-8  -->
                </div> <!--  end .row  -->
            </div>
        </section> 

        <!-- CLIENT LOGO SECTION  -->

        <section class="section-content-block section-secondary-bg">

            <div class="container wow fadeInUp">
                
                <div class="row section-heading-wrapper">

                    <div class="col-md-12 col-sm-12 text-center no-img-separator">
                        <h2>Nhà tài trợ của chúng tôi</h2>
                        <span class="heading-separator"></span>
                        <h4>Những nhà tài trợ đã đóng góp giá trị quý báu để hoàn thành sứ mệnh của chúng tôi.</h4>
                    </div> <!-- end .col-sm-10  -->                      

                </div> <!-- end .row  -->


                <div class="row">

                    <div class="logo-items owl-carousel logo-layout-1 text-center">

                        <div class="client-logo">
                            <img src="{{ static_asset('assets/frontend/images/logo_1.jpg') }}" alt="" />
                        </div>

                        <div class="client-logo">
                            <img src="{{ static_asset('assets/frontend/images/logo_2.jpg') }}" alt="" />
                        </div>

                        <div class="client-logo">
                            <img src="{{ static_asset('assets/frontend/images/logo_3.jpg') }}" alt="" />
                        </div>

                        <div class="client-logo">
                            <img src="{{ static_asset('assets/frontend/images/logo_4.jpg') }}" alt="" />
                        </div>

                        <div class="client-logo">
                            <img src="{{ static_asset('assets/frontend/images/logo_5.jpg') }}" alt="" />
                        </div>

                        <div class="client-logo">
                            <img src="{{ static_asset('assets/frontend/images/logo_6.jpg') }}" alt="" />
                        </div>

                        <div class="client-logo">
                            <img src="{{ static_asset('assets/frontend/images/logo_7.jpg') }}" alt="" />
                        </div>

                        <div class="client-logo">
                            <img src="{{ static_asset('assets/frontend/images/logo_8.jpg') }}" alt="" />
                        </div>

                    </div> <!-- end .testimonial-container  -->

                </div> <!-- end row  -->

            </div> <!-- end .container  -->

        </section> <!--  end .section-client-logo -->

@endsection