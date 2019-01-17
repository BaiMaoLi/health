@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('main-content')

    <style>
        #menu-event{
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
            All events
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Admin</a></li>
            <li><a href="#">events</a></li>

        </ol>
    </section>

  <!-- Main content -->
  <section class="content">
<style type="text/css">
    .event_picture{
        /*border-radius:50px;*/
        width:100px;
        height:100px;
    }
    th{
        text-align:center;
    }
</style>
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        {{--<h3 class="box-title">events</h3>--}}
        <a class='col-lg-offset-5 btn btn-success add-new' href="{{ route('event.create') }}">Add New</a>
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
                      {{--<h3 class="box-title">Data Table With Full Features</h3>--}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-active table-hover table-danger" style="text-align:center;width:100%">
                        <thead>
                        <tr>
                          <th style="background : none;">No</th>
                          <th>Featured Image</th>
                          <th>Title</th>
                          {{--<th>Category</th>--}}
                          {{--<th>Tag</th>--}}
                          <th>Location</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Users Registered</th>
                          <th>Edit</th>
                          <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($events as $event)
                          <tr>
                            <td >{{ $loop->index + 1 }}</td>

                            {{--<td>{{ $category->category_name}}</td>--}}
                            {{--<td>{{ $tag->tag_name}}</td>--}}
                              <td>
                                      @if(!is_null($event->featured_picture))
                                          {{--<img src="{{public_path()}}/event_pictures/{{$event->featured_picture}}" class="event_picture">--}}
                                      <img src="{{asset('public/event_pictures/')}}/{{$event->featured_picture}}" class="event_picture">
                                      @else
                                          <img src="{{asset('public/event_pictures/event_default.jpg')}}" class="event_picture">
                                      @endif
                              </td>
{{--                              <td> <img class="event_picture" src="{{asset('public/event_pictures/Koala.jpg')}}"/> </td>--}}
                            <td>{{ $event->event_title}}</td>
                            <td>{{ $event->event_location}}</td>
                            <td>{{ $event->event_date}}</td>
                            <td>{{ $event->event_time}}</td>
                              <td><a href="{{ route('event.show',$event->id) }}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                            <td><a href="{{ route('event.edit',$event->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                            <td>
                               <form id="delete-form-{{ $event->id }}" method="post" action="{{ route('event.destroy',$event->id) }}" style="display: none">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                               </form>
                                <a href="" onclick="
                                if(confirm('Are you sure, You Want to delete this?'))
                                    {
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{ $event->id }}').submit();
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