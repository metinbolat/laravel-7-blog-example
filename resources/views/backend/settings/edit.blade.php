@extends('backend.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Site Settings

            </h1>

        </section>

        <!-- Main content -->
        <section class="content container-fluid">


            <div class="box box-primary">

                <div class="box-header with-border">
                    <h2 class="box-title">Edit "<em>{{$setting->description}}</em>"</h2>
                </div>
                <div class="box-body">
                    <x-alert />

                    <form action="{{route('admin_settings_update',$setting->key)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label>You Are Editing:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="" readonly value="{{$setting->description}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="row">
                                @if ($setting->type=='file')
                                    <div class="col-md-6">
                                        <label>Upload Image</label>
                                        <input class="form-control" type="file" value="{{$setting->value}}" name="value">
                                    </div>

                                    <div class="col-md-12">

                                        <label>Current Logo:</label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <img width="200" src="/images/settings/{{$setting->value}}" name="value">
                                            </div>
                                        </div>
                                        @endif
                                        @if ($setting->type=='file')
                                            <input type="hidden" name="oldfile" value="{{$setting->value}}">
                                    </div>

                                @endif

                                @if ($setting->type=='ckeditor')
                                    <div class="col-md-12">
                                        <label>Description</label>
                                        <textarea class="form-control" id="editor1" name="value">{{$setting->value}}</textarea>
                                    </div>
                                    <script>
                                        CKEDITOR.replace('editor1');
                                    </script>
                                @endif

                                @if ($setting->type=='textarea')
                                    <div class="col-md-6">
                                        <label>Description</label>
                                        <textarea rows="10" class="form-control" name="value">{{$setting->value}}</textarea>
                                    </div>
                                @endif

                                @if ($setting->type=='text')
                                    <div class="col-md-6">
                                        <label>Description</label>
                                        <input class="form-control" value="{{$setting->value}}" name="value"></input>
                                    </div>
                                @endif
                                @if ($setting->type=='email')
                                    <div class="col-md-6">
                                        <label>Description</label>
                                        <input type="email" class="form-control" value="{{$setting->value}}" name="value"></input>
                                    </div>
                                @endif
                                @if ($setting->type=='time' && $setting->key=='time_format')
                                    <div class="col-md-6">
                                        <label>Time Format</label>
                                        <select class="form-control" name="value">
                                            <option value="h:i A">12 Hours (01:00 P.M)</option>
                                            <option value="H:i">24 Hours (13:00)</option>
                                        </select></input>
                                    </div>
                                @endif
                                @if ($setting->type=='time' && $setting->key=='date_format')
                                    <div class="col-md-6">
                                        <label>Date Format</label>
                                        <select class="form-control" name="value">
                                            <option value="M d, Y">Jan 30, 1970</option>
                                            <option value="m/d/Y">01/30/1970</option>
                                            <option value="d/m/Y">30/01/1970</option>
                                        </select></input>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div align="right" class="box-footer"><button type="submit" class="btn btn-success">Update Changes</button></div>
                    </form>

                </div>

            </div>

        </section>
        <!-- /.content -->
    </div>

@endsection
