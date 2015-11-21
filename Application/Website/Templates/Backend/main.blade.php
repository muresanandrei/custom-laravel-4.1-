<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!-- Title and other stuffs -->
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">


    <!-- Stylesheets -->
    <link href="{{ Request::root() }}/assets/admin_theme_css/bootstrap.css" rel="stylesheet">
    <!-- Font awesome icon -->
    <link rel="stylesheet" href="{{ Request::root() }}/assets/admin_theme_css/font-awesome.css">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="{{ Request::root() }}/assets/admin_theme_css/jquery-ui-1.9.2.custom.min.css">

    <!-- Bootstrap toggle -->
    <link rel="stylesheet" href="{{ Request::root() }}/assets/admin_theme_css/bootstrap-switch.css">
    <!-- Main stylesheet -->
    <link href="{{ Request::root() }}/assets/admin_theme_css/style.css" rel="stylesheet">

    <!-- Bootstrap toggle -->
   <link href="{{ Request::root() }}/assets/admin_theme_css/dataTables.bootstrap.css" rel="stylesheet">

   <!--Chosen CSS-->
   <link href="{{ Request::root() }}/assets/chosen/chosen.css" rel="stylesheet">

   <!--Dropzone Css-->
   <link rel="stylesheet" href="{{ Request::root() }}/assets/admin_theme_css/drop-zone.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon/favicon.png">


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
        var webrising = {

            'base_url'   : '{{ Request::root() }}'

        }//base url



    </script>

</head>

<body>
<header>
    <div class="navbar navbar-fixed-top bs-docs-nav" role="banner">

        <div class="container">
            <!-- Menu button for smallar screens -->
            <div class="navbar-header">
                <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse"><span>Menu</span></button>
                <a href="#" class="pull-left menubutton hidden-xs"><i class="fa fa-bars"></i></a>
                <!-- Site name for smallar screens -->
                <a href="{{ Request::root() }}/admin/home" class="navbar-brand"><img src="{{ Request::root() }}/assets/images/logo.png" height="30" /></a>
            </div>

            <!-- Navigation starts -->
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">

                <!-- Links -->
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown pull-right user-data">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    John <span class="bold">Doe</span> <b class="caret"></b>
                        </a>

                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="#"><i class="fa fa-cogs"></i> Settings</a></li>
                            <li><a href="{{ Request::root() }}/logout"><i class="fa fa-key"></i> Logout</a></li>
                        </ul>
                    </li>


               </ul>
            </nav>

        </div>
    </div>
</header>
<!-- Main content starts -->

<div class="content">

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

    <!--- Sidebar navigation -->
    <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
    <ul id="nav">
        <!-- Main menu with font awesome icon -->
        <li><a href="{{ Request::root() }}/admin/home" class="open"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>

         <li class="has_sub"><a href="#"><i class="fa fa-list-alt"></i> <span>{{ trans("common.movie") }}</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
                <li><a href="{{ Request::root() }}/admin/movie/all">{{ trans("common.all") }}</a></li>
                <li><a href="{{ Request::root() }}/admin/movie/create">{{ trans("common.add") }}</a></li>
                <li><a href="{{ Request::root() }}/admin/movie/comments">{{ trans('common.comments') }}</a></li>
                         
            </ul>
        </li>

        <li class="has_sub"><a href="#"><i class="fa fa-list-alt"></i> <span>{{ trans("common.photos") }}</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
                <li><a href="{{ Request::root() }}/admin/photos/all/categories">{{ trans("common.all") }}</a></li>
                <li><a href="{{ Request::root() }}/admin/photo/create">{{ trans("common.add") }}</a></li>
                         
            </ul>
        </li>


        <li class="has_sub"><a href="#"><i class="fa fa-list-alt"></i> <span>Website Meta Pages</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
                <li><a href="{{ Request::root() }}/admin/meta_pages/all">{{ trans("common.all") }}</a></li>
                
            </ul>
        </li>

        </ul>

</div>
<!-- Sidebar ends -->

<!-- Main bar -->
<div class="mainbar">

<!-- Page heading -->
<div class="page-head">
    <h2 class="pull-left">{{ $page_title }}</h2>

    <div class="clearfix"></div>

  <!-- Breadcrumb -->
  <div class="bread-crumb">

     @foreach( $breadcrumbs as $link => $title )

     @if( $link != '!' )


        <a href="{{ URL::to($link) }}">@if( $link == 'admin/home')<i class="fa fa-home">@endif</i>{{ $title }}</a>
        <span class="divider">/</span>

     @else

        <a href="#" class="bread-current">{{ $title }}</a>

    @endif

    @endforeach

  </div>

    <div class="clearfix"></div>

</div>
<!-- Page heading ends -->

<br />

<div class="container">

@yield('content')

<!-- Mainbar ends -->
<div class="clearfix"></div>

</div>
<!-- Content ends -->


<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span>

@section('footer_javascript')

<!-- JS -->
<script src="{{ Request::root() }}/assets/admin_theme_js/jquery.js"></script> <!-- jQuery -->
<script src="{{ Request::root() }}/assets/admin_theme_js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="{{ Request::root() }}/assets/admin_theme_js/jquery-ui-1.9.2.custom.min.js"></script> <!-- jQuery UI -->


<script src="{{ Request::root() }}/assets/admin_theme_js/jquery.slimscroll.min.js"></script> <!-- jQuery SlimScroll -->


<script src="{{ Request::root() }}/assets/admin_theme_js/custom.js"></script> <!-- Custom codes -->

<script src="{{ Request::root() }}/assets/admin_theme_js/index.js"></script> <!-- Index Javascripts -->

@show

</body>

</html>