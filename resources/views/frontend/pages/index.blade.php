@extends('frontend.layout')

@section('content')
<header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>{{$title}}</h1>
            <span class="subheading">A Blog Theme by Start Bootstrap</span>
        </div>
    </div>
</div>
</div>
</header>
    <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
       @foreach ($data as $post)
       @if ($post->status==1)
       <div class="post-preview">
          <a href="{{route('post.show',$post->slug,$post->id)}}">
            <h2 class="post-title">
                {{$post->title}}
          </h2>
          
      </a>
      <p class="post-meta">Posted by
        <a href="#">{{$post->user->name}}</a>
        on {{$post->created_at->format('M d')}}, {{$post->created_at->format('Y')}}</p>
    </div>
    <hr>
    @endif
    @endforeach
    <!-- Pager -->
    <div class="clearfix">
      <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
      {!! $data->links() !!}
  </div>
</div>
</div>
</div>











@endsection