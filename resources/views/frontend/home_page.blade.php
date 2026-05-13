@extends('frontend.layouts.app')

@section('content')
        <!--  HOME SLIDER BLOCK  -->
        
        <div class="slider-wrap">
            <div id="slider_1" class="owl-carousel" data-nav="true" data-dots="false" data-autoplay="true" data-autoplaytimeout="17000">

                <div class="slider_item_container" data-bg_img="{{ static_asset('assets/frontend/images/home_1_slider_1.jpg') }}" data-bg_color="#555555" data-bg_opacity="0.0">
                    <div class="item">
                        <div class="slider-content">
                            <div class="container text-left">
                                <div class="row">
                                    <div class="slider-bg">                                    
                                        <div class="col-sm-12 wow zoomInUp" data-wow-duration="1s">  
                                            
                                                <h3>Hiến máu cứu người!</h3>
                                                <h2>
                                                    MÁU CỦA BẠN  
                                                    <br>
                                                    CÓ THỂ MANG LẠI NỤ CƯỜI  
                                                    <br />
                                                    TRÊN KHUÔN MẶT NGƯỜI KHÁC
                                                </h2>
                                                <a href="#" class="btn btn-theme margin-top-24">Hiến máu ngay</a>
                                                <a href="#" class="btn btn-theme btn-theme-invert margin-top-24">GỌI: 411-009-872-333</a>
                                            </div>                                      
                                    </div> <!-- end .col-sm-12  -->
                                </div> <!-- end .row  -->
                            </div><!-- end .container -->
                        </div> <!--  end .slider-content -->
                    </div> <!-- end .item  -->
                </div> <!-- end .slider_item_container  -->

                <div class="slider_item_container" data-bg_img="{{ static_asset('assets/frontend/images/home_1_slider_2.jpg') }}" data-bg_color="#555555" data-bg_opacity="0.0" >
                    <div class="item">
                        <div class="slider-content">
                            <div class="container text-left">
                                <div class="row">
                                    <div class="slider-bg" data-animation-in="zoomInUp" data-animation-out="zoomInDown">                                    
                                        <div class="col-sm-12 wow fadeInDown" data-wow-duration="1s">
                                            
                                            <h3>Hiến máu cứu người!</h3>
                                                <h2>
                                                    HIẾN MÁU
                                                    <br>
                                                    VÀ TRUYỀN CẢM HỨNG CHO NGƯỜI KHÁC.
                                                </h2>
                                                <a href="#" class="btn btn-theme margin-top-24">Hiến máu ngay</a>
                                        </div>                                            
                                    </div> <!-- end .col-sm-12  -->
                                </div> <!-- end .row  -->
                            </div><!-- end .container -->
                        </div> <!--  end .slider-content -->
                    </div> <!-- end .item  -->
                </div> <!-- end .slider_item_container  -->

            </div> <!-- end .slider_1  -->
        </div> <!-- end .slider-wrap.  -->
        
        <!--  FEATURED ABOUT US SECTION-->

        <section class="section-content-block">
 
            <div class="container">
                
                <div class="row">

                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        
                        <div class="about-us-container theme-custom-box-shadow">

                            <div class="row section-heading-wrapper margin-bottom-11">

                                <div class="col-lg-12 col-md-12 col-sm-12 text-left no-img-separator">
                                    <h2><strong>{!! $about_us->title ?? 'Chúng tôi là ai?' !!}</strong></h2>
                                    <span class="heading-separator heading-separator-horizontal"></span>
                                </div> <!-- end .col-sm-10  --> 

                            </div>

                            <div class="about-details"> 

                                {!! $about_us->description ?? '' !!}
                                {!! $about_us->content ?? '' !!}

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
        
        <!-- SECTION TESTIMONIAL   -->

        <section class="section-content-block section-custom-bg" data-bg_img='{{ static_asset('assets/frontend/images/testimony_feat_bg.jpg') }}' data-bg_size='cover' data-bg_position='top center' data-bg_opacity="0">
            
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
        
        <!--  SECTION CAMPAIGNS   -->

        <section class="section-content-block section-pure-white-bg" >

            <div class="container">
                
                
                <div class="row">
                    
                    <div class="col-sm-12 col-md-5">

                        <div class="row section-heading-wrapper">

                            <div class="col-md-12 col-sm-12 text-left no-img-separator">
                                <h2>CÁC CHIẾN DỊCH CỦA CHÚNG TÔI</h2>
                                <span class="heading-separator heading-separator-horizontal"></span>
                                <h4 class="margin-top-24">
                                    
                                    <small>Trên khắp thế giới, chúng tôi đã tổ chức tổng cộng sáu mươi nghìn chiến dịch hiến máu 
                                        và ghé thăm hàng nghìn địa điểm khác vào các dịp khác nhau. </small>
                                </h4>
                                <a class="btn btn-theme margin-top-32" href="{{ route('campaign') }}">Xem tất cả chiến dịch</a>
                            </div> <!-- end .col-sm-12  -->  

                        </div> <!-- end .row  -->

                    </div>

                    <div class="col-sm-12 col-md-7">
                        
                        <div class="row wow fadeInRight">

                            <div class="event-carousel owl-carousel"  data-nav="false" data-dots="true" data-items="1">
                                @foreach ($programs as $program)
                                <div class="col-md-6 col-sm-12">
                                    <div class="event-layout-1 theme-custom-box-shadow clearfix"> 
                                        <figure class="event-img">
                                            <a href="{{ route('detail_campaign', ['slug' => $program->slug ?? $program->id]) }}">
                                                <img src="{{ uploaded_asset($program->banner) }}" alt="{{ $program->name }}">
                                            </a>
                                        </figure>
                                        <div class="event-info"> 
                                            <a class="event-date" href="#"><i class="fa fa-calendar-o"></i> {{ $program->start_time->format('d M, Y') }}</a>
                                            <h4>
                                                <a href="{{ route('detail_campaign', ['slug' => $program->slug ?? $program->id]) }}">{{ $program->name }}</a>
                                            </h4>
                                            <div class="event-exceprt">{!! $program->short_description !!}</div>
                                            <div class="event-time">
                                                <a href="#"><i class="fa fa-clock-o"></i> {{ $program->start_time->format('H:i') }} - {{ $program->end_time->format('H:i') }}</a>
                                                <a href="#"> <i class="fa fa-map-marker"></i> {{ $program->location }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>     
                        </div> 
                        
                    </div>
                    
                </div>

            </div> <!--  end .container  --> 

        </section> 
        
        
        <!--  SECTION APPOINTMENT BOX -->
        
        <section class="section-content-block section-custom-bg section-custom-bg-extra-padding" data-bg_img='{{ static_asset('assets/frontend/images/appointment_female_bg.jpg') }}' data-bg_color='#000000' data-bg_opacity='0.1'>

            <div class="container">
                <div class="custom-empty-space" data-height="160px" data-class="col-sm-hidden"></div>
            </div>

        </section>

        <!--  SECTION APPOINTMENT   -->

        <section class="section-content-block section-secondary-bg">

            <div class="container">

                <div class="row">

                    <div class="col-lg-6 col-md-6"> 
                        
                        <div class="row section-heading-wrapper">

                            <div class="col-md-12 col-sm-12 text-left no-img-separator">
                                <h4>Điều nên biết</h4>
                                <span class="heading-separator heading-separator-horizontal"></span>
                                <h2>Thông tin hữu ích
                                </h2>

                            </div> <!-- end .col-sm-10  --> 

                        </div>

                        <div class="about-details"> 

                            <ul class="custom-bullet-list">
                                <li>Duy trì mức sắt khỏe mạnh bằng cách ăn các thực phẩm giàu sắt.</li>
                                <li>Uống thêm 16 oz. nước trước khi hiến máu.</li>
                                <li>Tránh uống rượu trước khi hiến máu.</li>
                                <li>Nhớ mang theo thẻ người hiến máu hoặc CMND/Hộ chiếu.</li>
                                <li>Cuối cùng, cố gắng có một giấc ngủ ngon sau khi hiến máu.</li>
                            </ul>

                        </div> <!--  end .about-details -->  
               
                    </div> <!--  end col-lg-6  -->


                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-top-appointment-reverse"> 

                        <div class="appointment-form-wrapper theme-custom-box-shadow text-center clearfix wow zoomIn">
                            <h3 class="join-heading join-heading-alt">Yêu cầu đặt hẹn</h3>
                            <form class="appoinment-form"> 
                                <div class="form-group col-md-6">
                                    <input id="your_name" class="form-control" placeholder="Name" type="text">
                                </div>
                                <div class="form-group col-md-6">
                                    <input id="your_email" class="form-control" placeholder="Email" type="email">
                                </div>
                                <div class="form-group col-md-6">
                                    <input id="your_phone" class="form-control" placeholder="Phone" type="text">
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="select-style">                                    
                                        <select class="form-control" name="your_center">
                                            <option>Donation Center</option>
                                            <option>Los Angles</option>
                                            <option>California</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <input id="your_date" class="form-control" placeholder="Date" type="text">
                                </div>


                                <div class="form-group col-md-6">
                                    <input id="your_time" class="form-control" placeholder="Time" type="text">
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <textarea id="textarea_message" class="form-control" rows="4" placeholder="Your Message..."></textarea>
                                </div>         

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <button id="btn_submit" class="btn btn-theme" type="submit">Đặt hẹn ngay</button>
                                </div>

                            </form>

                        </div> <!-- end .appointment-form-wrapper  -->

                    </div> <!--  end .col-lg-6 -->

                </div> <!--  end .row  -->
                
                <div class="row wow fadeIn">

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                        <div class="counter-block-1 text-center">

                            <i class="fa fa-heartbeat icon"></i>
                            <span class="counter">2578</span>                            
                            <h4 class="text-capitalize">Nụ cười thành công</h4>

                        </div>

                    </div> <!--  end .col-lg-3  -->

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                        <div class="counter-block-1 text-center">

                            <i class="fa fa-stethoscope icon"></i>
                            <span class="counter">3235</span>                            
                            <h4 class="text-capitalize">Người hiến máu hạnh phúc</h4>

                        </div>

                    </div> <!--  end .col-lg-3  -->

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                        <div class="counter-block-1 text-center">

                            <i class="fa fa-users icon"></i>
                            <span class="counter">3568</span>                             
                            <h4 class="text-capitalize">Happy Recipient</h4>

                        </div>

                    </div> <!--  end .col-lg-3  -->

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                        <div class="counter-block-1 text-center">

                            <i class="fa fa-building icon"></i>
                            <span class="counter">1364</span>                            
                            <h4 class="text-capitalize">Tổng giải thưởng</h4>

                        </div>

                    </div> <!--  end .col-lg-3  -->


                </div> <!-- end row  -->

            </div> <!--  end .container -->

        </section>  <!--  end .appointment-section  -->
        
        <!-- SECTION TEAM   -->
        <!--  SECTION GALLERY  -->

        <section class="section-content-block section-pure-white-bg">

            <div class="container">

                <div class="row section-heading-wrapper">

                    <div class="col-md-12 col-sm-12 text-center no-img-separator">
                        <h2>BỘ SƯU TẬP CHIẾN DỊCH</h2>
                        <span class="heading-separator"></span>
                        <h4>công việc tình nguyện danh giá của đội ngũ trong các chiến dịch</h4>
                    </div> <!-- end .col-sm-10  -->                      


                </div> <!-- end .row  -->

            </div> <!--  end .container -->

            <div class="container wow fadeInUp">

                <div class="row no-padding-gallery">

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 gallery-container">

                        <a class="gallery-light-box"  data-gall="myGallery" href="{{ static_asset('assets/frontend/images/gallery_1.jpg') }}">

                            <figure class="gallery-img">

                                <img src="{{ static_asset('assets/frontend/images/gallery_1.jpg') }}" alt="gallery image" />

                            </figure> <!-- end .gallery-img  -->

                        </a>

                    </div><!-- end .col-sm-3  -->

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 gallery-container">

                        <a class="gallery-light-box" data-gall="myGallery" href="{{ static_asset('assets/frontend/images/gallery_2.jpg') }}">

                            <figure class="gallery-img">

                                <img src="{{ static_asset('assets/frontend/images/gallery_2.jpg') }}" alt="gallery image" />

                            </figure> <!-- end .gallery-img  -->

                        </a> <!-- end .gallery-light-box  -->

                    </div><!-- end .col-sm-3  -->

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 gallery-container">

                        <a class="gallery-light-box"  data-gall="myGallery" href="{{ static_asset('assets/frontend/images/gallery_3.jpg') }}">

                            <figure class="gallery-img">

                                <img src="{{ static_asset('assets/frontend/images/gallery_3.jpg') }}" alt="gallery image" />

                            </figure> <!-- end .gallery-img  -->

                        </a>

                    </div><!-- end .col-sm-3  -->

                </div> <!-- end .row  -->

                <div class="row no-padding-gallery">

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 gallery-container">

                        <a class="gallery-light-box" data-gall="myGallery" href="{{ static_asset('assets/frontend/images/gallery_4.jpg') }}">

                            <figure class="gallery-img">

                                <img src="{{ static_asset('assets/frontend/images/gallery_4.jpg') }}" alt="gallery image" />

                            </figure> <!-- end .gallery-img  -->

                        </a> <!-- end .gallery-light-box  -->

                    </div><!-- end .col-sm-3  -->

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 gallery-container">

                        <a class="gallery-light-box"  data-gall="myGallery" href="{{ static_asset('assets/frontend/images/gallery_5.jpg') }}">

                            <figure class="gallery-img">

                                <img src="{{ static_asset('assets/frontend/images/gallery_5.jpg') }}" alt="gallery image" />

                            </figure> <!-- end .gallery-img  -->

                        </a>

                    </div><!-- end .col-sm-3  -->

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 gallery-container">

                        <a class="gallery-light-box" data-gall="myGallery" href="{{ static_asset('assets/frontend/images/gallery_6.jpg') }}">

                            <figure class="gallery-img">

                                <img src="{{ static_asset('assets/frontend/images/gallery_6.jpg') }}" alt="gallery image" />

                            </figure> <!-- end .gallery-img  -->

                        </a> <!-- end .gallery-light-box  -->

                    </div><!-- end .col-sm-3  -->

                </div> <!-- end .row  -->

            </div><!-- end .container-fluid  -->

        </section> <!-- end .section-content-block  -->

        <!-- HIGHLIGHT CTA  -->  
        
        <section class="padding-bottom-100 padding-top-0">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="cta-section-1 section-secondary-bg text-center theme-custom-box-shadow">
                            <h2 class="text-capitalize">Trở thành một phần của công việc tuyệt vời ngay hôm nay</h2>
                            <p>
                                Bạn có thể hiến máu tại bất kỳ địa điểm hiến máu nào của chúng tôi trên khắp thế giới. 
                                <br />
                                Chúng tôi có tổng cộng sáu mươi nghìn trung tâm hiến máu và ghé thăm hàng nghìn địa điểm khác vào các dịp khác nhau.                            
                            </p>
                            <a class="btn btn-theme margin-top-24 wow bounceIn" href="#">THAM GIA VỚI CHÚNG TÔI</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
