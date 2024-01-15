@extends('backend.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard

      </h1>
      </section>
      <section class="content">
        <div class="row">
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">{{Auth::user()->name}}</h3>
              <h5 class="widget-user-desc">{{Auth::user()->role ==='admin' ? "Administrator" : "User"}}</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="{{route('post_index')}}">Posts <span class="pull-right badge bg-blue">{{$postsByAuthor}}</span></a></li>
                <li><a href="{{route('page_index')}}">Pages <span class="pull-right badge bg-aqua">{{$pagesByAuthor}}</span></a></li>
                <li><a href="{{route('comment_index')}}">Comments <span class="pull-right badge bg-green">{{Auth::user()->comments()->count()}}</span></a></li>

              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Posts</span>
              <span class="info-box-number">{{$countAll}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pages</span>
              <span class="info-box-number">{{$countAllPages}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Comments</span>
              <span class="info-box-number">{{Auth::user()->comments()->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>


    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    </section>
    <!-- /.content -->
  </div>

@endsection
