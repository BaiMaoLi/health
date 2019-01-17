@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('main-content')
    <style>
        #menu-task{
            color:white;
        }
        table.dataTable thead > tr > th{
            padding-right:0;
            padding-left:0;
        }
        
    </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            My Heart Tasks
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Admin</a></li>
            <li><a href="#">tasks</a></li>
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
    <div class="box">
      <div class="box-header with-border">
        {{--<h3 class="box-title">events</h3>--}}
        <a class='col-lg-offset-5 btn btn-success add-new' href="{{ route('task.create') }}">Add New</a>
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
                    <div class="box-header">

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-active table-hover table-danger" style="text-align:center;width:100%">
                        <thead>
                        <tr>
                          <th class="no-order" style="backgroud:none">No</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Wellness Star</th>
                          <th>Duration</th>
                          <th>Gender</th>
                          <th>Age</th>
                          <th>Complete</th>
                          <th>InComplete</th>
                          <th>Edit</th>
                          <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tasks as $task)
                          <tr>
                            <td >{{ $loop->index + 1 }}</td>
                            <td>{{ $task->title}}</td>
                            <td>{{ $task->category}}</td>
                            <td>{{ $task->star}}</td>
                            <td>{{ $task->task_duration}}</td>
                            <td>{{ $task->gender}}</td>
                            <td>{{ $task->age}}</td>
                              <td><a href="{{ route('task.show',$task->id) }}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                              <td><a href="{{ route('task.showUnregsters',$task->id) }}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                            <td><a href="{{ route('task.edit',$task->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                            <td>
                               <form id="delete-form-{{ $task->id }}" method="post" action="{{ route('task.destroy',$task->id) }}" style="display: none">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                               </form>
                                <a href="" onclick="
                                if(confirm('Are you sure, You Want to delete this?'))
                                    {
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{ $task->id }}').submit();
                                    }
                                    else{
                                      event.preventDefault();
                                    }" ><span class="glyphicon glyphicon-trash"></span></a>
                              </td>
                            </tr>
                          </tr>
                        @endforeach
                        </tbody>

                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        Footer
      </div>
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
<script>
  $(function () {

    $("#example1").DataTable({
        "ordering": false,
        "info":     false,
        "scrollX": true

    });

  });
</script>
@endsection