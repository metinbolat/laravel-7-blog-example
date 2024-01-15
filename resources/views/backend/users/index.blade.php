@extends('backend.layout')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Users

    </h1>

  </section>

  <section class="content container-fluid">
      <div class="row">
          <div class="col-xs-12">
              <div class="box">
                  <div class="box-header">
                      <h3 class="box-title">All Users</h3>

                      <div class="box-tools">
                          <div class="input-group input-group-sm" style="width: 150px;">
                              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                              <div class="input-group-btn">
                                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body table-responsive no-padding">
                      <x-alert />
                      <table class="table table-hover">
                          <tr>
                          <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Role</th>
                              <th>Email</th>
                              <th>Created</th>
                              <th></th>
                              <th></th>
                          </tr>
                          </tr>
                          @foreach ($users as $user)
                              <tr>
                                  <td></td>
                                  <td>{{$user->name}}</td>
                                  <td>{{$user->role == 'admin' ? "Administrator" : "User"}}</td>
                                  <td>{{$user->email}}</td>
                                  <td>{{$user->created_at}}</td>
                                  <td width="5"><a href="{{route('user_show', $user->id)}}"><button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></button></a></td>
                                  <td width="5"></td>
                              </tr>
                          @endforeach
                      </table>
                  </div>
                  <!-- /.box-body -->
              </div>
              <!-- /.box -->
          </div>
      </div>
  </section>
  <!-- /.content -->
</div>

@endsection
