<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/backend/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/backend/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/backend/assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/backend/assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/backend/assets/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="/backend/assets/dist/css/skins/skin-red.min.css">
  <!-- REQUIRED JS SCRIPTS -->
  <!-- jQuery 3 -->
  <script src="/backend/assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="/backend/assets/bower_components/jquery-ui/jquery-ui.js"></script>
  <script src="/backend/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- AdminLTE App -->
  <script src="/backend/assets/dist/js/adminlte.min.js"></script>
  <!-- JavaScript -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


  <!-- CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <!-- Default theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
  <!-- Bootstrap theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />




  {{-- <script src="//cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script> --}}
  <script src="/backend/assets/ckeditor/ckeditor.js"></script>


</head>

<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
      </a>

      <!-- Header Navbar -->
      @include('backend.adminbar')
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <img @if(isset(Auth::user()->avatar)) src="{{asset('/storage/images/'.Auth::user()->avatar)}}" @else src=
            "{{asset('/images/settings/defaultuser.png') }}" @endif
            class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{Auth::user()->name}}</p>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">NAVIGATION</li>
          <li class="{{Request::url() == route('post.index') ? 'active' : ''}}"><a href="{{route('post.index')}}"><i
                class="fa fa-home"></i> <span>Visit Homepage</span></a></li>
          <li class="{{Request::url() == route('admin_index') ? 'active' : ''}}"><a href="{{route('admin_index')}}"><i
                class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
          <li
            class="{{Request::url() == url('admin/pages/') || Request::url() == url('admin/pages/my') || Request::url() == url('admin/pages/published') || Request::url() == url('admin/pages/draft') ? 'active' : ''}}">
            <a href="{{route('page_index')}}"><i class="fa fa-newspaper-o"></i> <span>Pages</span></a>
          </li>
          <li
            class="treeview menu-open 
      {{Request::url() == url('admin/posts/') || Request::url() == url('admin/posts/my') || Request::url() == url('admin/posts/published') || Request::url() == url('admin/posts/draft') ? 'active' : ''}}">
            <a href="#">
              <i class="fa fa-share"></i> <span>Posts</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: block;">
              <li
                class="{{Request::url() == url('admin/posts/') || Request::url() == url('admin/posts/my') || Request::url() == url('admin/posts/published') || Request::url() == url('admin/posts/draft') ? 'active' : ''}}">
                <a href="{{route('post_index')}}"><i class="fa fa-newspaper-o"></i> <span>Posts</span></a>
              </li>
              <li class="{{Request::url() == route('category.index')  ? 'active' : ''}}"><a
                  href="{{route('category.index')}}"><i class="fa fa-folder-open-o"></i> <span>Categories</span></a>
              </li>
              <li class="{{Request::url() == route('tag.index')  ? 'active' : ''}}"><a href="{{route('tag.index')}}"><i
                    class="fa fa-tag"></i> <span>Tags</span></a></li>
            </ul>
          </li>
          <li class="{{Request::url() == url('admin/comments') ? 'active' : ''}}"><a
              href="{{route('comment_index')}}"><i class="fa fa-comments"></i> <span>Comments</span></a></li>
        </ul>
        <ul style="{{Auth::user()->role=='admin' ? '' : 'display: none;'}}" class="sidebar-menu" data-widget="tree">
          <li class="header">ADMIN</li>
          <li class="{{Request::url() == route('admin_settings') ? 'active' : ''}}"><a
              href="{{route('admin_settings')}}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
          <li class="{{Request::url() == route('user_index') ? 'active' : ''}}"><a href="{{route('user_index')}}"><i
                class="fa fa-users"></i> <span>Users</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->

    @yield('content')
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
          <h3 class="control-sidebar-heading">Recent Activity</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                  <p>Will be 23 on April 24th</p>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

          <h3 class="control-sidebar-heading">Tasks Progress</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <h4 class="control-sidebar-subheading">
                  Custom Template Design
                  <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
          <form method="post">
            <h3 class="control-sidebar-heading">General Settings</h3>

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Report panel usage
                <input type="checkbox" class="pull-right" checked>
              </label>

              <p>
                Some information about this general settings option
              </p>
            </div>
            <!-- /.form-group -->
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
  <script src="/js/custom.js"></script>
</body>

</html>