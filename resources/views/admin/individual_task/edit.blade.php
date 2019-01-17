@extends('admin.layouts.app')

@section('main-content')
    <!-- Content Wrapper. Contains page content -->

    <style>
        #menu-individualtask{
            color:white;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @include('admin.layouts.pagehead')
            {{--<ol class="breadcrumb">--}}
                {{--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
                {{--<li><a href="#">Forms</a></li>--}}
                {{--<li class="active">Editors</li>--}}
            {{--</ol>--}}
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Individual Task</h3>
                        </div>

                    {{--@include('includes.messages')--}}
                    <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('IndividualTaskUpdate', $task->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{--{{ method_field('PUT') }}--}}
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class="form-group">
                                            <label for="title">Task Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="@if (old('title')){{ old('title') }}@else{{ $task->title }}@endif">
                                        </div>
                                        <div class="form-group">
                                            <label>Select Category</label>
                                            <select name="categories" type="categories" class="form-control">
                                                @php
                                                    $options=['My Physical','My Education','My Lifestyle'];
                                                    for ($i=0;$i<3;$i++){
                                                        $str='';
                                                        if ($options[$i]==$task->category){
                                                            $str.='<option selected="selected">'.$options[$i].'</option>';
                                                        }
                                                        else{
                                                            $str.='<option>'.$options[$i].'</option>';
                                                        }
                                                        echo $str;
                                                    }
                                                @endphp
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>TaskDuration</label>
                                            <select name="task_duration" type="categories" class="form-control">
                                                @php
                                                    $options=['1 Year','2 Years','3 Years','4 Years','5 Years'];
                                                    for ($i=0;$i<5;$i++){
                                                        $str='';
                                                        if ($options[$i]==$task->task_duration){
                                                            $str.='<option selected="selected">'.$options[$i].'</option>';
                                                        }
                                                        else{
                                                            $str.='<option>'.$options[$i].'</option>';
                                                        }
                                                        echo $str;
                                                    }
                                                @endphp
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Wellness Star</label>
                                            <input type="number" class="form-control" id="star" name="star" value="@if (old('star')){{ old('star') }}@else{{ $task->star }}@endif">
                                        </div>


                                      </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-sm-offset-2 col-sm-8" style="text-align: right">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href='../show' class="btn btn-warning">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection


@section('footerSection')

    <!-- Select2 -->
    <script src="{{asset('public/admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('public/admin/plugins/input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{asset('public/admin/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
    <script src="{{asset('public/admin/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('public/admin/bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('public/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{asset('public/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- bootstrap color picker -->
    <script src="{{asset('public/admin/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
    <!-- bootstrap time picker -->
    <script src="{{asset('public/admin/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('public/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- iCheck 1.0.1 -->
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/iCheck/all.css')}}">
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('public/admin/plugins/iCheck/icheck.min.js')}}"></script>


    <!-- Page script -->
    <script>
        $(function () {
            $('input[type="checkbox"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });


            //Initialize Select2 Elements
            $('.select2').select2()

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
            //Date range as a button
            $('#daterange-btn').daterangepicker(
                {
                    ranges   : {
                        'Today'       : [moment(), moment()],
                        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                },
                function (start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            )

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true,
                orientation: "bottom auto",
                // startDate: new Date(),
                setDate: new Date(),
                todayHighlight: true,

            })

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass   : 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
            })

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })
        });


        $(document).ready(function(){
            var quantitiy=0;
            $('.quantity-right-plus').click(function(e){
                e.preventDefault();
                var quantity = parseInt($('#age').val());
                $('#age').val(quantity + 1+'+');

            });

            $('.quantity-left-minus').click(function(e){
                e.preventDefault();
                var quantity = parseInt($('#age').val());
                if(quantity>0){
                    $('#age').val(quantity - 1+'+');
                }
            });

        });




    </script>

@endsection










