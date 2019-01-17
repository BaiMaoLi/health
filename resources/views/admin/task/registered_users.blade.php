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
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Complete
            {{--<small>advanced tables</small>--}}
        </h1>
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
        <div class="box">
                    <div class="box-header">
                      {{--<h3 class="box-title">Data Table With Full Features</h3>--}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Mark As</th>
{{--<th>Make Ambassador</th>--}}

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                          <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->first_name}}</td>
                              <td>{{ $user->last_name}}</td>
                              <td>{{ $user->email}}</td>
                              <td class="block-td"><a href="{{ route('makeIncomplete',['user_id'=>$user->id,'task_id'=>$task_id]) }}"><button type="button" class="btn btn-block btn-danger">Mark Incomplete</button></a></td>
                              {{--@if($user->ambassador==0)--}}
                                {{--<td class="block-td"><a href="{{ route('makeAmbassador',['user_id'=>$user->id,'task_id'=>$task_id]) }}"><button type="button" class="btn btn-block btn-success">Make Ambassador</button></a></td>--}}
                              {{--@else--}}
                                {{--<td class="block-td"><button type="button" class="btn btn-block btn-success disabled">Make Ambassador</button></td>--}}
                              {{--@endif--}}
                            </tr>
                          </tr>
                        @endforeach
                        </tbody>

                      </table>

                    </div>
          <div style="float:right;margin-top:20px">
            <a href='complete_user/edit/alert/{{$task_id}}' class="btn btn-warning">Send Alert</a>
            <a href='{{ route('task.index') }}' class="btn btn-warning">Back</a>
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