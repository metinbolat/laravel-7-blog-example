@extends('frontend.layout')
@section('content')
<header class="masthead" style="background-image: url('img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>{{$page->title}}</h1>
            <span class="meta">Posted by
              <a href="#">{{$page->user->name}}</a>
              on {{$page->created_at->format('M d')}}, {{$page->created_at->format('Y')}}</span>
          </div>
        </div>
      </div>
    </div>
  </header>
<article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
         <a href="#">
            <img class="img-fluid" src="/images/posts/{{$page->file}}" alt="">
          </a>
          {!!$page->content!!}
        </div>
      </div>
    </div>
  </article>
  

@endsection