@extends('layouts.userfound')
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-icons.css')}}">
    <link rel="icon" href="{{asset('images/edituserprofile.png')}}" />
    <title>Edit Profile</title>
</head>
@section('content')
@include('layouts.global')



<div class="grid-x grid-padding-y">
    <div class="cell small-1"></div>
    <div class="cell small-5"><a href="/eventfound/view" class="back-btn"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i>Back</a></div>
    <div class="cell small-5 hollow"></div>
</div>


    <form id="frmpro-user" method="POST" class="frm-profile" enctype="multipart/form-data">
        @csrf
        <div class="grid-x">
            <div class="cell small-1"></div>
                <h3>Edit Profile</h3>
            </div>
        <div class="grid-x">
            <div class="cell small-1"></div>
            <div class="cell small-4 tempborder">
                <div class="grid-x">
                    <div class="cell cell-space"></div>
                </div>
                {{-- Current Profile Picture --}}
                    <img class="profileImage" src="{{asset('images/'.$user_detail->img_path)}}" alt="User Profile Image">
                {{-- /Current Profile Picture --}}
                {{-- Upload Profile Picture Button --}}
                    <div class="cell small-4">
                        <div class="input-group-button upload-btn">
                            <label for="fpropic" data-tooltip tabindex="2" title="Upload Profile Picture" class="custom-file-uploadpro top" id="lblproimg">
                                <i class="fas fa-file-upload"></i>
                            </label>
                            <input  id="fpropic" onchange="changeInputField('.custom-file-uploadpro')" class="button" type="file" name="fpropic">
                        </div>
                    </div>
                {{-- /Upload Profile Picture Button --}}
            </div>
            <div class="cell small-6 tempborder">
                <table class="hover tbldetails tbledituserdetails">
                    <tr>
                        <th>Last Name</th>
                        <td>
                            <input class="{{ $errors->has('txtlname') ? ' is-invalid-input' : '' }}" type="text" name="txtlname" id="txtlname" value="{{$user_detail->lastname}}">
                            @if($errors->has('txtlname'))
                                <span class="form-error is-visible">{{$errors->first('txtlname')}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td>
                            <input class="{{ $errors->has('txtfname') ? ' is-invalid-input' : '' }}" type="text" name="txtfname" id="txtfname" value="{{$user_detail->firstname}}">
                            @if($errors->has('txtfname'))
                                <span class="form-error is-visible">{{$errors->first('txtfname')}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Contact Number</th>
                        <td>
                            <input class="{{ $errors->has('txtcnum') ? ' is-invalid-input' : '' }}" type="text" name="txtcnum" id="txtcnum" value="{{$user_detail->contactnum}}">
                            @if($errors->has('txtcnum'))
                                <span class="form-error is-visible">{{$errors->first('txtcnum')}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>
                            <input class="{{ $errors->has('txtuname') ? ' is-invalid-input' : '' }}" type="text" name="txtuname" id="txtuname" value="{{$user_detail->username}}">
                            @if($errors->has('txtuname'))
                                <span class="form-error is-visible">{{$errors->first('txtuname')}}</span>
                            @endif  
                        </td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td>
                            <input class="{{ $errors->has('txtemail') ? ' is-invalid-input' : '' }}" type="email" name="txtemail" id="txtemail" value="{{$user_detail->email}}">
                            @if($errors->has('txtemail'))
                                <span class="form-error is-visible">{{$errors->first('txtemail')}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td class="link-top"><a data-open="changepassword" data-target="#changepassword">Change</a></td>  
                    </tr>
                </table>
            {{-- Submit Button --}}
                <input type="submit" id="btnsave-profile" name="btnsave-profile" class="button expanded userform_btn btnfocus" value="Save Changes" name="submit">
            {{-- /Submit Button --}}
            </div>
        </div>
    </form>

    {{--modal change password--}}
    <div class="reveal chngemod" id="changepassword" tabindex="-1"  role="dialog" data-reveal>
        <div class="changepasswrdmodal-header">
            <h4 class="modal-title chngepasstitle" >Change Password</h4>
        </div>
        
            <form action="{{route('users.passchg')}}" method="post"  class="form-body">
            {{-- {{method_field('patch')}} --}}
            {{csrf_field()}}
                <input type="hidden" name="changepassword" id="changepassword" value="">
                @include('users.changepasswordmod_found')   
                <button class="close-button" data-close aria-label="Close modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
          </form>
        </div>
    

        @if($errors->has('txtpassword') || $errors->has('txtOldpassword') || session('alert')=='errChngPass')
            <script>
                var popup = new Foundation.Reveal($('#changepassword'));
                popup.open();
            </script>
        @endif

        
    @if (session('alert')=='editUserSuccess')
    <?php        
        $title="User Details";
        $message="have been updated.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
    @endif
    @section('contentscript')
    {{-- script to change upload image button color --}}
        <script>
            function changeInputField(btn)
            {
                $(btn).css("background-color", "#6BA34D");
            }
        </script>
    {{-- /script to change upload image button color --}}
    {{-- Validation on Image Profile --}}
        @if($errors->has('fpropic'))
        <script>
            $.alert({
                title: 'Errors',
                icon: 'fas fa-exclamation',
                type: 'orange',
                boxWidth: '30%',
                useBootstrap: false,
                backgroundDismiss: true,
                content: '<b>{{$errors->first('fpropic')}}</b> Retry!' +
                '<hr>',
            });
        </script> 
        @endif
    {{-- /Validation on Image Profile --}}
    @endsection

@endsection