@extends('backend.layout')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Category

    </h1>

  </section>

  <!-- Main content -->
  <section class="content container-fluid">


    <div class="box box-primary">

      <div class="box-header with-border">

      </div>
      <div class="box-body">
        <x-alert />

        <form action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>Title</label>
            <div class="row">
              <div class="col-md-6">
                <input class="form-control" type="text" name="name" value="{{$category->name}}">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label>Slug</label>
                <input class="form-control" type="text" value="{{$category->slug}}" name="slug">
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
