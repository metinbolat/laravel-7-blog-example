@extends('backend.layout')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Tag

    </h1>

  </section>

  <!-- Main content -->
  <section class="content container-fluid">


    <div class="box box-primary">

      <div class="box-header with-border">

      </div>
      <div class="box-body">
        <x-alert />

        <form action="{{route('tag.update',$tag->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>Title</label>
            <div class="row">
              <div class="col-md-6">
                <input class="form-control" type="text" name="title" value="{{$tag->name}}">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label>Slug</label>
                <input class="form-control" type="text" value="{{$tag->slug}}" name="slug">
              </div>
            </div>
            </div>
          <div align="right" class="box-footer">
            <button type="submit" class="btn btn-success">Update</button></div>
        </form>

      </div>

    </div>

  </section>
  <!-- /.content -->
</div>

@endsection
