<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{ $meta_title }}</title>
<!--// Responsive //-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<link rel="shortcut icon" href="{{ Request::root() }}/assets/images/favicon.ico"/>
<meta name="description" content="{{ $meta_description }}">
<meta name="keywords" content="{{ $meta_keywords }}">
<meta name="author" content="Dr Porn">
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}"/>
<meta property="og:type" content="website"/>
<meta property="og:image" content="{{ Request::root() }}"/>

<!--// Stylesheets //-->
<link href="{{ Request::root() }}/assets/theme_css/bootstrap.css" rel="stylesheet" media="screen" />
<link href="{{ Request::root() }}/assets/theme_css/style.css" rel="stylesheet" media="screen" />

<link href="{{ Request::root() }}/favicon.ico" rel="icon" type="image/x-icon" />
<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script type="text/javascript" src="js/respond.min.js"></script>
<![endif]-->

  <script type="text/javascript">

        /*
         *
         * Global Namespace
         *
         * base_url: for .js files that need the base url
         *
         *
         *
         */
        var starfuck = {

            'base_url'   : '{{ Request::root() }}'

        }//base url



    </script>

</head>
<body>
<!-- Wrapper Start -->
<div class="wrapper">
    <!-- Header Start -->
    <header>
        <!-- Header Top Strip Start -->
        <div class="topstrip">
            <div class="custom-container">
                <div class="row">
                    <!-- Top Categories Start -->
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                        <div class="topcategories">
                            <!-- navbar Start -->
                            <div class="navbar yamm navbar-default">
                                <div class="navbar-header">
                                    <button type="button" data-toggle="collapse" data-target="#navbar-collapse-2" class="navbar-toggle">
                                        <i class="fa fa-bars"></i> Starfuck Featured
                                    </button>
                                </div>
                                <div id="navbar-collapse-2" class="navbar-collapse collapse">
                                    <ul class="nav navbar-nav">
                                        <li><strong style="font-size:16px;">Starfuck Featured:&nbsp;&nbsp;</strong></li>
                                        <li><a href="{{ Request::root() }}/movie/category/29/teen">Teen videos</a></li>
                                        <li><a href="{{ Request::root() }}/photo-category/1/amateur">Amateur photos</a></li>
                                        <li><a href="video-list.html">Sport</a></li>
                                        <li><a href="video-list.html">News</a></li>
                                        <li><a href="video-list.html">Arts</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- Top Categories End -->
     
                </div>
            </div>
        </div>
        <!-- Header Top Strip End -->
        <!-- Logo + Search + Advertisment Start -->
        <div class="logobar">
            <div class="custom-container">
                <div class="row">
                    <!-- Logo Start -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="logo">
                            <a href="{{ Request::root() }}"><img src="{{ Request::root() }}/assets/images/logo.png" onmouseover="hover_l(this);" onmouseout="unhover_l(this);" alt="Starfuck logo" /></a>
                        </div>
                    </div>
                    <!-- Logo End -->
                    <!-- Search Start -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="searchbox">
                            {{ Form::open(array('url' => 'movies-search','method' => 'GET')) }}
                                <ul>
                                    <li><input type="text" name="search" placeholder="Search Videos" /></li>
                                    <li class="pull-right"><input type="submit" value="GO" /></li>
                                </ul>
                            </form>
                        </div>
                    </div>
                    <!-- Search End -->
                    <!-- Advertisment Start -->
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <figure class="header-adv">
                            <a href="#"><img src="{{ Request::root() }}/assets/images/adv.gif" class="img-responsive" alt="Advertisment" /></a>
                        </figure>
                    </div>
                    <!-- Advertisment End -->
                </div>
            </div>
        </div>
        <!-- Logo + Search + Advertisment End -->
        <!-- Navigation Strip Start -->
        <div class="navigationstrip stickynav bordercolor-top">
            <div class="custom-container">
                <div class="row">
                    <!-- Navigation Start -->
                    <div class="col-lg-10 col-md-9 col-sm-6 col-xs-4">
                        <div class="navigation">
                            <!-- navbar Start -->
                            <div class="navbar yamm navbar-default">
                                <div class="row">
                                    <div class="navbar-header">
                                        <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle">
                                            <i class="fa fa-bars"></i> Menu
                                        </button>
                                    </div>
                                    <div id="navbar-collapse-1" class="navbar-collapse collapse">
                                        <ul class="nav navbar-nav">
                                            <!-- Home Page Styles Start -->
                                            <li class="dropdown">
                                                <a href="index.html" data-toggle="dropdown" class="dropdown-toggle">Video Categories</a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <!-- Content container to add padding -->
                                                         <!-- Content container to add padding -->
                                                        <div class="yamm-content">
                                                            <div class="row">
                                                             @foreach($categories as $c)
                                                                <div class="col-lg-2 col-md-5 col-sm-12 col-xs-12">
                                                        
                                                                  <ul class="list-unstyled col-md-4">
                                                                  
                                                                        <li><a href="{{ Request::root() }}/movie/category/{{ $c->cat_id }}/{{ $c->cat_url }}">{{$c->name}}</a></li>
                                                                    
                                                                    </ul>
                                                                </div>

                                                             @endforeach

                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <!-- Home Page Styles End -->
                                        
                                            <!-- Gallery Start -->
                                            <li class="dropdown">
                                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Photo Gallery Categories</a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <!-- Content container to add padding -->
                                                        <div class="yamm-content">
                                                            <div class="row">
                                                            @foreach($photo_categories as $pc)
                                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                    <ul class="list-unstyled">
                                                                        <li><a href="{{ Request::root() }}/photo-category/{{ $pc->id }}/{{ $pc->url }}">{{ $pc->name }}</a></li>
                                                                    </ul>
                                                                </div>
                                                            @endforeach 
                                                                
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                                </ul>
                                            </li>
                                            <!-- Gallery End -->
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <!-- navbar End -->
                        </div>
                    </div>
                    <!-- Navigation End -->
                </div>
            </div>
        </div>
        <!-- Navigation Strip End -->
    </header>
    <!-- Header End -->



@yield('header')


@section('footer_js')

<!-- ////////////////////////////////// -->
<!-- //      Javascript Files        // -->
<!-- ////////////////////////////////// -->
<script type="text/javascript" src="{{ Request::root() }}/assets/theme_js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="{{ Request::root() }}/assets/theme_js/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ Request::root() }}/assets/theme_js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ Request::root() }}/assets/theme_js/functions.js"></script>
<script type="text/javascript" src="{{ Request::root() }}/assets/theme_js/responsiveCarousel.js"></script>
<script type="text/javascript" src="{{ Request::root() }}/assets/theme_js/slimbox2.js"></script>

<script type="text/javascript">
    
//Logo
  function hover_l(element) {
    element.setAttribute('src', starfuck.base_url+'/assets/images/logo-hover.png');
  }
  function unhover_l(element) {
    element.setAttribute('src', starfuck.base_url+'/assets/images/logo.png');
  }

</script>

@show

</body>
</html>