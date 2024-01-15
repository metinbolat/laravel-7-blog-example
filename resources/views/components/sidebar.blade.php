

<div class="col-md-3">
    <!-- start sidebar -->
    <aside class="mu-sidebar">
        <!-- start single sidebar -->
        <div class="mu-single-sidebar">
            <h3>Kategoriler</h3>
            <ul class="mu-sidebar-catg">
                @foreach($categories as $category)
                    <li><a href="{{route('category',$category)}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </div>
        <!-- end single sidebar -->
        <!-- start single sidebar -->
        <div class="mu-single-sidebar">
            <h3>Son Yazılar</h3>
            <div class="mu-sidebar-popular-courses">
                @foreach($recentPosts as $recentPost)
                <div class="media">
                    <div class="media-left">
                        <a href="{{ route('post.show',$recentPost->slug) }}">
                            <img class="media-object" @if ($recentPost->file)  src="/images/posts/{{$recentPost->file}}" alt="img" @else @endif>
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="{{ route('post.show',$recentPost->slug) }}">{{substr($recentPost->title, 0, 35)}}</a></h4>
                        <span class="popular-course-price">{!!substr (strip_tags($recentPost->content), 0, 30)!!}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- end single sidebar -->
        <!-- start single sidebar -->
        <div class="mu-single-sidebar">
            <h3>Arşiv</h3>
            
        </div>
        <!-- end single sidebar -->
        <!-- start single sidebar -->
        <div class="mu-single-sidebar">
            <h3>Etiketler</h3>
            <div class="tag-cloud">
                @foreach($tags as $tag)
                    <a href="{{route('tag',$tag)}}">{{$tag->name}}</a>
                @endforeach
            </div>
        </div>
        <!-- end single sidebar -->
    </aside>
    <!-- / end sidebar -->
</div>

