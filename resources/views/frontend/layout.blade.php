<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') {{Request::url() == route('post.index') ? '' : '| '. $title}}</title>
    <meta name="description" content="@yield('meta')"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/images/settings/{{$icon}}" type="image/x-icon">

    <!-- Font awesome -->
    <link href="/frontend/assets/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="/frontend/assets/css/bootstrap.css" rel="stylesheet">
    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/slick.css">
    <!-- Fancybox slider -->
    <link rel="stylesheet" href="/frontend/assets/css/jquery.fancybox.css" type="text/css" media="screen" />
    <!-- Theme color -->
    <link id="switcher" href="/frontend/assets/css/theme-color/default-theme.css" rel="stylesheet">

    <!-- Main style sheet -->
    <link href="/frontend/assets/css/style.css" rel="stylesheet">


    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<!--START SCROLL TOP BUTTON -->
<a class="scrollToTop" href="#">
    <i class="fa fa-angle-up"></i>
</a>
<!-- END SCROLL TOP BUTTON -->

<!-- Start header  -->

<!-- End header  -->
<!-- Start menu -->
<section id="mu-menu">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- LOGO -->
                <!-- TEXT BASED LOGO -->
            <!-- <a class="navbar-brand" href="{{route('post.index')}}"><i class="fa fa-university"></i><span>Varsity</span></a> -->
                <!-- IMG BASED LOGO  -->
                <a class="navbar-brand" href="{{route('post.index')}}"><img src="/images/settings/{{$logo}}" alt="{{$title}}"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                    <li class="{{Request::url() == route('post.index') ? 'active' : ''}}"><a href="{{route('post.index')}}">Anasayfa</a></li>
                    <li class="{{Request::url() == route('contact') ? 'active' : ''}}"><a href="{{ route('contact') }}">İletişim</a></li>
                    <li><a href="#" id="mu-search-icon"><i class="fa fa-search"></i></a></li>
                    @if (Auth::user())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <span class="fa fa-angle-down"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('admin_index') }}">Admin Panel</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</section>
<!-- End menu -->
<!-- Start search box -->
<div id="mu-search">
    <div class="mu-search-area">
        <button class="mu-search-close"><span class="fa fa-close"></span></button>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form class="mu-search-form">
                        <input type="search" placeholder="Type Your Keyword(s) & Hit Enter">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End search box -->
@include('frontend.breadcrumb')

<!-- Start error section  -->

    @yield('content')
                        </div>


<!-- End error section  -->


<!-- Start footer -->
<footer id="mu-footer">
    <!-- start footer top -->
    <!-- end footer top -->
    <!-- start footer bottom -->
    <div class="mu-footer-bottom">
        <div class="container">
            <div class="mu-footer-bottom-area">
                <p> {{$footer}}</p>
            </div>
        </div>
    </div>
    <!-- end footer bottom -->
</footer>
<!-- End footer -->






<!-- jQuery library -->
<script src="/frontend/assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/frontend/assets/js/bootstrap.js"></script>
<!-- Slick slider -->
<script type="text/javascript" src="/frontend/assets/js/slick.js"></script>
<!-- Counter -->
<script type="text/javascript" src="/frontend/assets/js/waypoints.js"></script>
<script type="text/javascript" src="/frontend/assets/js/jquery.counterup.js"></script>
<!-- Mixit slider -->
<script type="text/javascript" src="/frontend/assets/js/jquery.mixitup.js"></script>
<!-- Add fancyBox -->
<script type="text/javascript" src="/frontend/assets/js/jquery.fancybox.pack.js"></script>

<!-- Custom js <script src="/js/custom.js"></script> -->

<script src="/frontend/assets/js/custom.js"></script>

</body>
</html>
