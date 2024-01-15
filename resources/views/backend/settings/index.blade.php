@extends('backend.layout')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Site Settings

    </h1>

  </section>

  <!-- Main content -->
  <section class="content container-fluid">
      <div class="row">
          <div class="col-xs-12">
              <div class="box">
                  <div class="box-header">
                      <h3 class="box-title">All Settings</h3>


                  </div>
                  <!-- /.box-header -->
                  <div class="box-body table-responsive no-padding">
                      <x-alert />
                      <table class="table table-hover table-striped">
                          <tr>
                              <th>#</th>
                              <th>Last Updated</th>
                              <th>Description</th>
                              <th>Value</th>
                              <th></th>
                          </tr>
                          @foreach ($settings as $setting)
                              <tr>
                                  <td>{{$setting->must+1}}</td>
                                  <td>{{$setting->updated_at}}</td>
                                  <td>{{$setting->description}}</td>
                                  <td>{{$setting->value}}</td>
                                  <td><a href="{{route('admin_settings_edit',$setting->key)}}"><button class="btn btn-primary">Düzenle</button></a></td>
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
