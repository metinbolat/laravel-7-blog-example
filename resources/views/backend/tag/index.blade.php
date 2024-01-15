@extends('backend.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tags

            </h1>

        </section>

        <section class="content container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="box-title">
                                    <div style="margin-left: 25px !important;" align="right" class="ml-5"><a class="btn btn-primary" href="{{route('tag.new')}}">Add New</a></div>
                            </div>
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
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th></th>
                                    <th>Actions</th>
                                </tr>
                                @foreach ($tags as $tag)
                                    <tr>

                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$tag->name}}</td>
                                        <td>{{$tag->slug}}</td>
                                        <td width="5"><a href="{{route('tag.edit',$tag->id)}}"><button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></button></a></td>
                                        <td width="5"><form id="{{'form-delete-'.$tag->id}}" method="post" action="{{route('tag.destroy',$tag->id)}}">@method('delete') @csrf<button onclick="event.preventDefault();
                                                    if(confirm('Do you really want to delete?'))       {
                                                    document.getElementById('form-delete-{{$tag->id}}')
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
