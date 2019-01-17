@extends('admin.layouts.app')

@section('main-content')
  <!-- Content Wrapper. Contains page content -->

  <style>
      #menu-event{
          color:white;
      }
      #event_picture{
          height:110px;
          width:auto;
          cursor:pointer;
      }
      #event_picture1{
          height:110px;
          width:auto;
          cursor:pointer;
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
              <h3 class="box-title">Add event</h3>
            </div>

            {{--@include('includes.messages')--}}
            <!-- /.box-header -->
            <!-- form start -->
              <form role="form" action="{{ route('event.store') }}" method="post" enctype="multipart/form-data">
                  @csrf

          <div class="box-body">
              <div class="row">
              <div class="col-6 col-sm-6">
                  <div class="form-group">
                      <label for="event_title">Event Title</label>
                      <input type="text" class="form-control" id="event_title" name="event_title" placeholder="Event Title">
                  </div>

                  <div class="form-group">
                      <label for="event_location">Event Location</label>
                      <input type="text" class="form-control" id="event_location" name="event_location" placeholder="Event Location">
                  </div>

                  <div class="form-group">
                    <label>Event Date</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="event_date">
                      </div>
                  </div>

                  <div class="bootstrap-timepicker">
                      <div class="form-group">
                          <label>Event Time</label>
                          <div class="input-group">
                              <input type="text" class="form-control timepicker" name="event_time">
                              <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label>
                          <input type="checkbox" class="flat-red" name="create_task">
                          &nbsp;&nbsp;&nbsp;&nbsp;Count towards Wellness Stars?
                      </label>
                  </div>


              </div>
              <div class="col-6 col-sm-6">
                <div class="form-group">
                  <label>Select Privacy</label>
                    <select name="categories" type="categories" class="form-control">
                      @foreach ($categories as $category)
                        <option>{{$category->category_name}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <label>Select Category</label>
                    <select  name="tags" type="tags" class="form-control" type="text">
                        @foreach ($tags as $tag)
                            <option>{{$tag->tag_name}}</option>
                        @endforeach
                    </select>
                </div>
                  <div>
                      <div style="float:left">
                          <label for="image-upload">Select Featured Image</label>
                          <div class="image-upload">
                              <label for="featured_picture">
                                  <img src="{{asset('public/event_pictures/upload_icon.png')}}" id="event_picture">
                              </label>
                              <input type="file" id="featured_picture" name="slide_picture" class="form-control" style="display:none;" />
                          </div>
                      </div>
                      <div style="float:left;margin-left:50px;">
                          <label for="image-upload1">Select Event Image</label>
                          <div class="image-upload1">
                              <label for="featured_picture1">
                                  <img src="{{asset('public/event_pictures/upload_icon.png')}}" id="event_picture1">
                              </label>
                              <input type="file" id="featured_picture1" name="featured_picture" class="form-control" style="display:none;" />
                          </div>
                      </div>
                  </div>
              </div>
              </div>


            <div class="box" style="margin-top:30px;">
                    <div class="box-header">
                        <h3 class="box-title">Write Event Content Here
                            <small>Simple and fast</small>
                        </h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i></button>

                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        <form>
                          <textarea class="textarea" name="event_body" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </form>
                    </div>
                </div>


            <div class="box-footer">
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
                  <a href='{{ route('event.index') }}' class="btn btn-warning">Back</a>
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
            // document.getElementById("event_picture").style.width="180px";
            readURL(this);
        });

        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#event_picture1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#featured_picture1").change(function(){
            // document.getElementById("event_picture1").style.width="180px";
            readURL1(this);
        });

    </script>
@endsection










