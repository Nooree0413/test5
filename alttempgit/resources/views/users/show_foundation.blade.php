@extends('layouts.adminfound')
@section('contentcss')
    <!-- Additional Page CSS -->
        <link rel="stylesheet" href="{{asset('css/editUser.css')}}">
        <link rel="stylesheet" href="{{asset('css/show_found.css')}}">
        <link rel="stylesheet" href="{{asset('css/found.css')}}">
        <link rel="stylesheet" href="{{asset('css/responsive-tables.css')}}">
    <!-- /Additional Page CSS -->
  <link rel="icon" href="{{asset('images/userDetails.png')}}" />
  <title>User Details</title>
@section('content')
    <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-5"><a href="/usersfound/view" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i>Back</a></div>
            <div class="cell small-5 hollow"><a  class="back-btn editbtn hvr-icon-buzz-out" data-open="editusermod"  data-mycontactnum="{{$users->contactnum}}" data-myfirstname="{{$users->firstname}}" data-mylastname="{{$users->lastname}}" data-myemail="{{$users->email}}" data-userid="{{$users->id}}" data-target="#editusermod"><i class="fas fa-marker icon-edit hvr-icon"></i>Edit</a></div>
        </div>

    <div class="wrapperProfile">
    <div class="grid-x "style="padding: 4% 0% 0% 0%;">
            
            <div class="cell small-1 "></div>
            <div class="cell small-10 username lblusergridtitle"><h3><b>{{$users->lastname}}&nbsp;{{$users->firstname}}</b></h3></div>
            <div class="cell small-1 "></div>
        </div>
    <div class="grid-x">
        <div class="cell small-1 "></div>
            <div class="cell small-4 lblusercell4 ">                
                <img class="profilePic" src="{{asset('images/'.$users->img_path)}}"  alt="Avatar" >                         
            </div>
            <div class="cell small-3  alignment lblusercell3_detail1">                   
                <div >
                        <div>
                           Username:<br>
                           First Name:<br>
                           Last Name:<br>
                           Role:</br>
                           Email:</br> 
                           Contact Number:<br>
                        </div> 
                  </div>
            </div>
            <div class="cell small-3 lblusercell_detail2 ">
                <div class="thirdshowdiv">
                        <div class="datafield">
                        
                            &nbsp;{{$users->username}}<br>
                            &nbsp;{{$users->firstname}}<br>
                            &nbsp;{{$users->lastname}}<br>
                            @if($users->admin==1)
                            &nbsp;Administrator<br>
                                @else
                                &nbsp;User<br>
                                @endif
                                &nbsp;{{$users->email}}<br>
                                &nbsp;{{$users->contactnum}}<br>
                        </div>
                    </div>
            </div>
        <div class="cell small-1 "></div>
        <!-- modal edit -->
<div class="reveal" id="editusermod" data-reveal>
        <!-- modal-head  -->
                <div class="modalheader">
                    <div class="group-title">
                        <h4 class="subheader">User Edit</h4>
                    </div>
                        <button class="close-button" data-close aria-label="Close modal" type="button">
                                <span aria-hidden="true">&times;</span>
                        </button>
                </div >
                    <form action="{{route('users.update', 'home')}}" method="post">
                                {{method_field('patch')}}
                                {{csrf_field()}}
                            <div class="modal-body">
                            <input type="hidden" name="userid" id="userid" value="">
                                @include('users.editform_found')
                                    <button type="submit" class="button expanded savechangebtn">Save</button>
                            </div>        
                    </form>
        </div>
    </div>
</div>
@section('contentscript')
<script>
        $('.editbtn').on('click', function (event) {
            var fname = $(this).attr("data-myfirstname");
            var lname = $(this).attr("data-mylastname");
            var email = $(this).attr("data-myemail");
            var cnum = $(this).attr("data-mycontactnum");
            var userid = $(this).attr("data-userid");
        
            $('#firstname').val(fname);
            $('#email').val(email);
            $('#lastname').val(lname);
            $('#contactnum').val(cnum);
            $('#userid').val(userid);
        });
        </script>
        
        @if($errors->has('firstname') || $errors->has('email') || $errors->has('lastname') || $errors->has('contactnum'))
        <script>
             var popup = new Foundation.Reveal($('#editusermod'));
            popup.open();
        </script>
        @endif

        @include('layouts.global')
            @if (session('alert')=='editUserSuccess')
                <?php        
                    $title=session('UserName');
                    $message="has been updated.";
                    $type='success';
                    alertSuccess($title, $message, $type);
                ?>
            @endif
@endsection
@endsection