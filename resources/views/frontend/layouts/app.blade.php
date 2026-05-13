<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <head>
        <meta charset="utf-8">
        <title>Blood Buddies - Blood Donation Campaign & Multi-Concept Activism Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Reddrop Buddies - Blood Donation Campaign & Multi-Concept Activism Template">
        <meta name="author" content="xenioushk">
        <link rel="shortcut icon" href="{{ static_asset('assets/frontend/images/favicon.png') }}" />

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- The styles -->
        <link rel="stylesheet" href="{{ static_asset('assets/frontend/css/bootstrap.min.css') }}" />
        <link href="{{ static_asset('assets/frontend/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ static_asset('assets/frontend/css/animate.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ static_asset('assets/frontend/css/owl.carousel.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ static_asset('assets/frontend/css/venobox.css') }}" rel="stylesheet" type="text/css" >
        <link rel="stylesheet" href="{{ static_asset('assets/frontend/css/styles.css') }}" />

    <body> 

        <div id="preloader">
            <span class="margin-bottom"><img src="{{ static_asset('assets/frontend/images/loader.gif') }}" alt="" /></span>
        </div>

        @include('frontend.layouts.header')

        @yield('content')

        @include('frontend.layouts.footer')

</body>

</html>