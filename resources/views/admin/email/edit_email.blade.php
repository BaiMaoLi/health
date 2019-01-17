@extends('admin.layouts.app')

@section('main-content')

    <style>
        #menu-email{
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
                            <h3 class="box-title">Send Email to Users</h3>
                        </div>

                    @include('includes.messages')
                    <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="send_email" method="post" enctype="multipart/form-data">
                            @csrf
                            {{--{{ method_field('PUT') }}--}}
                            <div class="box-body">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="alert_title">Email Subject</label>
                                        <input type="text" class="form-control" id="alert_title" name="alert_title" placeholder="Email Subject">
                                    </div>
                                    <form>
                                        <textarea class="textarea" name="alert_body" placeholder="Email Details Here"
                                             style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;
                          padding: 10px;margin-bottom:10px;"></textarea>
                                    </form>
                                    <div class="form-group">
                                        <label for="attach_file">File Attach</label>
                                        <input type="file" class="form-control" id="attach_file" name="attach_files[]" placeholder="Select Attach File" accept="image/*,.pdf,.doc,.docx" multiple>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="email_page" class="btn btn-warning">Back</a>
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