@extends('admin.layouts.app')

@section('main-content')
  <style>
    #menu-user{
      color:white;
    }
    #user-photo{
      width:170px;
      height:170px;
      cursor:pointer;
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
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
              <h3 class="box-title">Update User</h3>
            </div>

            @include('includes.messages')
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('user.update',$user->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="box-body">
                <div class="col-md-offset-1 col-md-5">
                  <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="@if (old('fist_name')){{ old('fist_name') }}@else{{ $user->first_name }}@endif">
                  </div>

                  <div class="form-group">
                      <label for="last_name">Last Name</label>
                      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="@if (old('last_name')){{ old('last_name') }}@else{{ $user->last_name }}@endif">
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="email" value="@if (old('email')){{ old('email') }}@else{{ $user->email }}@endif">
                  </div>

                  <div class="form-group">
                    <label for="employee_number">Employee Number</label>
                    <input type="text" class="form-control" id="employee_number" name="employee_number" placeholder="Employee Number" value="@if (old('employee_number')){{ old('employee_number') }}@else{{ $user->employee_number }}@endif">
                  </div>


                  @if (!is_null($profile))
                    <div class="form-group">
                      <label for="name">Address</label>
                      <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="@if (old('address')){{ old('address') }}@elseif(!is_null($profile->address)){{ $profile->address }}@endif">
                    </div>
                    <div class="form-group">
                      <label for="city">City</label>
                      <input type="text" class="form-control" id="city" name="city" placeholder="City" value="@if (old('city')){{ old('city') }}@elseif(!is_null($profile->city)){{ $profile->city }}@endif">
                    </div>
                    <div class="form-group">
                      <label for="state">State</label>
                      <input type="text" class="form-control" id="state" name="state" placeholder="State" value="@if (old('state')){{ old('state') }}@elseif(!is_null($profile->state)){{ $profile->state }}@endif">
                    </div>

                        <div class="form-group">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" value="@if (old('zip')){{ old('zip') }}@elseif(!is_null($profile->zip)){{ $profile->zip }}@endif">
                        </div>

                  @else
                    <div class="form-group">
                      <label for="name">Address</label>
                      <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="@if (old('address')){{ old('address') }}@endif">
                    </div>
                    <div class="form-group">
                      <label for="city">City</label>
                      <input type="text" class="form-control" id="city" name="city" placeholder="City" >
                    </div>
                    <div class="form-group">
                      <label for="state">State</label>
                      <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{ old('state') }}">
                    </div>

                        <div class="form-group">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip">
                        </div>
                  @endif
              </div>

                <div class="col-md-offset-1 col-md-5">
                  @if (!is_null($profile))


                    <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="@if (old('phone')){{ old('phone') }}@elseif(!is_null($profile->phone)){{ $profile->phone }}@endif">
                    </div>

                    <div class="form-group">
                      <label for="birthday">Birthday</label>
                      <input type="text" class="form-control" id="birthday" name="birthday" placeholder="Birthday" value="@if (old('birthday')){{ old('birthday') }}@elseif(!is_null($profile->birthday)){{ $profile->birthday }}@endif">
                    </div>

                    <div class="form-group">
                      <label for="gender">Gender</label>
                      <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender" value="@if (old('gender')){{ old('gender') }}@elseif(!is_null($profile->gender)){{ $profile->gender }}@endif">
                    </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Passowrd</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                        </div>



                    <label for="image-upload">Profile Picture</label>
                    <div class="image-upload">
                      <label for="profile_picture">
                        @if(!is_null($profile->profile_picture))
                          <img src="{{$profile->profile_picture}}" id="user-photo">
                        @else
                          <img src="{{asset('public/user/images/profile_pictures/avatar.jpg')}}" id="user-photo">
                        @endif
                      </label>
                      <input type="file" id="profile_picture" name="profile_picture" class="form-control" style="display:none;" />
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href='{{ route('user.index') }}' class="btn btn-warning">Back</a>
                    </div>
                  @else


                    <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                    </div>

                    <div class="form-group">
                      <label for="birthday">Birthday</label>
                      <input type="text" class="form-control" id="birthday" name="birthday" placeholder="Birthday">
                    </div>

                    <div class="form-group">
                      <label for="gender">Gender</label>
                      <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender">
                    </div>

                    <label for="image-upload">Profile Picture</label>
                    <div class="image-upload">
                      <label for="profile_picture">
                        <img src="{{asset('public/user/images/profile_pictures/avatar.jpg')}}" id="user-photo">
                      </label>
                      <input type="file" id="profile_picture" name="profile_picture" class="form-control" style="display:none;" />
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href='{{ route('user.index') }}' class="btn btn-warning">Back</a>
                    </div>

                  @endif
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
  {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
  <script>
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#user-photo').attr('src', e.target.result);

              }
              reader.readAsDataURL(input.files[0]);
          }
      }
      $("#profile_picture").change(function(){
          document.getElementById("user-photo").style.width="180px";
          readURL(this);
      });

  </script>
@endsection