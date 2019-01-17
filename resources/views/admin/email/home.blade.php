@extends('admin.layouts.app')

@section('headSection')
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('main-content')

    <style>
        #menu-email{
            color:white;
        }
        table.dataTable thead > tr > th{
            padding-right:0;
            padding-left:0;
        }
        td{
            text-align:center;
        }
        td input{
            text-align:center;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {{--<h1>--}}
            {{--Data Tables--}}
            {{--<small>advanced tables</small>--}}
            {{--</h1>--}}
            {{--<ol class="breadcrumb">--}}
            {{--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
            {{--<li><a href="#">Tables</a></li>--}}
            {{--<li class="active">Data tables</li>--}}
            {{--</ol>--}}
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Users</h3>
                    {{--<a class='col-lg-offset-5 btn btn-success' href="{{ route('user.create') }}">Add New</a>--}}
                    @include('includes.messages')
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    <form role="form" id="user-select-form" action="edit_email" method="post">
                        @csrf
                        {{--{{ method_field('PUT')}}--}}
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Send Alert to Selected Users</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="padding-bottom: 30px;">
                                <table id="example1" class="table table-bordered table-striped" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        {{--<th>Employee Number</th>--}}
                                        {{--<th style="display: none;">ID</th>--}}
                                        <th>Select</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><input type="text" name="user-name[]" value="{{$user->first_name}}" style="border:none;background:none;text-align:center"></td>
                                            <td>{{ $user->last_name}}</td>
                                            <td><input type="text" name="user-email[]" value="{{$user->email}}" style="border:none;background:none;"></td>
                                            <td><input type="checkbox" class="flat-red select-user" name="selected-user[]" value="{{$user->id}}"></td>
                                        </tr>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>

                            </div>
                            <!-- /.box-body -->

                        </div>



                        <div style="float:right">

                            <input type="checkbox" id="check-all" class="flat-red">
                            <span style="margin-left:3px;margin-right:10px">Select All</span>
                            <button type="submit" class='btn btn-success' style="width:80px;">Send</button>

                        </div>


                    </form>
                </div>





                <!-- /.box-body -->
            {{--<div class="box-footer">--}}
            {{--Footer--}}

            {{--</div>--}}
            <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('footerSection')
    <script src="{{ asset('public/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('public/admin/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/iCheck/all.css')}}">
    <script src="{{ asset('public/admin/plugins/iCheck/icheck.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('input[type="checkbox"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });

            var table = $('#example1').DataTable({
                drawCallback: function(){
                    $('.paginate_button', this.api().table().container())
                        .on('click', function(){
                            $('input[type="checkbox"].flat-red').iCheck({
                                checkboxClass: 'icheckbox_flat-green'
                            });
                            if($('.select-user:checked').length== $('.select-user').length){
                                $( "#check-all" ).iCheck('Check');
                                console.log("All Checked.");
                            }
                            else{
                                $( "#check-all" ).iCheck('Uncheck');
                            }

                            $('#check-all').on('ifChecked', function (){
                                $( ".select-user" ).iCheck('Check');
                            });

                            $('#check-all').on('ifUnchecked', function (){
                                $( ".select-user" ).iCheck('Uncheck');
                            });
                        });

                },
                "ordering": false,
                "info":     false,
                "scrollX": true
            })


            $('#user-select-form').on('submit', function(e) {
                var $form = $(this);

                table.$('input[type="checkbox"]').each(function(){
                    if(!$.contains(document, this)){
                        if(this.checked){
                            $form.append(
                                $('<input>')
                                    .attr('type', 'hidden')
                                    .attr('name', this.name)
                                    .val(this.value)
                            );
                        }
                    }
                });
            });

        });


        $('#check-all').on('ifChecked', function (){
            $( ".select-user" ).iCheck('Check');
        });

        $('#check-all').on('ifUnchecked', function (){
            $( ".select-user" ).iCheck('Uncheck');
        });



    </script>
@endsection


