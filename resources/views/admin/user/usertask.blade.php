@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('main-content')
    <style>
        #menu-user{
            color:white;
        }
        table.dataTable thead > tr > th{
            padding-right:0;
            padding-left:0;
        }
        /*.btn-block{*/
            /*width:130px;*/
            /*border-radius:18px;*/
            /*margin:auto;*/
        /*}*/
        /*.block-td{*/
            /*width:150px;*/
        /*}*/
        
    </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>

        </h1>
        <ol class="breadcrumb">
            {{--<li><a href="#"><i class="fa fa-dashboard"></i>Admin</a></li>--}}
            {{--<li><a href="#">tasks</a></li>--}}
        </ol>
    </section>

  <!-- Main content -->
  <section class="content">
<style type="text/css">
    th{
        text-align:center;
    }
</style>
    <!-- Default box -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title" style="font-size:20px;font-weight:bold">{{$user_name}} Complete Tasks</h3>
        {{--@include('includes.messages')--}}
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body ">
          <div class="box">
                    <div class="box-header" style="font-weight: bold;">
                        My Heart Tasks
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-active table-hover table-danger" style="text-align:center;width:100%">
                        <thead>
                            <tr>
                              <th class="no-order" style="backgroud:none">No</th>
                              <th>Title</th>
                              <th>Category</th>
                              <th>Expiration Date</th>
                              <th>Age</th>
                              <th>Mark As</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($completed_tasks as $task)
                              <tr>
                                <td >{{ $loop->index + 1 }}</td>
                                <td>{{ $task->title}}</td>
                                <td>{{ $task->category}}</td>
                                <td>{{ $task->expire_date}}</td>
                                <td>{{ $task->age}}</td>
                                <td class="block-td"><a href="{{ route('makeIncomplete',['user_id'=>$user_id,'task_id'=>$task->id]) }}"><button type="button" class="btn btn-block btn-danger">Mark Incomplete</button></a></td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
          </div>

          <div class="box" style="margin-top:60px;">
              <div class="box-header" style="font-weight: bold;">
                Individual Tasks
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <table id="example3" class="table table-bordered table-active table-hover table-danger" style="text-align:center;width:100%">
                      <thead>
                      <tr>
                          <th class="no-order" style="backgroud:none">No</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Expiration Date</th>
                          <th>Mark As</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach ($individual_complete_tasks as $task)
                          <tr>
                              <td >{{ $loop->index + 1 }}</td>
                              <td>{{ $task->title}}</td>
                              <td>{{ $task->category}}</td>
                              <td>{{ $task->expire_date}}</td>
                              <td class="block-td"><a href="{{ route('markIncompleteIndividualTask',['user_id'=>$user_id,'task_id'=>$task->id]) }}"><button type="button" class="btn btn-block btn-danger">Mark Incomplete</button></a></td>
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
              </div>

          </div>
      </div>
    </div>

      <div class="box box-danger" style="margin-top:100px;">
          <div class="box-header with-border">
              <h3 class="box-title" style="font-size:20px;font-weight:bold">{{$user_name}} Incomplete Tasks</h3>
              {{--@include('includes.messages')--}}
              <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fa fa-times"></i></button>
              </div>
          </div>
          <div class="box-body">
              <div class="box">
                  <div class="box-header" style="font-weight:bold">
                      My Heart Tasks
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                      <table id="example2" class="table table-bordered table-active table-hover table-danger" style="text-align:center;width:100%">
                          <thead>
                          <tr>
                              <th class="no-order" style="backgroud:none">No</th>
                              <th>Title</th>
                              <th>Category</th>
                              <th>Expiration Date</th>
                              <th>Age</th>
                              <th>Mark As</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach ($incompleted_tasks as $task)
                              <tr>
                                  <td >{{ $loop->index + 1 }}</td>
                                  <td>{{ $task->title}}</td>
                                  <td>{{ $task->category}}</td>
                                  <td>{{ $task->expire_date}}</td>
                                  <td>{{ $task->age}}</td>
                                  <td class="block-td"><a href="{{ route('makeComplete',['user_id'=>$user_id,'task_id'=>$task->id]) }}"><button type="button" class="btn btn-block btn-success">Mark Complete</button></a></td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>

              <div class="box" style="margin-top:60px;">
                  <div class="box-header" style="font-weight: bold;">
                      Individual Tasks
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                      <table id="example4" class="table table-bordered table-active table-hover table-danger" style="text-align:center;width:100%">
                          <thead>
                          <tr>
                              <th class="no-order" style="backgroud:none">No</th>
                              <th>Title</th>
                              <th>Category</th>
                              <th>Expiration Date</th>
                              <th>Mark As</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach ($individual_incomplete_tasks as $task)
                              <tr>
                                  <td >{{ $loop->index + 1 }}</td>
                                  <td>{{ $task->title}}</td>
                                  <td>{{ $task->category}}</td>
                                  <td>{{ $task->expire_date}}</td>
                                  <td class="block-td"><a href="{{ route('markCompleteIndividualTask',['user_id'=>$user_id,'task_id'=>$task->id]) }}"><button type="button" class="btn btn-block btn-success">Mark Complete</button></a></td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>



  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('footerSection')
<script src="{{ asset('public/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/admin/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
  $(function () {

    $("#example1").DataTable({
        "ordering": false,
        "info":     false,
        "scrollX": true

    });

      $("#example2").DataTable({
          "ordering": false,
          "info":     false,
          "scrollX": true

      });
      $("#example3").DataTable({
          "ordering": false,
          "info":     false,
          "scrollX": true

      });

      $("#example4").DataTable({
          "ordering": false,
          "info":     false,
          "scrollX": true

      });

  });
</script>
@endsection