@extends('layouts.adminfound')

@section('contentcss')
    <!-- Additional Page CSS -->
        <link rel="stylesheet" href="{{asset('css/editUser.css')}}">
        <link rel="stylesheet" href="{{asset('css/show_found.css')}}">
        <link rel="stylesheet" href="{{asset('css/found.css')}}">
        <link rel="stylesheet" href="{{asset('css/responsive-tables.css')}}">
    <!-- /Additional Page CSS -->

    {{-- Page Tab icon --}}
        <link rel="icon" href="{{asset('images/users.png')}}" />
    {{-- /Page Tab icon --}}

    {{-- Page Title --}}
        <title>View Users</title>
    {{-- /Page Title --}}

@endsection

@section('content')
{{-- View User Datatable --}}
<div class="grid-x padding_cell">
        <div class="cell small-1"></div>
        <div class="cell small-1 ">
            <a class="back-btn hvr-icon-pulse" href="/admin/dashboard"><i class="fa fa-home hvr-icon"></i> Home</a>
        </div>
    </div>

     
       <div class="grid-x">
            <div class="cell small-1"></div>
            <div class="cell small-10">
        <div class="table-container">
            <h4 class="datatableTitleUsers">Users</h4>
            <table id="tbluser" class=" table table-striped nowrap">
                <thead>
                    <tr>
                        <th>
                            Full Name
                        </th> 
                        <th>
                            Email-Address
                        </th> 
                        <th>
                            Contact Number
                        </th> 
                        <th>
                            {{-- Actions --}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr >
                        <td>    
                            {{$user->firstname}} {{$user->lastname}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            {{$user->contactnum}}
                        </td>
                        <td>
                            {{-- Show Event Button --}}
                                <a href="/usersfound/show/{{$user->id}}">
                                    <span data-tooltip tabindex="1" style="border-bottom:none" title="show">
                                        <i class="far fa-eye font-color"></i>
                                    </span>
                                </a> 
                            {{-- /Show Button --}}
                            &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                            {{-- Edit User Button --}}
                                <a class="editbtn" data-open="editusermod" data-mycontactnum="{{$user->contactnum}}" data-myfirstname="{{$user->firstname}}" data-mylastname="{{$user->lastname}}" data-myemail="{{$user->email}}" data-userid="{{$user->id}}" data-target="#editusermod">
                                    <span style="border-bottom:none" data-tooltip tabindex="1" title="Edit">
                                        <i class="fas fa-pencil-alt font-color"></i> 
                                    </span>
                                </a>
                            {{-- /Edit User Button --}}
                            &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            {{-- Delete User Button --}}
                                @if ($user->id== Auth::id()) 
                                    <a class="btndelevent not-active-link disabled" href="/usersfound/delete/{{$user->id}}">
                                        <span style="border-bottom:none" data-tooltip tabindex="1" title="Delete">
                                            <i class="fas fa-trash-alt font-color"></i>
                                        </span>
                                    </a>
                                @else
                                    <a class="btndelevent" href="/usersfound/delete/{{$user->id}}">
                                        <span style="border-bottom:none" data-tooltip tabindex="1" title="Delete">
                                            <i class="fas fa-trash-alt font-color"></i>
                                        </span>
                                    </a>
                                @endif
                            {{-- /Delete User Button --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="cell small-1"></div>
    </div>
    {{-- /View User Datatable --}}

<!-- modal for edit user -->
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
    <!-- /modal-head  -->
    <!-- modal-content  -->
        <form action="{{route('users.update', 'home')}}" method="post">
            {{method_field('patch')}}
            {{csrf_field()}}
            <div class="modal-body">
            <input type="hidden" name="userid" id="userid" value="">
                @include('users.editform_found')
                <button type="submit" class="button expanded savechangebtn">Save</button>
            </div>        
        </form>
           
    <!-- modal-content  -->
    </div>
<!-- /modal for edit user -->

@section('contentscript')
    <script>
        $(".btndelevent").on("click", {msg:'Do you want to delete this User?', title:'Warning'}, confirmMsg);
    </script>

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
@if (session('alert')=='addUserSuccess')
    <?php
        $title=session('UserName');
        $message="has been added.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
@elseif (session('alert')=='deleteUserSuccess')
    <?php
        $title=session('UserName');
        $message="has been deleted.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
@elseif (session('alert')=='editUserSuccess')
    <?php        
        $title=session('UserName');
        $message="has been updated.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
@endif
@endsection
@endsection