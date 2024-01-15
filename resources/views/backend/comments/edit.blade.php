@extends('backend.layout')

@section('content')
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

        <form action="{{route('comment_update',$comment->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                  <label for="name">Commentator Name</label>
                <input readonly class="form-control" type="text" name="name" id="name" value="{{$comment->user_name}}">
              </div>
              <div class="col-md-3">
                  <label for="email">Commentator Email</label>
                <input readonly class="form-control" type="text" name="email" id="email" value="{{$comment->user_email}}">
              </div>
              <div class="col-md-3">
                  <label for="date">Added on</label>
                <input readonly class="form-control" type="text" name="date" id="date" value="{{$comment->created_at->format($date_format)}}">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
            <div class="col-md-6">
                  <label for="post">Related Post</label>
                <input readonly class="form-control" type="text" name="post" id="post" value="{{$comment->post->title}}">
              </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                  <textarea cols="100" rows="5" name="comment" value="">{{$comment->comment}}</textarea>
              </div>
            </div>
            </div>
          <div align="right" class="box-footer">
            <button type="submit" class="btn btn-success">Update</button></div>
        </form>
      </div>
    </div>
  </section>
</div>

@endsection
