@extends('frontend.layouts.app')

@section('content')

        <!--  PAGE HEADING -->

        <section class="page-header">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12 text-center">

                        <h3>
                            Giới thiệu
                        </h3>

                        <p class="page-breadcrumb">
                            <a href="{{ route('home') }}">Trang chủ</a> / Giới thiệu
                        </p>


                    </div>

                </div> <!-- end .row  -->

            </div> <!-- end .container  -->

        </section> <!-- end .page-header  -->
        
        <!--  FEATURED ABOUT US SECTION-->

        <section class="section-content-block">
 
            <div class="container">
                
                <div class="row">

                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        
                        <div class="about-us-container theme-custom-box-shadow">

                            <div class="row section-heading-wrapper margin-bottom-11">

                                <div class="col-lg-12 col-md-12 col-sm-12 text-left no-img-separator">
                                    <h2><strong>{!! $title !!}</strong></h2>
                                    <span class="heading-separator heading-separator-horizontal"></span>
                                </div> <!-- end .col-sm-10  --> 

                            </div>

                            <div class="about-details"> 

                                {!! $description !!}
                                {!! $content !!}

                            </div> <!--  end .about-details -->  

                        </div>

                    </div> <!--  end .col-lg-6 col-md-6 col-sm-12 col-xs-12 -->  


                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                        <figure class="about-img theme-custom-box-shadow">
                            <a class="venobox wow bounceIn" data-vbtype="video" data-autoplay="true" href="https://www.youtube.com/watch?v=nrJtHemSPW4"><i class="fa fa-play"></i></a>                                
                            <img src="{{ static_asset('assets/frontend/images/about_feat_bg.jpg') }}" alt="about" />
                        </figure> <!-- end .cause-img  -->

                    </div> <!--  end .col-lg-6 col-md-6 col-sm-12 col-xs-12  -->                    

                </div> <!--  end .row  -->
            </div>

        </section> <!--  end .section-about-us -->
        <!--  COUNTER SECTION 02  -->
        
        <section class="section-content-block section-secondary-bg" >

            <div class="container wow fadeInUp">
                
                <div class="row section-heading-wrapper">

                    <div class="col-md-12 col-sm-12 text-center">
                        <h2>THÀNH TỰU CỦA CHÚNG TÔI</h2>   
                        <h4>Chúng tôi đã làm việc từ năm 1973 với tầm nhìn cao cả là giúp đỡ bệnh nhân bằng cách cung cấp nguồn máu.</h4>
                    </div> <!-- end .col-sm-12  --> 
                    
                </div>
                
                <div class="row">

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                        <div class="counter-block-1 text-left">

                            <i class="fa fa-heartbeat icon"></i>
                            <span class="counter">2578</span>                            
                            <h4 class="text-capitalize">Nụ cười thành công</h4>

                        </div>

                    </div> <!--  end .col-lg-3  -->

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                        <div class="counter-block-1 text-left">

                            <i class="fa fa-stethoscope icon"></i>
                            <span class="counter">3235</span>                            
                            <h4 class="text-capitalize">Người hiến máu hạnh phúc</h4>

                        </div>

                    </div> <!--  end .col-lg-3  -->

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                        <div class="counter-block-1 text-left">

                            <i class="fa fa-users icon"></i>
                            <span class="counter">3568</span>                             
                            <h4 class="text-capitalize">Happy Recipient</h4>

                        </div>

                    </div> <!--  end .col-lg-3  -->

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                        <div class="counter-block-1 text-left">

                            <i class="fa fa-building icon"></i>
                            <span class="counter">1364</span>                            
                            <h4 class="text-capitalize">Tổng giải thưởng</h4>

                        </div>

                    </div> <!--  end .col-lg-3  -->


                </div> <!-- end row  -->

            </div> <!--  end .container  -->

        </section>

        <!-- SECTION TESTIMONIAL   -->

        <section class="section-content-block section-custom-bg" data-bg_img="{{ static_asset('assets/frontend/images/testimony_feat_bg.jpg') }}" data-bg_size='cover' data-bg_position='top center' data-bg_opacity="0">
            
            <div class="container margin-top-80">
                <div class="row section-heading-wrapper-alt">

                    <div class="col-md-12 col-sm-12 text-center no-img-separator">
                        <h4>Những lời chúc tuyệt vời từ các thành viên</h4>
                        <span class="heading-separator heading-separator-horizontal"></span>
                        <h2 class="extra-large">THAM GIA CÙNG CHÚNG TÔI VÀ CỨU SỐNG NGƯỜI KHÁC</h2>

                    </div> <!-- end .col-sm-10  --> 

                </div>
            </div>

            <div class="container theme-custom-box-shadow  section-pure-white-bg margin-top-48 margin-bottom-48 wow fadeInUp">
                
                <div class="row">

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        
                        <div class="testimonial-container owl-carousel text-left" data-items  ="1">

                            <div class="col-md-12 col-sm-12">

                                <div class="testimony-layout-1">
                                    <h3 class="people-quote">Ý kiến người hiến máu</h3>
                                    <p class="testimony-text">
                                        Tôi tự hào hiến máu thường xuyên vì nó cung cấp cho người khác thứ họ thực sự cần để tồn tại. Biết rằng tôi có thể tạo ra sự khác biệt trong cuộc sống của ai đó khiến tôi cảm thấy tuyệt vời!      
                                    </p>
                                    
                                    <img src="{{ static_asset('assets/frontend/images/user_1.jpg') }}" alt="" />
                                    <h6>Brandon Munson</h6>
                                    <span>CTO, Fulcrum Design, USA</span>

                                </div> <!-- end .testimony-layout-1  -->

                            </div> <!--  end col-md-10  -->

                            <div class="col-md-12 col-sm-12">

                                <div class="testimony-layout-1">
                                    <h3 class="people-quote">Ý kiến người hiến máu</h3>
                                    <p class="testimony-text">
                                        Tôi đã là người hiến máu từ thời trung học. Mặc dù không hiến máu hàng năm, tôi luôn muốn cống hiến cho nhân loại. Tôi thích giúp đỡ người khác! Hơn nữa, nó mang lại sự bình yên thực sự trong tâm hồn tôi.   
                                    </p>

                                    <img src="{{ static_asset('assets/frontend/images/user_2.jpg') }}" alt="" />
                                    <h6>Munson Brandon</h6>
                                    <span>CTO, Fulcrum Design, USA</span>

                                </div> <!-- end .testimony-layout-1  -->

                            </div> <!--  end col-md-10  -->

                            <div class="col-md-12 col-sm-12">

                                <div class="testimony-layout-1">
                                    <h3 class="people-quote">Ý kiến người nhận máu</h3>
                                    <p class="testimony-text">
                                        Tôi ước mình có thể nói với người hiến máu rằng tôi biết ơn hành động quên mình của bạn như thế nào. Bạn đã cho tôi cuộc sống mới. Chúng ta có thể là đồng nghiệp, bạn học hoặc chỉ là hai người trong cùng một cộng đồng. Tôi rất biết ơn bạn.  
                                    </p>

                                    <img src="{{ static_asset('assets/frontend/images/user_3.jpg') }}" alt="" />
                                    <h6>Logan Munson</h6>
                                    <span>CTO, Fulcrum Design, USA</span>

                                </div> <!-- end .testimony-layout-1  -->

                            </div> <!--  end col-md-10  --> 

                        </div>  <!--  end .row  -->   
                    </div>
                
                    <div class="col-lg-6 hidden-md hidden-xs hidden-sm no-padding">
                        <figure>
                            <img src="{{ static_asset('assets/frontend/images/testimony_feat_img.jpg') }}" alt="" class="db"/>
                        </figure>
                    </div>
                    
                </div>

                

            </div> <!-- end .container  -->

        </section>

        <!-- HIGHLIGHT CTA  -->   

        <section class="cta-section-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <h2>Chúng tôi đã giúp đỡ mọi người được 40 năm</h2>
                        <p>
                            Bạn có thể hiến máu tại bất kỳ địa điểm hiến máu nào của chúng tôi trên khắp thế giới. Chúng tôi có tổng cộng sáu mươi nghìn trung tâm hiến máu và ghé thăm hàng nghìn địa điểm khác vào các dịp khác nhau.                            
                        </p>
                    </div> <!--  end .col-md-8  -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <a class="btn btn-cta-1 wow bounceIn" href="#">Yêu cầu đặt hẹn</a>
                    </div> <!--  end .col-md-4  -->
                </div> <!--  end .row  -->
            </div>
        </section> 

@endsection