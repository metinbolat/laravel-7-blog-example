@extends('backend.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Categories

            </h1>

        </section>

        <section class="content container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="box-title">
                                    <div style="margin-left: 25px !important;" align="right" class="ml-5"><a class="btn btn-primary" href="{{route('category.new')}}">Add New</a></div>
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
                                @foreach ($categories as $category)
                                    <tr>

                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td width="5"><a href="{{route('category.edit',$category->id)}}"><button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></button></a></td>
                                        <td width="5"><form id="{{'form-delete-'.$category->id}}" method="post" action="{{route('category.destroy',$category->id)}}">@method('delete') @csrf<button onclick="event.preventDefault();
                                                    if(confirm('Do you really want to delete?'))       {
                                                    document.getElementById('form-delete-{{$category->id}}')
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
