@extends('backend.layout')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Create New Tag

    </h1>

  </section>

  <!-- Main content -->
  <section class="content container-fluid">


    <div class="box box-primary">

      <div class="box-header with-border">

      </div>
      <div class="box-body">
        <x-alert />

        <form action="{{route('tag.create')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label> Tag Name</label>
            <div class="row">
              <div class="col-md-6">
                <input class="form-control" type="text" name="name" value="">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label>Slug</label>
                <input class="form-control" type="text" value="" name="slug">
              </div>
            </div>
          </div>
          <div align="right" class="box-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Create</button></div>
          </form>

        </div>

      </div>

    </section>
    <!-- /.content -->
  </div>

  @endsection
