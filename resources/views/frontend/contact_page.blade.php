@extends('frontend.layouts.app')

@section('content')

        <!--  PAGE HEADING -->

        <section class="page-header" data-stellar-background-ratio="1.2">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12 text-center">


                        <h3>
                            Liên hệ với chúng tôi
                        </h3>

                        <p class="page-breadcrumb">
                            <a href="{{ route('home') }}">Trang chủ</a> / Liên hệ
                        </p>


                    </div>

                </div> <!-- end .row  -->

            </div> <!-- end .container  -->

        </section> <!-- end .page-header  -->

        <!--  MAIN CONTENT  -->

        <section class="section-content-block">

            <div class="container">

                <div class="row">

                    <div class ="col-md-12">
                        <h2 class="contact-title">Liên hệ</h2>                           
                    </div>               

                    <div class="col-md-3">

                        <ul class="contact-info">
                            <li>
                                <span class="icon-container"><i class="fa fa-home"></i></span>
                                <address>{{ get_setting('contact_address') }}</address>
                            </li>
                        </ul>                        

                    </div>

                    <div class="col-md-3">

                        <ul class="contact-info">

                            <li>
                                <span class="icon-container"><i class="fa fa-phone"></i></span>
                                <address><a href="tel:{{ get_setting('contact_phone') }}">{{ get_setting('contact_phone') }}</a></address>
                            </li>

                        </ul>                        

                    </div>

                    <div class="col-md-3">
                        <ul class="contact-info">
                            <li>
                                <span class="icon-container"><i class="fa fa-envelope"></i></span>
                                <address><a href="mailto:{{ get_setting('contact_email') }}">{{ get_setting('contact_email') }}</a></address>
                            </li>
                        </ul>                        

                    </div>

                    <div class="col-md-3">

                        <ul class="contact-info">
                            <li>
                                <span class="icon-container"><i class="fa fa-globe"></i></span>
                                <address><a href="{{ route('home') }}">{{ str_replace(['http://', 'https://'], '', url('/')) }}</a></address>
                            </li>
                        </ul>                        

                    </div>                    

                </div> 

            </div>

        </section>

        <section class="section-content-block section-secondary-bg">

            <div class="container">

                <div class="row">

                    <div class="col-sm-6 wow fadeInLeft">

                        <div class="contact-form-block">

                            <h2 class="contact-title">Gửi lời chào đến chúng tôi</h2>

                            <form role="form" action="{{ route('contact.store') }}" method="post" id="contact-form">
                                @csrf

                                <div class="form-group">
                                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Tên" data-msg="Vui lòng viết tên của bạn" />
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email" data-msg="Vui lòng viết email hợp lệ của bạn" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email_subject" name="email_subject" placeholder="Tiêu đề" data-msg="Vui lòng viết tiêu đề tin nhắn của bạn" />
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control" rows="5" name="email_message" id="email_message" placeholder="Tin nhắn" data-msg="Vui lòng viết tin nhắn của bạn" ></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-theme">Gửi ngay</button>
                                </div>

                            </form>

                        </div> <!-- end .contact-form-block  -->

                    </div> <!--  end col-sm-6  -->

                    <div class="col-sm-6 wow fadeInRight">

                        <h2 class="contact-title">Vị trí của chúng tôi</h2>


                        <div class="section-google-map-block wow fadeInUp">

                            <div id="map_canvas"></div>

                        </div> <!-- end .section-content-block  -->                            

                    </div> <!--  end col-sm-6  -->                    

                </div> <!-- end row  -->

            </div> <!--  end .container -->

        </section> <!-- end .section-content-block  -->

@endsection