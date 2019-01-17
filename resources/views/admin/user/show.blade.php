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
    td{
      text-align:center;
    }
    td input{
      text-align:center;
    }

    @media (max-width: 767px){
      .add-new-container{
        margin-left:0 !important;
      }
    }


  </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Users
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
        <div class="row col-sm-offset-4 col-md-offset-5 add-new-container">
          <a class='btn btn-success add-new' href="{{ route('user.create') }}">Add New</a>
          <a class='btn btn-success print' href="{{ route('admin.user.printall') }}"><i class="fa fa-print" style="margin-right:10px;"></i>Print</a>
          <a class='btn btn-success add-new' href="{{ route('admin.user.download') }}">Export</a>
        </div>


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
                          <th>Employee Number</th>
                          <th>View Tasks</th>
                          <th>Mark Ambassador</th>
                          <th>Wellness Stars</th>
                          <th>Edit</th>
                          <th>Print</th>
                          <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($users as $user)
                          <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->first_name}}</td>
                              <td>{{ $user->last_name}}</td>
                              <td>{{ $user->email}}</td>
                              <td>{{ $user->employee_number}}</td>
                            <td><a href="{{ route('user.tasks',$user->id) }}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                              @if($user->ambassador==0)
                                 <td class="block-td"><a href="{{ route('makeAmbassador',['user_id'=>$user->id,'task_id'=>1]) }}"><button type="button" class="btn btn-block btn-success">Mark Ambassador</button></a></td>
                              @else
                                  <td class="block-td"><a href="{{ route('removeAmbassador',['user_id'=>$user->id,'task_id'=>1]) }}"><button type="button" class="btn btn-danger btn-block">Remove Ambassador</button></a></td>
                              @endif
                            <td>{{$wellness_stars[$loop->index]}}</td>

                              <td><a href="{{ route('user.edit',$user->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                              <td><a href="{{ route('admin.user.print',$user->id) }}"><span class="glyphicon glyphicon-print"></span></a></td>
                              <td>
                                <form id="delete-form-{{ $user->id }}" method="post" action="{{ route('user.destroy',$user->id) }}" style="display: none">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                </form>
                                <a href="" onclick="
                                if(confirm('Are you sure, You Want to delete this?'))
                                    {
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{ $user->id }}').submit();
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