@extends('backend.layout')

@section('content')
<link rel="stylesheet" href="{{asset('/backend/assets/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('/backend/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<script src="{{asset('/backend/assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('/backend/assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('/backend/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Page
    </h1>

  </section>

  <!-- Main content -->
  <section class="content container-fluid">


    <div class="box box-primary">

      <div class="box-header with-border">

      </div>
      <div class="box-body">
        <x-alert />

        <form action="{{route('page_update',$postId->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                  <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" value="{{$postId->title}}">
              </div>
              <div class="col-md-3">
                        <div class="bootstrap-timepicker">
                            <label>Date Published</label>
                            <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input value="{{$postId->created_at->format('m/d/y')}}" name="date" type="text" class="form-control pull-right" id="datepicker">
                </div>
                        </div>
                    </div>
                <div class="col-md-3">
                    <div class="bootstrap-timepicker">
                        <label>Time Published</label>

                        <div class="input-group">
                            <input type="text" class="form-control timepicker">

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
                <input class="form-control" type="text" value="{{$postId->slug}}" name="slug" id="slug">
              </div>
              <div class="col-md-3">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        @if ($postId->status==0)
                            <option value="0">Draft</option>
                            <option value="1">Published</option>
                        @else
                            <option value="1">Published</option>
                            <option value="0">Draft</option>
                        @endif
                    </select>
                </div>
            </div>
            </div>
            <div class="form-group">
            @if ($postId->file)
            <label for="">Current Image</label>
              <div class="row">
              <div class="col-md-6">
              <img id="image" width="400" src="/images/posts/{{$postId->file}}">
              </div>
              </div>
            @endif
            </div>
            <div class="form-group">
                <div class="row">
              <div class="col-md-12">
                <label>Image</label>
                <input class="form-control" type="file" name="page_file" value="">
              </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
              <div class="col-md-12">

                  <textarea id="editor1" name="content" value="">{{$postId->content}}</textarea>

              </div>
            </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="meta">Meta Description</label>
                        <textarea maxlength="155" class="form-control"  id="meta" name="meta" >{{ old('meta') }}{{$postId->meta}}</textarea>
                        <div class="pull-right" id="counter"></div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="old_file" value="{{$postId->file}}">


          <div align="right" class="box-footer">


            <button type="submit" class="btn btn-success">Update</button></div>
        </form>

      </div>

    </div>
    <script>
    CKEDITOR.replace( 'editor1', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    $(function () {
        $('.timepicker').timepicker({
            showInputs: false
        });
        $('#datepicker').datepicker({
      autoclose: true
    });
    });
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
  </section>
  <!-- /.content -->
</div>

@endsection
