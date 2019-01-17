@extends('admin.layouts.app')

@section('main-content')

    <style>
        #menu-alert{
            color:white;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @include('admin.layouts.pagehead')
            {{--<ol class="breadcrumb">--}}
            {{--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
            {{--<li><a href="#">Alerts</a></li>--}}
            {{--<li class="active">Edit</li>--}}
            {{--</ol>--}}
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Send Alerts</h3>
                        </div>

                    @include('includes.messages')
                    <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('task.sendAlert',$task_id)}}" method="post">
                            {{ csrf_field() }}
                            {{--{{ method_field('PUT') }}--}}
                            <div class="box-body">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="alert_title">Alert Title</label>
                                        <input type="text" class="form-control" id="alert_title" name="alert_title" placeholder="Alert Title">
                                    </div>
                                    <form>
                                        <textarea class="textarea" name="alert_body" placeholder="Alert Content Here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;
                          padding: 10px;margin-bottom:10px;"></textarea>
                                    </form>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="../../task" class="btn btn-warning">Back</a>
                                    </div>

                                </div>

                            </div>

                        </form>
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection