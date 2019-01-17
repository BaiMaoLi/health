

@extends('user.template')
<link rel="stylesheet" type="text/css" href="{{asset('public/user/css/edit_profile.css')}}">
@section('content')
    <script type="text/css">
        .white{
            background:white;
        }
    </script>


    <form role="form" id="form" action="{{ route('profile.update','1') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="edit-profile-main">
            @if (!is_null($profile))
                <div id="photo-part" style="position:relative">
                    <div id="user-photo-part" style="position:relative">
                        <div class="image-upload">
                            {{--<label for="profile_picture">--}}
                            @if (!is_null($profile->profile_picture))
                                <img src="{{$profile->profile_picture}}" id="user-photo">
                            @else
                                <img src="{{asset('public/user/images/profile_pictures/avatar.jpg')}}" id="user-photo">
                            @endif
                            <div id="image-overlay"></div>
                            {{--</label>--}}
                            {{--<input type="file" id="profile_picture" name="profile_picture" class="form-control" style="display:none;" disabled/>--}}
                            <div class="middle">
                                <i class="demo-icon icon-edit"></i>
                            </div>
                        </div>
                        <h4 id="employee-name-edit">{{ $user['first_name']." ".$user->last_name }}</h4>
                        <div class="row">
                            <h4 id="employee-id-title">Employee ID</h4>
                            <h4 id="employee-id-number-edit">{{ $user['employee_number']}}</h4>
                        </div>
                    </div>

                    {{--Pop up for selecting profile pic--}}
                    <div id="select_profile_pic" class="hidePopUp">
                        <div id="icon-part" >
                            <div class="avatar-icon" id="upload-btn">
                                <label for="profile_picture">
                                    @if (!is_null($profile->profile_picture))
                                        <img src="{{asset('public/user/images/profile_pictures/upload_image.png')}}" class="avatar-img">
                                        <img src="{{asset('public/user/images/profile_pictures/upload_icon.png')}}" id="upload-icon">
                                    @else
                                        <img src="{{asset('public/user/images/profile_pictures/upload_image.png')}}" class="avatar-img">
                                        <img src="{{asset('public/user/images/profile_pictures/upload_icon.png')}}" id="upload-icon">
                                    @endif
                                    <div id="image-overlay"></div>
                                </label>
                                <input type="file" id="profile_picture" name="profile_picture" class="form-control" style="display:none;"/>

                            </div>
                            <div class="avatar-icon" id="avatar1">
                                <img src="{{asset('public/user/images/profile_pictures/avatar1.png')}}" class="avatar-img">
                            </div>
                            <div class="avatar-icon" id="avatar2">
                                <img src="{{asset('public/user/images/profile_pictures/avatar2.png')}}" class="avatar-img">
                            </div>
                            <div class="avatar-icon" id="avatar3">
                                <img src="{{asset('public/user/images/profile_pictures/avatar3.png')}}" class="avatar-img">
                            </div>
                            <div class="avatar-icon" id="avatar4">
                                <img src="{{asset('public/user/images/profile_pictures/avatar4.png')}}" class="avatar-img">
                            </div>
                            <div class="avatar-icon" id="avatar5">
                                <img src="{{asset('public/user/images/profile_pictures/avatar5.png')}}" class="avatar-img">
                            </div>
                            <div class="avatar-icon" id="avatar6">
                                <img src="{{asset('public/user/images/profile_pictures/avatar6.png')}}" class="avatar-img">
                            </div>
                            <div class="avatar-icon" id="avatar7">
                                <img src="{{asset('public/user/images/profile_pictures/avatar7.png')}}" class="avatar-img">
                            </div>
                        </div>
                        <button id="select_avatar_save">SAVE</button>
                    </div>

                    <div id="coach-photo-part" style="display:none">
                        <img src="{{asset('public/user/images/coach_photo.png')}}" id="coach-photo">
                        <h4 id="coach_kind">MY WELLNESS COACH</h4>
                        <h4 id="coach_name">TALEI BERGER</h4>
                    </div>
                    <button id="message-my-coach" style="display:none">MESSAGE MY COACH</button>
                </div>
                <div class="information-part">
                    <i class="demo-icon icon-edit_profile" aria-hidden="true" id="user-profile-icon"></i>
                    <span id="personal-profile">PERSONAL PROFILE</span>
                    <input type="submit" id="edit-profile" value="EDIT"/>
                    @if(is_null($profile->address) or is_null($profile->city) or is_null($profile->city)
                        or is_null($profile->state) or is_null($profile->zip) or is_null($profile->email) or is_null($profile->phone)
                        or is_null($profile->birthday) or is_null($profile->gender))
                        <h4 class="warning">PLEASE FILL OUT MISSING FIELDS BELOW TO COMPLETE YOUR PROFILE</h4>
                    @endif
                    <div class="name-information">
                        <div class="row">
                            <h4 class="information-label">First Name:</h4>
                            <input class="information" name="first_name" value="{{ $user->first_name}}">
                        </div>

                        <div class="row">
                            <h4 class="information-label">Last Name:</h4>
                            <input class="information" name="last_name" value="{{ $user->last_name}}">
                        </div>


                        <div class="row">
                            <h4 class="information-label">Employee ID:</h4>
                            <input class="information" name="employee_id" value="{{ $user->employee_number}}">
                        </div>
                    </div>

                    <div class="address-information">
                        <div class="row">
                            @if(is_null($profile->address))
                                <h4 class="information-label miss-label">Address:</h4>
                                <input class="information miss-information" name="address" value="{{$profile->address}}">
                            @else
                                <h4 class="information-label">Address:</h4>
                                <input class="information" name="address" value="{{$profile->address}}">
                            @endif
                        </div>
                        <div class="row">
                            @if(is_null($profile->city))
                                <h4 class="information-label miss-label">City:</h4>
                                <input class="information miss-information" name="city" value="{{$profile->city}}">
                            @else
                                <h4 class="information-label">City:</h4>
                                <input class="information" name="city" value="{{$profile->city}}">
                            @endif

                        </div>
                        <div class="row">
                            @if(is_null($profile->state))
                                <h4 class="information-label miss-label">State:</h4>
                                <input class="information miss-information" name="state" id="state-display"  value="{{$profile->state}}">
                            @else
                                <h4 class="information-label">State:</h4>
                                <input class="information" name="state" id="state-display"  value="{{$profile->state}}">
                            @endif
                            <select class="information" name="state" id="state-select"  style="display: none">
                                @php
                                    foreach($states as $state){
                                        $html='';
                                        if($state==$profile->state){
                                            $html.='<option selected="selected">'.$state.'</option>';
                                        }
                                        else{
                                            $html.='<option>'.$state.'</option>';
                                        }
                                        echo $html;
                                    }
                                @endphp
                            </select>
                        </div>
                        <div class="row">
                            @if(is_null($profile->zip))
                                <h4 class="information-label miss-label">Zip:</h4>
                                <input class="information miss-information" name="zip" value="{{$profile->zip}}">
                            @else
                                <h4 class="information-label">Zip:</h4>
                                <input class="information" name="zip" value="{{$profile->zip}}">
                            @endif

                        </div>
                    </div>

                    <div class="email-information">
                        <div class="row">
                            @if(is_null($profile->email))
                                <h4 class="information-label miss-label">Email:</h4>
                                <input class="information miss-information" name="email" value="{{$profile->email}}">
                            @else
                                <h4 class="information-label">Email:</h4>
                                <input class="information" name="email" value="{{$profile->email}}">
                            @endif
                        </div>
                        <div class="row">
                            @if(is_null($profile->phone))
                                <h4 class="information-label miss-label">Phone:</h4>
                                <input class="information miss-information" name="phone" value="{{$profile->phone}}">
                            @else
                                <h4 class="information-label">Phone:</h4>
                                <input class="information" name="phone" value="{{$profile->phone}}">
                            @endif


                        </div>

                    </div>

                    <div class="birthday-information">
                        <div class="row">
                            @if(is_null($profile->birthday))
                                <h4 class="information-label miss-label">Birthday:</h4>
                                <input class="information miss-information" name="birthday" value="{{$profile->birthday}}" placeholder="mm/dd/yyyy">
                            @else
                                <h4 class="information-label">Birthday:</h4>
                                <input class="information" name="birthday" value="{{$profile->birthday}}" placeholder="mm/dd/yyyy">
                            @endif
                        </div>
                        <div class="row">
                            @if(is_null($profile->gender))
                                <h4 class="information-label miss-label">Gender:</h4>
                                <input class="information miss-information" name="gender" id="gender-display" value="{{$profile->gender}}">
                            @else
                                <h4 class="information-label">Gender:</h4>
                                <input class="information" name="gender" id="gender-display" value="{{$profile->gender}}">
                            @endif
                            <select class="information" name="gender" id="gender-select"  style="display: none">
                                @php
                                    $options=['Male','Female'];
                                    for($i=0;$i<2;$i++){
                                        $str='';
                                        if($options[$i]==$profile->gender){
                                            $str='<option selected="selected">'.$options[$i].'</option>';
                                        }
                                        else{
                                            $str.='<option>'.$options[$i].'</option>';
                                        }
                                        echo $str;

                                    }
                                @endphp

                            </select>
                        </div>

                    </div>

                    <div class="v-edit-profile"></div>
                </div>
                <input type="text" id="avatar_number" style="visibility:hidden" name="avatar_number" value="0">
            @else
                <div id="photo-part">
                    <div id="user-photo-part">
                        <div class="image-upload">
                            {{--<label for="profile_picture">--}}
                                <img src="{{asset('public/user/images/profile_pictures/avatar.jpg')}}" id="user-photo">
                                <div id="image-overlay"></div>
                            {{--</label>--}}
                            <div class="middle">
                                <i class="demo-icon icon-edit"></i>
                            </div>
                            {{--<input type="file" id="profile_picture" name="profile_picture" class="form-control" style="display:none;" disabled/>--}}
                        </div>
                        <h4 id="employee-name-edit">{{ $user['first_name']." ".$user->last_name }}</h4>
                        <div class="row">
                            <h4 id="employee-id-title">Employee ID</h4>
                            <h4 id="employee-id-number-edit">{{ $user['employee_number']}}</h4>
                        </div>
                    </div>
                    <div id="select_profile_pic" class="hidePopUp">
                        <div id="icon-part" >
                            <div class="avatar-icon" id="upload-btn">
                                <label for="profile_picture">
                                        <img src="{{asset('public/user/images/profile_pictures/upload_image.png')}}" class="avatar-img">
                                        <img src="{{asset('public/user/images/profile_pictures/upload_icon.png')}}" id="upload-icon">
                                    <div id="image-overlay"></div>
                                </label>
                                <input type="file" id="profile_picture" name="profile_picture" class="form-control" style="display:none;"/>

                            </div>
                            <div class="avatar-icon" id="avatar1">
                                <img src="{{asset('public/user/images/profile_pictures/avatar1.png')}}" class="avatar-img">
                            </div>
                            <div class="avatar-icon" id="avatar2">
                                <img src="{{asset('public/user/images/profile_pictures/avatar2.png')}}" class="avatar-img">
                            </div>
                            <div class="avatar-icon" id="avatar3">
                                <img src="{{asset('public/user/images/profile_pictures/avatar3.png')}}" class="avatar-img">
                            </div>
                            <div class="avatar-icon" id="avatar4">
                                <img src="{{asset('public/user/images/profile_pictures/avatar4.png')}}" class="avatar-img">
                            </div>
                            <div class="avatar-icon" id="avatar5">
                                <img src="{{asset('public/user/images/profile_pictures/avatar5.png')}}" class="avatar-img">
                            </div>
                            <div class="avatar-icon" id="avatar6">
                                <img src="{{asset('public/user/images/profile_pictures/avatar6.png')}}" class="avatar-img">
                            </div>
                            <div class="avatar-icon" id="avatar7">
                                <img src="{{asset('public/user/images/profile_pictures/avatar7.png')}}" class="avatar-img">
                            </div>
                        </div>
                        <button id="select_avatar_save">SAVE</button>
                    </div>
                </div>

                <div class="information-part">
                    <i class="demo-icon icon-edit_profile" aria-hidden="true" id="user-profile-icon"></i>
                    <span id="personal-profile">PERSONAL PROFILE</span>
                    <input type="submit" id="edit-profile" value="EDIT">
                    <h4 class="warning">PLEASE FILL OUT MISSING FIELDS BELOW TO COMPLETE YOUR PROFILE</h4>
                    <div class="name-information">
                        <div class="row">
                            <h4 class="information-label">First Name:</h4>
                            <input class="information" name="first_name" value="{{ $user->first_name}}">
                        </div>
                        <div class="row">
                            <h4 class="information-label">Last Name:</h4>
                            <input class="information" name="last_name" value="{{ $user->last_name}}">
                        </div>

                        <div class="row">
                            <h4 class="information-label">Employee ID:</h4>
                            <input class="information" name="employee_id" value="{{ $user->employee_number}}">
                        </div>
                    </div>

                    <div class="address-information">
                        <div class="row">
                            <h4 class="information-label miss-label">Address:</h4>
                            <input class="information miss-information" name="address" >
                        </div>
                        <div class="row">
                            <h4 class="information-label miss-label">City:</h4>
                            <input class="information miss-information" name="city" >
                        </div>
                        <div class="row">
                            <h4 class="information-label miss-label">State:</h4>
                            <input class="information miss-information" name="state" id="state-display">
                            <select class="information" name="state" id="state-select"  style="display: none">
                                @php
                                    $html='';
                                        foreach($states as $state){
                                                $html.='<option>'.$state.'</option>';
                                            echo $html;
                                        }
                                @endphp
                            </select>
                        </div>
                        <div class="row">
                            <h4 class="information-label miss-label">Zip:</h4>
                            <input class="information miss-information" name="zip">
                        </div>
                    </div>

                    <div class="email-information">
                        <div class="row">
                            <h4 class="information-label">Email:</h4>
                            <input class="information" name="email" value="{{$user->email}}">
                        </div>
                        <div class="row">
                            <h4 class="information-label miss-label">Phone:</h4>
                            <input class="information miss-information" name="phone" >
                        </div>

                    </div>

                    <div class="birthday-information">
                        <div class="row">
                            <h4 class="information-label miss-label">Birthday:</h4>
                            <input class="information miss-information" name="birthday" placeholder="mm/dd/yyyy">
                        </div>
                        <div class="row">
                            <h4 class="information-label miss-label">Gender:</h4>
                            <input type="text" class="information miss-information" id="gender-display" name="gender">
                            <select class="information" name="gender" id="gender-select"  style="display: none">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>
                    <input type="text" id="avatar_number" style="visibility:hidden" name="avatar_number" value="0">

                    <div class="v-edit-profile"></div>
                </div>
            @endif
        </div>
    </form>





    <script type="text/javascript">
        var i=0;
        var avatar_number=0;
        $(document).ready(function() {
            $('.information').prop("disabled", true);
        });

        $('.image-upload').click(function () {
            var top=parseInt($('#user-photo-part').css('margin-top'))+(parseInt($(this).css('height')))/2-10;
            var left=(parseInt($(this).css('width')))/2-10;
            $('#select_profile_pic').css('left',left);
            $('#select_profile_pic').css('top',top);
            $('#select_profile_pic').show();
            $('#select_profile_pic').toggleClass('hidePopUp');
            avatar_number=$('#avatar_number').val();

        })

        $('#select_avatar_save').click(function (e) {
            $('#select_profile_pic').addClass('hidePopUp');
            e.preventDefault();
            $('#avatar_number').val(avatar_number);

        })

        $('.avatar-icon').click(function () {
            var id=this.id;
            if(id!='upload-btn'){
                avatar_number=parseInt(id.replace('avatar',''));
                var imageSrc="<?php echo url('/').'/public/user/images/profile_pictures/'?>"+id+'.png';
                $('#user-photo').attr('src',imageSrc);
            }

        })


        jQuery("#edit-profile").click(function() {
            var btn = document.getElementById('edit-profile');
            $(this).val('Save');

            $('#gender-display').hide();
            $('#gender-select').show();
            $('#state-display').hide();
            $('#state-select').show();

            $('.information').prop("disabled", false);
            var information=document.getElementsByClassName('information');
            for ( var i=0; i<information.length; i++ ) {
                information[i].style.backgroundColor = "white";
            }
            // document.getElementById("profile_picture").disabled =false;
            document.getElementById('user-photo').style.cursor="pointer";


            $('.image-upload').addClass('image-upload1');

            $('.image-upload').css('pointer-events','auto');


            $('#image-overlay').show();
            $('.middle').css('opacity',0.5);


        });
        $('#form').submit(function(e) {
            var name=document.getElementById('edit-profile').value;
            if (i==0) {
                e.preventDefault();            // document.getElementById('edit-profile').val('Save');
            }
            else
                return true;
            i++;
        });

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
            avatar_number=0;
            readURL(this);
        });

        $(".information").focusin(function(){
            if ( $( this ).hasClass( "miss-information" ) ) {
                $(this).removeClass('miss-information');
                $(this).parent().find("h4").removeClass('miss-label');
            }
        });

        $(".information").focusout(function () {
            var text=this.value;
            console.log(text);
            if (text==''){
                $(this).addClass('miss-information');
                $(this).parent().find("h4").addClass('miss-label');
            }
            else{
                if ( $( this ).hasClass( "miss-information" ) ) {
                    $(this).removeClass('miss-information');
                    $(this).parent().find("h4").removeClass('miss-label');
                }
            }
        })

    </script>
@endsection


