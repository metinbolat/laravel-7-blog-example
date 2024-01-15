@extends('frontend.layout')
@section('title', $title)
@section('content')
    <section id="mu-course-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-course-content-area">
                        <div class="row">
                            <div class="col-md-9">
                                <!-- start course content container -->
                                <div class="mu-course-container mu-blog-archive">
                                    <div class="row">
                                        @foreach ($data as $post)
                                            @if ($post->status==1)
                                                <div class="col-md-6 col-sm-6">
                                                    <article class="mu-blog-single-item">

                                                        <figure class="mu-blog-single-img">
                                                            <div style="height: 250px;">
                                                            @if ($post->file)<a href="#"><img src="/images/posts/{{$post->file}}" alt="img" height="250"></a>@endif
                                                            </div>
                                                            <figcaption class="mu-blog-caption">
                                                                <h3><a href="{{route('post.show',$post->slug,$post->id)}}">{{$post->title}}</a></h3>
                                                            </figcaption>
                                                        </figure>
                                                        <div class="mu-blog-meta">
                                                            <a href="#">By {{$post->user->name}}</a>
                                                            <a href="#">{{$post->created_at->format($date_format)}},</a>
                                                            <span><i class="fa fa-comments-o"></i>{{$post->comments->count()}}</span>
                                                        </div>
                                                        <div class="mu-blog-description">
                                                         {!!substr (strip_tags($post->content), 0, 200)!!}  {{-- <p>{!! substr(str_replace(array( '<p>', '</p>' , '<h1>', '</h1>', '<h2>', '</h2>', '<b>','</b>','<strong>','</strong>','<i>','</i>','<em>','</em>' ), '', $post->content),0, 200) !!} --}}
                                                                <br>
                                                                <a class="mu-read-more-btn" href="{{route('post.show',$post->slug,$post->id)}}">Devamını Oku</a>
                                                        </div>
                                                    </article>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <!-- end course content container -->
                                <!-- start course pagination -->
                                <div class="mu-pagination">
                                    <nav>
                                        {!! $data->links() !!}
                                    </nav>
                                </div>
                                <!-- end course pagination -->
                            </div>
                            <x-sidebar />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>













@endsection
