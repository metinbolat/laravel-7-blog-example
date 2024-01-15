@extends('backend.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Comments
            </h1>

        </section>

        <section class="content container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="home-tab"  href="{{route('comment_index')}}" role="tab" aria-controls="home" aria-selected="true">Published ({{$countPub}})</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab"  href="{{route('comment_pend')}}" role="tab" aria-controls="profile" aria-selected="false">Pending ({{$countPend}})</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="messages-tab" href="{{route('comment_trashed')}}" role="tab" aria-controls="messages" aria-selected="false">Trashed ({{$countTr}})</a>
                                </li>
                            </ul>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <x-alert />
                            <table class="table table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>Commentor Name</th>
                                    <th>Commentor Email</th>
                                    <th>Added on</th>
                                
                                    <th>Related Post</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($comments as $comment)
                                    <tr>
                                    
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$comment->user_name}}</td>
                                        <td>{{$comment->user_email}}</td>
                                        <td>{{$comment->created_at->format($date_format)}} at {{$comment->created_at->format($time_format)}}</td>
                                        <td><a href="{{route('post.show', $comment->post->slug)}}">{{$comment->post->title}}</a></td>
                                        <td>{{$comment->comment}}</td>
                                           @if (Request::url() == url('admin/comments/pending'))  
                                        <td width="5"><form id="{{'form-publish-'.$comment->id}}" method="post" action="{{route('comment_publish',$comment)}}">@csrf<button onclick="event.preventDefault();
                                                    document.getElementById('form-publish-{{$comment->id}}')
                                                    .submit()
                                                    " class="btn btn-primary"><i class="fa fa-check"></i></button></form></td>
                                                    @endif
                                        <td width="5"><a href="{{route('comment_edit',$comment->id)}}"><button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></button></a></td>
                                        <td width="5"><form id="{{'form-delete-'.$comment->id}}" method="post" action="{{route('comment_delete',$comment)}}">@method('delete') @csrf<button onclick="event.preventDefault();
                                                    if(confirm('Do you really want to delete?'))       {
                                                    document.getElementById('form-delete-{{$comment->id}}')
                                                    .submit()
                                                    }" class="btn btn-primary"><i class="fa fa-recycle"></i></button></form></td>
                                    </tr>
                                @endforeach
                                {!! $comments->links() !!}
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>

        <!-- /.content -->
    </div>

@endsection
