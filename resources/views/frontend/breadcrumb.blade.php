<section id="mu-page-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-page-breadcrumb-area">
                    <h2>@if(Request::url() == route('post.index')) {{$title}} @else @yield('title') @endif</h2>
                    <ol class="breadcrumb">
                        <li><a href="{{route('post.index')}}">Anasayfa</a></li>
                        @if(Request::url() == route('post.index'))
                        @else
                        <li class="active">  @yield('title') </li>
                        @endif
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
