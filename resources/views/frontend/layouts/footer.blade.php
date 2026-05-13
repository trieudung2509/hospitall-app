        <!-- START FOOTER  -->

        <footer>            

            <section class="footer-widget-area footer-widget-area-bg">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <div class="about-footer">

                                <div class="row">

                                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                        <a href="{{ route('home') }}">
                                            <img src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ get_setting('website_name') }}" />
                                        </a>
                                    </div> <!--  end col-lg-3-->

                                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                        <p>
                                            {{ get_setting('about_us_description') }}
                                        </p>
                                    </div> <!--  end .col-lg-9  -->

                                </div> <!--  end .row -->

                            </div> <!--  end .about-footer  -->

                        </div> <!--  end .col-md-12  -->

                    </div> <!--  end .row  -->

                    <div class="row"> 						                      

                        <div class="col-md-4 col-sm-6 col-xs-12">

                            <div class="footer-widget">

                                <div class="sidebar-widget-wrapper">

                                    <div class="footer-widget-header clearfix">
                                        <h3>Liên hệ</h3>
                                    </div>  <!--  end .footer-widget-header --> 


                                    <div class="textwidget">                                       

                                        <i class="fa fa-envelope-o fa-contact"></i> <p><a href="mailto:{{ get_setting('contact_email') }}">{{ get_setting('contact_email') }}</a></p>

                                        <i class="fa fa-location-arrow fa-contact"></i> <p>{{ get_setting('contact_address') }}</p>

                                        <i class="fa fa-phone fa-contact"></i> <p>{{ translate('Hotline') }}:&nbsp; {{ get_setting('contact_phone') }}</p>                              

                                    </div>

                                </div> <!-- end .footer-widget-wrapper  -->

                            </div> <!--  end .footer-widget  -->

                        </div> <!--  end .col-md-4 col-sm-12 -->   

                        <div class="col-md-4 col-sm-12 col-xs-12">

                            <div class="footer-widget clearfix">

                                <div class="sidebar-widget-wrapper">

                                    <div class="footer-widget-header clearfix">
                                        <h3>Liên kết hỗ trợ</h3>
                                    </div>  <!--  end .footer-widget-header --> 


                                    <ul class="footer-useful-links">

                                        <li>
                                            <a href="#">
                                                <i class="fa fa-caret-right fa-footer"></i>
                                                Thalassemia
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="fa fa-caret-right fa-footer"></i>
                                                Cell Elofrosis
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="fa fa-caret-right fa-footer"></i>
                                                Myelodysasia
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="fa fa-caret-right fa-footer"></i>
                                                Blood Count
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="fa fa-caret-right fa-footer"></i>
                                                Hemolytimia
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="fa fa-caret-right fa-footer"></i>
                                                Ychromas Eosis 
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="fa fa-caret-right fa-footer"></i>
                                                Hyrcoagulable
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="fa fa-caret-right fa-footer"></i>
                                                Thrombo Xtosis
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="fa fa-caret-right fa-footer"></i>
                                                Sicklenemiaxs
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="fa fa-caret-right fa-footer"></i>
                                                Aplastic Anemia
                                            </a>
                                        </li>                                       

                                    </ul>

                                </div> <!--  end .footer-widget  -->        

                            </div> <!--  end .footer-widget  -->            

                        </div> <!--  end .col-md-4 col-sm-12 -->    

                        <div class="col-md-4 col-sm-6 col-xs-12">

                            <div class="footer-widget">
                                <div class="sidebar-widget-wrapper">
                                    <div class="footer-widget-header clearfix">
                                        <h3>Đăng ký bản tin</h3>
                                    </div>
                                    <p>Đăng ký nhận bản tin định kỳ và cập nhật tin tức mới nhất từ chúng tôi.</p>
                                    <div class="footer-subscription">
                                        <p>
                                            <input id="mc4wp_email" class="form-control" required="" placeholder="Nhập email của bạn" name="EMAIL" type="email">
                                        </p>
                                        <p>
                                            <input class="btn btn-default" value="Đăng ký ngay" type="submit">
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div> <!--  end .col-md-4 col-sm-12 -->  

                    </div> <!-- end row  -->

                </div> <!-- end .container  -->

            </section> <!--  end .footer-widget-area  -->

            <!--FOOTER CONTENT  -->

            <section class="footer-contents">

                <div class="container">

                    <div class="row clearfix">
                        
                        <div class="col-md-12 col-sm-12 text-center">
                            <p class="copyright-text"> {{ translate('Bản quyền') }} {{ date('Y') }} - {{ get_setting('website_name') }}. {{ translate('Mọi quyền được bảo lưu.') }} </p>
                        </div>  <!-- end .col-sm-6  -->

                    </div> <!-- end .row  -->                                    

                </div> <!--  end .container  -->

            </section> <!--  end .footer-content  -->

        </footer>

        <!-- END FOOTER  -->

        <!-- Back To Top Button  -->

        <a id="backTop">Lên đầu trang</a>

        <script data-cfasync="false" src="{{ static_asset('assets/frontend/js/email-decode.min.js') }}"></script><script src="{{ static_asset('assets/frontend/js/jquery.min.js') }}"></script>
        <script src="{{ static_asset('assets/frontend/js/bootstrap.min.js') }}"></script>
        <script src="{{ static_asset('assets/frontend/js/wow.min.js') }}"></script>
        <script src="{{ static_asset('assets/frontend/js/jquery.backTop.min.js') }}"></script>
        <script src="{{ static_asset('assets/frontend/js/waypoints.min.js') }}"></script>
        <script src="{{ static_asset('assets/frontend/js/waypoints-sticky.min.js') }}"></script>
        <script src="{{ static_asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
        <script src="{{ static_asset('assets/frontend/js/jquery.stellar.min.js') }}"></script>
        <script src="{{ static_asset('assets/frontend/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ static_asset('assets/frontend/js/venobox.min.js') }}"></script>
        <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
        <script src="{{ static_asset('assets/frontend/js/jquery.gmap.min.js') }}"></script>
        <script src="{{ static_asset('assets/frontend/js/custom-scripts.js') }}"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8c78df7c7c0f484497ecbca7046644da1771523124516" integrity="sha512-8DS7rgIrAmghBFwoOTujcf6D9rXvH8xm8JQ1Ja01h9QX8EzXldiszufYa4IFfKdLUKTTrnSFXLDkUEOTrZQ8Qg==" data-cf-beacon='{"version":"2024.11.0","token":"59c6834a8e0e4062a12536ec8dda0772","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
