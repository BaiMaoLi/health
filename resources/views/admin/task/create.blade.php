{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
{{--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">--}}
{{--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>--}}

@extends('admin.layouts.app')

@section('main-content')

  <style>
      #menu-task{
          color:white;
      }
      #slider12a .slider-track-high, #slider12c .slider-track-high {
          background: green;
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
              <h3 class="box-title">Add task</h3>
            </div>

            @include('includes.messages')
            <!-- /.box-header -->
            <!-- form start -->
              <form role="form" action="{{ route('task.store') }}" method="post" enctype="multipart/form-data">
                  @csrf

          <div class="box-body">
              <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group">
                      <label for="title">Task Title</label>
                      <input type="text" class="form-control" id="title" name="title" placeholder="Event Title">
                  </div>

                  <div class="form-group">
                      <label>Select Category</label>
                      <select name="categories" type="categories" class="form-control">
                          <option>My Physical</option>
                          <option>My Education</option>
                          <option>My Lifestyle</option>
                      </select>
                  </div>

                  <div class="form-group">
                      <label>TaskDuration</label>
                      <select name="task_duration" type="categories" class="form-control">
                          <option>1 Year</option>
                          <option>2 Years</option>
                          <option>3 Years</option>
                          <option>4 Years</option>
                          <option>5 Years</option>
                      </select>
                  </div>

                  <div class="form-group">
                      <label>Select Gender</label>
                      <select name="gender" type="genders" class="form-control">
                          <option>Both</option>
                          <option>Male</option>
                          <option>Female</option>
                      </select>
                  </div>

                  <div class="form-group">
                     <label for="age">Select Age</label>
                      <div class="input-group">
                          <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="" style="height: 34px;">
                              <span class="glyphicon glyphicon-minus"></span>
                            </button>
                          </span>
                         <input id="age" type="text" name="age" value="0+" class="form-control">
                         <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="" style="height: 34px;">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                          </span>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="title">Wellness Star</label>
                      <input type="number" class="form-control" id="star" name="star" value="1">
                  </div>

              </div>
              </div>

              </div>


            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-8" style="text-align: right">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href='{{ route('task.index') }}' class="btn btn-warning">Back</a>
                        </div>
                    </div>
                </div>
            </div>

        </form>
      </div>
    </div>

  </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




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
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/iCheck/all.css')}}">
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('public/admin/plugins/iCheck/icheck.min.js')}}"></script>




    <!-- Page script -->
    <script>
        $(function () {


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



            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })
        });


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#event_picture').attr('src', e.target.result);

                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#featured_picture").change(function(){
            document.getElementById("event_picture").style.width="180px";
            readURL(this);
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










