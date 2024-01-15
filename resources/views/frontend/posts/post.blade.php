@extends('frontend.layout')
@section('content')
@section('title', e($post->title) )
@section('meta', e($post->meta) )

<section id="mu-course-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-course-content-area">
                    <div class="row">
                        <div class="col-md-9">
                                <!-- start course content container -->
                                <div class="mu-course-container mu-blog-single">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <article class="mu-blog-single-item">
                                                <figure class="mu-blog-single-img">
                                                    <a href="#"><img alt="img" src="/images/posts/{{$post->file}}"></a>
                                                    <figcaption class="mu-blog-caption">
                                                        <h1>{{$post->title}}</h1>
                                                    </figcaption>
                                                </figure>
                                                <div class="mu-blog-meta">
                                                    @if($post->type=='post')
                                                        <a href="#">By {{$post->user->name}}</a>
                                                        <a href="#">{{$post->created_at->format($date_format)}}</a>
                                                        <span><i class="fa fa-folder-open-o"></i></span>@foreach($categories as $category)<a href="{{route('category',$category)}}"> {{$category->name}},</a>@endforeach
                                                        <span> <i class="fa fa-comments-o"></i>{{$comments->count()}}</span>
                                                    @endif
                                                </div>
                                                <div class="mu-blog-description">
                                                    {!!$post->content!!}

                                                </div>
                                                <!-- start blog post tags -->
                                                
                                                <!-- End blog post tags -->
                                                <!-- start blog social share -->
                                                <div class="mu-blog-social">
                                                    <ul class="mu-news-social-nav">
                                                        <li>SOCIAL SHARE :</li>
                                                        <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                                                        <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                                                        <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
                                                        <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                                                    </ul>
                                                </div>
                                                
                                                <div class="mu-blog-tags">
                                                    <ul class="mu-news-single-tagnav">
                                                        @if($post->type=='post')
                                                        <li>TAGS :</li>
                                                        @foreach($tags as $tag)
                                                        <li><a href="{{route('tag',$tag)}}">{{$tag->name}}@if($tags->count()>1)@endif</a>,</li>
                                                        @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                                <!-- End blog social share -->
                                            </article>
                                        </div>
                                    </div>
                                </div>
                                <!-- end course content container -->
                                <!-- start blog navigation -->
                                <div class="row">
                                    <div class="col-md-12">
                                        @if($post->type=='post')
                                        <div class="mu-blog-single-navigation">
                                            @if ($previous)
                                            <a class="mu-blog-prev" href="{{ url($previous->slug) }}"><span class="fa fa-angle-left"></span>Prev: <br> {{$previous->title}}</a>
                                            @endif
                                            @if ($next)
                                            <a class="mu-blog-next" href="{{ url($next->slug) }}">Next: <br> {{$next->title}}<span class="fa fa-angle-right"></span></a>
                                                @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- end blog navigation -->
                                <!-- start related course item -->
                                @if($post->type=='post')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mu-related-item">
                                            <h3>Related News</h3>
                                            <div class="mu-related-item-area">
                                                <div id="mu-related-item-slide">
                                                    @foreach($relatedposts as $relatedpost)
                                                    <div class="col-md-6">
                                                        <article class="mu-blog-single-item">
                                                            <figure class="mu-blog-single-img">
                                                                <a href="{{route('post.show',$relatedpost->slug)}}"><img alt="img" src="/images/posts/{{$relatedpost->file}}"></a>
                                                                <figcaption class="mu-blog-caption">
                                                                    <h3><a href="{{route('post.show',$relatedpost->slug)}}">{{$relatedpost->title}}</a></h3>
                                                                </figcaption>
                                                            </figure>
                                                            <div class="mu-blog-meta">
                                                                <a href="#"">By {{$relatedpost->user->name}}</a>
                                                                <a href="#">{{$relatedpost->created_at->format($date_format)}}</a>
                                                                <span><i class="fa fa-comments-o"></i>{{$relatedpost->comments->count()}}</span>
                                                            </div>
                                                            <div class="mu-blog-description">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae ipsum non voluptatum eum repellendus quod aliquid. Vitae, dolorum voluptate quis repudiandae eos molestiae dolores enim.</p>
                                                                <a href="{{route('post.show',$relatedpost->slug)}}" class="mu-read-more-btn">Read More</a>
                                                            </div>
                                                        </article>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    @endif
                            @if($post->type=='post')
                                @include('frontend.posts.comments')
                            @endif
                                </div>
                        <x-sidebar />

                            </div>
                        </section>

@endsection
