@extends('frontend.layouts.app')

@section('content')

        <section class="page-header" data-stellar-background-ratio="1.2">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12 text-center">


                        <h3>
                            Chi tiết sự kiện
                        </h3>

                        <p class="page-breadcrumb">
                            <a href="{{ route('home') }}">Trang chủ</a> / <a href="{{ route('campaign') }}">Sự kiện</a> / Chi tiết sự kiện
                        </p>


                    </div>

                </div> <!-- end .row  -->

            </div> <!-- end .container  -->

        </section> <!-- end .page-header  -->

        <section class="section-content-block">

            <div class="container">

                <div class="row">

                    <div class="article-event clearfix">

                        <div class="col-sm-12">

                            <article class="post single-post-inner">

                                <div class="post-inner-featured-content">
                                    <img alt="{{ $program->name }}" src="{{ uploaded_asset($program->banner) }}">
                                </div>


                                <div class="single-post-inner-title">
                                    <h2>{{ $program->name }}</h2>
                                    <p class="single-post-meta"><i class="fa fa-user"></i>&nbsp; {{ optional($program->author)->name }} &nbsp; &nbsp; <i class="fa fa-calendar"></i>&nbsp; {{ $program->start_time->format('d F, Y') }}</p>
                                </div>

                                <div class="single-post-inner-content">
                                    {!! $program->description !!}
                                </div>


                            </article> <!--  end single-post-container --> 


                        </div> <!--  end .single-post-container -->

                        <div class="col-sm-4">

                            <h4 class="event-content-title">Chi tiết</h4>

                            <p class="event-content-info">

                                <span class="event-sub-content-title">Ngày:  <em class="date">{{ $program->start_time->format('d F, Y') }}</em></span>

                                <span class="event-sub-content-title">Chi phí:</span>
                                Miễn phí 
                                <span class="event-sub-content-title">Thời gian:</span>
                                {{ $program->start_time->format('H:i') }} - {{ $program->end_time->format('H:i') }}
                                <a href="{{ route('home') }}" title="{{ get_setting('website_name') }}">{{ get_setting('website_name') }}</a> 
                            </p>
                        </div> <!-- end .col-sm-4  -->

                        <div class="col-sm-4">

                            <h4 class="event-content-title">Người tổ chức</h4>

                            <p class="event-content-info">
                                {{ optional($program->organization)->org_name }} <br />
                                <span class="event-sub-content-title">Điện thoại:</span>
                                {{ optional($program->organization)->contact_phone }}  <br />
                                <span class="event-sub-content-title">Email:</span>
                                <a href="mailto:{{ optional($program->organization)->contact_email }}" title="{{ optional($program->organization)->contact_email }}">{{ optional($program->organization)->contact_email }}</a>
                                <span class="event-sub-content-title">Loại:</span>
                                {{ optional($program->organization)->org_type }}
                            </p>  

                        </div> <!-- end .col-sm-4  -->

                        <div class="col-sm-4">

                            <h4 class="event-content-title">Địa điểm</h4>

                            <p class="event-content-info">
                                {{ $program->location }} <br />
                                <span class="event-sub-content-title">Bản đồ:</span>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($program->location) }}" target="_blank">Xem trên Google Maps</a>
                            </p>


                        </div> <!-- end .col-sm-4  -->

                    </div>

                    <div class="article-author clearfix">

                        <div class="col-sm-12">
                            @if($program->google_map)
                                <div class="map-responsive">
                                    @if(str_contains($program->google_map, '<iframe'))
                                        {!! $program->google_map !!}
                                    @else
                                        @php
                                            $map_input = trim($program->google_map);
                                            // If it's a link (starts with http), we try to use the 'location' field if available for better pinning, 
                                            // otherwise use the input itself.
                                            $query = (filter_var($map_input, FILTER_VALIDATE_URL) && $program->location) ? $program->location : $map_input;
                                            $embed_url = "https://maps.google.com/maps?q=" . urlencode($query) . "&output=embed";
                                        @endphp
                                        <iframe src="{{ $embed_url }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    @endif
                                </div>
                                <style>
                                    .map-responsive {
                                        overflow:hidden;
                                        padding-bottom:56.25%;
                                        position:relative;
                                        height:0;
                                        margin-bottom: 20px;
                                    }
                                    .map-responsive iframe {
                                        left:0;
                                        top:0;
                                        height:100%;
                                        width:100%;
                                        position:absolute;
                                        border: 0;
                                    }
                                </style>
                            @else
                                <div id="map_canvas"></div>
                            @endif
                        </div>

                        </div>

                    </div>

                    <div class="post-nav-section clearfix">
                        @if($next_program)
                            <a class="btn btn-primary fr" href="{{ route('detail_campaign', ['slug' => $next_program->slug ?? $next_program->id]) }}">Sự kiện tiếp theo <i class="fa fa-angle-double-right"></i></a>
                        @endif
                        @if($prev_program)
                            <a class="btn btn-primary" href="{{ route('detail_campaign', ['slug' => $prev_program->slug ?? $prev_program->id]) }}"><i class="fa fa-angle-double-left"></i> Sự kiện trước đó</a>
                        @endif
                    </div> <!-- end .post-nav-section  -->

                </div> <!--  end .row  -->

            </div> <!--  end container -->

        </section> <!-- end .section-content-block  -->   

@endsection