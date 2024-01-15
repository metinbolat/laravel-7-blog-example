@extends('backend.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Pages
            </h1>

        </section>

        <section class="content container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab"  href="{{route('page_index')}}" role="tab" aria-controls="home" aria-selected="true">All ({{$countAll}})</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab"  href="{{route('page_my')}}" role="tab" aria-controls="profile" aria-selected="false">My ({{$countAu}})</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="messages-tab" href="{{route('page_pub')}}" role="tab" aria-controls="messages" aria-selected="false">Published ({{$countPub}})</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="messages-tab" href="{{route('page_draft')}}" role="tab" aria-controls="messages" aria-selected="false">Drafts ({{$countDr}})</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="messages-tab" href="{{route('page_trashed')}}" role="tab" aria-controls="messages" aria-selected="false">Trashed ({{$countTr}})</a>
                                </li>
                                <li class="nav-item">
                                    <div style="margin-left: 25px !important;" align="right" class="ml-5"><a class="btn btn-primary" href="{{route('page_new')}}">New Page</a></div>
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
                                    <th>Status</th>
                                    
                                    <th></th>
                                    <th>Actions</th>
                                </tr>
                                @foreach ($posts as $post)
                                    <tr>
                                    
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->user->name}}</td>
                                        <td>{{$post->created_at->format($date_format)}} at {{$post->created_at->format($time_format)}}</td>
                                        <td>@if ($post->status==1 && $post->created_at <= \Carbon\Carbon::now()->addHours(3)->toDateTimeString())
                                                <span class="label label-success">Published</span>
                                            @elseif ($post->created_at >= \Carbon\Carbon::now()->addHours(3)->toDateTimeString())
                                            <span class="label label-primary">Scheduled</span>
                                            @else    
                                                <span class="label label-warning">Draft</span>
                                            @endif</td>
                                        
                                        <td width="5"><a href="{{route('page_edit',$post->id)}}"><button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></button></a></td>
                                        <td width="5"><form id="{{'form-delete-'.$post->id}}" method="post" action="{{route('post_delete',$post)}}">@method('delete') @csrf<button onclick="event.preventDefault();
                                                    if(confirm('Do you really want to delete?'))       {
                                                    document.getElementById('form-delete-{{$post->id}}')
                                                    .submit()
                                                    }" class="btn btn-primary"><i class="fa fa-recycle"></i></button></form></td>
                                    </tr>
                                @endforeach
                                {!! $posts->links() !!}
                            </table>
                            <div class="col-md-3">{!! $posts->links() !!}</div>
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
