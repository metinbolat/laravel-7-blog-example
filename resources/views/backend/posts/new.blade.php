@extends('backend.layout')

@section('content')
<link rel="stylesheet" href="{{asset('/backend/assets/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('/backend/assets/bower_components/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/backend/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<script src="{{asset('/backend/assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('/backend/assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{('/backend/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Create New Post

    </h1>

  </section>

  <!-- Main content -->
  <section class="content container-fluid">


    <div class="box box-primary">

      <div class="box-header with-border">

      </div>
      <div class="box-body">
        <x-alert />

        <form action="{{route('post_create')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}">
                    </div>
                    <div class="col-md-3">
                        <div class="bootstrap-timepicker">
                            <label>Date Published</label>
                            <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input value="{{$now->format('m/d/Y')}}" name="date" type="text" class="form-control pull-right" id="datepicker">
                </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="bootstrap-timepicker">
                            <label>Time Published</label>
                            <div class="input-group">
                                <input value="{{$now->format('H:i')}}" type="text" name="time" class="form-control timepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="slug">Slug</label>
                        <input class="form-control" type="text" name="slug" id="slug" value="{{ old('slug') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="category">Category</label>
                        <select name="categories[]" id="category" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Categories" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="category">Tags</label>
                        <select name="tags[]" id="category" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select Categories" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Image</label>
                        <input class="form-control" type="file" name="post_file" value="{{ old('post_file') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                                <option value="1">Published</option>
                                <option value="0">Draft</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <textarea id="editor1" name="content" >{{ old('content') }}</textarea>
                        <div class="pull-right" id="counter1"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="meta">Meta Description</label>
                        <textarea maxlength="155" class="form-control"  id="meta" name="meta" >{{ old('meta') }}</textarea>
                        <div class="pull-right" id="counter"></div>
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
    <script>
    CKEDITOR.replace( 'editor1', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
        
    });
    
    $(function () {
        $('.timepicker').timepicker({
            showInputs: false
        })
        $('#datepicker').datepicker({
      autoclose: true
    })
    });
    $(document).ready(function () {$('.select2').select2()});
    
    document.addEventListener('DOMContentLoaded', function() {
    const messageEle = document.getElementById('meta');
    const counterEle = document.getElementById('counter');

    messageEle.addEventListener('input', function(e) {
        const target = e.target;
        const maxLength = target.getAttribute('maxlength');
        const currentLength = target.value.length;

        counterEle.innerHTML = `${currentLength}/${maxLength}`;
    });
});


</script>
  </div>
  @endsection
