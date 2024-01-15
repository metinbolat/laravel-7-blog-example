@extends('backend.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Trashed Posts
            </h1>

        </section>

        <section class="content container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab"  href="{{route('post_index')}}" role="tab" aria-controls="home" aria-selected="true">All Posts ({{$countAll}})</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab"  href="{{route('post_my')}}" role="tab" aria-controls="profile" aria-selected="false">My Posts ({{$countAu}})</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="messages-tab" href="{{route('post_pub')}}" role="tab" aria-controls="messages" aria-selected="false">Published Posts ({{$countPub}})</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="messages-tab" href="{{route('post_draft')}}" role="tab" aria-controls="messages" aria-selected="false">Drafts ({{$countDr}})</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="messages-tab" href="{{route('post_trashed')}}" role="tab" aria-controls="messages" aria-selected="false">Trashed ({{$countTr}})</a>
                                </li>
                                <li class="nav-item">
                                    <div style="margin-left: 25px !important;" align="right" class="ml-5"><a class="btn btn-primary" href="{{route('post_new')}}">New Post</a></div>
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
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Created</th>
                                    <th></th>
                                    <th>Actions</th>
                                </tr>
                                @foreach ($posts as $post)
                                    <tr>

                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->user->name}}</td>
                                        <td>{{$post->created_at->format($date_format)}} at {{$post->created_at->format($time_format)}}</td>
                                        <td width="5"><form id="{{'form-recover-'.$post->id}}" method="post" action="{{route('post_recover',$post)}}">@method('delete') @csrf<button onclick="event.preventDefault();
                                                           {
                                                    document.getElementById('form-recover-{{$post->id}}')
                                                    .submit()
                                                    }" class="btn btn-primary"><i class="fa fa-undo"></i></button></form></td>
                                        
                                        <td width="5"><form id="{{'form-delete-'.$post->id}}" method="post" action="{{route('post_destroy',$post)}}">@method('delete') @csrf<button onclick="event.preventDefault();
                                                    if(confirm('Do you really want to delete the post permanently?'))       {
                                                    document.getElementById('form-delete-{{$post->id}}')
                                                    .submit()
                                                    }" class="btn btn-primary"><i class="fa fa-trash-o"></i></button></form></td>
                                    </tr>
                                @endforeach
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
