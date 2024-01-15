<!-- start blog comment -->

<div class="row">
    <div class="col-md-12">
        <div class="mu-comments-area">
            <h3>{{$comments->count()}} Comments</h3>
            <div class="comments">
                <ul class="commentlist">
                    @foreach ($comments as $comment)
                        @if ($comment->user_id)
                            <li class="author-comments">
                                <div class="media">
                                    <div class="media-left">
                                        <img alt="img" src="assets/img/testimonial-3.png" class="media-object news-img">
                                    </div>
                                    <div class="media-body">
                                        <h4 class="author-name">{{$comment->user_name}}</h4>
                                        <span class="comments-date"> Posted on {{$comment->created_at->format($date_format)}}</span>
                                        <span class="author-tag">User</span>
                                        <p>{{$comment->comment}}</p>
                                        <a class="reply-btn" href="#">Reply <span class="fa fa-long-arrow-right"></span></a>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li>
                                <div class="media">
                                    <div class="media-left">
                                        <img alt="img" src="assets/img/testimonial-1.png" class="media-object news-img">
                                    </div>
                                    <div class="media-body">
                                        <h4 class="author-name">{{$comment->user_name}}</h4>
                                        <span class="comments-date"> Posted on {{$comment->created_at->format($date_format)}}</span>
                                        <p>{{$comment->comment}}</p>
                                        <a class="reply-btn" href="#">Reply <span class="fa fa-long-arrow-right"></span></a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                        {{--
                        <ul class="children">
                        <li class="author-comments">
                            <div class="media">
                                <div class="media-left">
                                    <img alt="img" src="assets/img/testimonial-3.png" class="media-object news-img">
                                </div>
                                <div class="media-body">
                                    <h4 class="author-name">Admin</h4>
                                    <span class="comments-date"> Posted on 12th June, 2016</span>
                                    <span class="author-tag">Author</span>
                                    <p>Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English</p>
                                    <a class="reply-btn" href="#">Reply <span class="fa fa-long-arrow-right"></span></a>
                                </div>
                            </div>
                        </li>
                        <ul class="children">
                            <li>
                                <div class="media">
                                    <div class="media-left">
                                        <img alt="img" src="assets/img/testimonial-1.png" class="media-object news-img">
                                    </div>
                                    <div class="media-body">
                                        <h4 class="author-name">David Muller</h4>
                                        <span class="comments-date"> Posted on 12th June, 2016</span>
                                        <p>Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English</p>
                                        <a class="reply-btn" href="#">Reply <span class="fa fa-long-arrow-right"></span></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </ul>
                    --}}
                </ul>

                <!-- comments pagination -->
                <nav> {!! $comments->links() !!} </nav>
                {{-- <nav>
                     <ul class="pagination comments-pagination">
                         <li>
                             <a aria-label="Previous" href="#">
                                 <span class="fa fa-long-arrow-left"></span>
                             </a>
                         </li>
                         <li><a href="#">1</a></li>
                         <li><a href="#">2</a></li>
                         <li><a href="#">3</a></li>
                         <li><a href="#">4</a></li>
                         <li><a href="#">5</a></li>
                         <li>
                             <a aria-label="Next" href="#">
                                 <span class="fa fa-long-arrow-right"></span>
                             </a>
                         </li>
                     </ul>
                 </nav>
                 --}}
            </div>
        </div>
    </div>
</div>
<!-- end blog comment -->
<!-- start respond form -->
<div class="row">
    <div class="col-md-12">
        <div id="respond">
            <h3 class="reply-title">Leave a Comment</h3>
            <form id="commentform" action="{{route('make.comment',$post->slug)}}" method="post">
                @csrf
                <input style="display: none;" name="post_id" readonly value="{{$post->id}}">
                @guest
                    <p class="comment-notes">
                        Your email address will not be published. Required fields are marked <span class="required">*</span>
                    </p>
                    <p class="comment-form-author">
                        <label for="author">Name <span class="required">*</span></label>
                        <input type="text" required="required" size="30" value="" name="name">
                    </p>
                    <p class="comment-form-email">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" required="required" aria-required="true" value="" name="email">
                    </p>
                @endguest
                @auth
                    <small>Logged in as {{Auth::user()->name}}</small>
                @endauth
                <p class="comment-form-comment">
                    <label for="comment">Comment</label>
                    <textarea required="required" aria-required="true" rows="8" cols="45" name="comment"></textarea>
                </p>

                <p class="form-submit">
                    <input type="submit" value="Post Comment" class="mu-post-btn" name="submit">
                </p>
            </form>
        </div>
    </div>
</div>
<!-- end respond form -->

