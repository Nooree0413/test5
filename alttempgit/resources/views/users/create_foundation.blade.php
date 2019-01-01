@extends('layouts.adminfound')
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-icons.css')}}">
    <link rel="icon" href="{{asset('images/addUser.png')}}" />
    <title>Add User</title>
@section('content')
{{-- <a href="/eventfound/view" class="hollow button success btnBackHover">Back</a> --}}

  <div class="grid-x padding_cell">
      <div class="cell small-1"></div> 
      <div class="cell small-1 ">  
      <a href="/eventfound/view" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i> Back</a> 
    </div>
  </div>
  <div class="grid-x">
      <div class="cell small-1"></div> 
      <div class="cell small-10">
    <fieldset class="addUserFieldset">
        <legend class="addUserLegend">Add User</legend>
    <div class="cell small-11">
        <div class="loader2"></div>
    <form id="frmAddUser" method="POST" action="{{route('user.add')}}" class="cssAddUser" data-abide> 
      @csrf
      <div class="grid-x grid-margin-x">
        <div class="cell small-6">
  {{-- Last Name Field --}}
        <div class="input-group  ">
          <span class="input-group-label">
            <i class="fa fa-user"></i>
          </span>
          <input class="input-group-field {{ $errors->has('txtlname') ? ' is-invalid-input' : '' }}" name="txtlname" value="{{ old('txtlname') }}" type="text" placeholder="Last name">
        </div>
        @if($errors->has('txtlname'))
          <span class="form-error is-visible">{{$errors->first('txtlname')}}</span>
        @endif
  {{-- /Last Name Field --}}
        </div>
      
        <div class="cell small-6">
  {{-- First Name Field --}}
        <div class="input-group ">
          <span class="input-group-label">
            <i class="fa fa-user"></i>
          </span>
          <input class="input-group-field {{ $errors->has('txtfname') ? ' is-invalid-input' : '' }}" name="txtfname" value="{{ old('txtfname') }}" type="text" placeholder="First name">
        </div>
        @if($errors->has('txtfname'))
          <span class="form-error is-visible">{{$errors->first('txtfname')}}</span>
        @endif
  {{-- /First Name Field --}}
        </div>
      </div>
      
      <div class="grid-x grid-margin-x">
        <div class="cell small-6">
  {{-- Username Field --}}
      <div class="input-group ">
        <span class="input-group-label">
          <i class="fa fa-user"></i>
        </span>
        <input class="input-group-field {{ $errors->has('txtuname') ? ' is-invalid-input' : '' }}" name="txtuname" value="{{ old('txtuname') }}" type="text" placeholder="Username">
      </div>
      @if($errors->has('txtuname'))
        <span class="form-error is-visible">{{$errors->first('txtuname')}}</span>
      @endif
  {{-- /Username Field --}}
        </div>

        <div class="cell small-6">
  {{-- Email Field --}}
      <div class="input-group">
        <span class="input-group-label">
          <i class="fa fa-envelope"></i>
        </span>
        <input class="input-group-field {{ $errors->has('txtemail') ? ' is-invalid-input' : '' }}" name="txtemail" value="{{ old('txtemail') }}" type="text" placeholder="Email">
      </div>
      @if($errors->has('txtemail'))
        <span class="form-error is-visible">{{$errors->first('txtemail')}}</span>
      @endif
  {{-- /Email Field --}}
        </div>
      </div> 

      <div class="grid-x grid-margin-x">
        <div class="cell small-6">
  {{-- Contact Number Field --}}
        <div class="input-group">
            <span class="input-group-label">
              <i class="fa fa-phone"></i>
            </span>
            <input class="input-group-field {{ $errors->has('txtcnum') ? ' is-invalid-input' : '' }}" name="txtcnum" value="{{ old('txtcnum') }}" type="tel" placeholder="Contact number" min="8" maxlength="8"  title="8 digits code only and starting with number '5'.">
        </div>
        @if($errors->has('txtcnum'))
          <span class="form-error is-visible">{{$errors->first('txtcnum')}}</span>
        @endif
  {{-- /Contact Number Field --}}
        </div>

        <div class="cell small-6">
  {{--Radio Button for User Type--}}
      <div class="input-group radioBtn" >
        <input type="radio" name="usertype" value="0" checked="checked" id="user" style="width: 3%;height: 2%;"><label for="user">User</label>
        <input type="radio" name="usertype" value="1" id="admin" style="width: 3%;height: 2%;"><label for="admin" >Admin</label>
      </div>
  {{--/Radio Button for User Type--}}
        </div>
      </div>
      <button class="button round expanded btnAdd btnAddUserAlert userform_btn">Add User</button>      
    </form>
  </div>

</fieldset>
</div>
<div class="cell small-1"></div>
</div>
      @section('contentscript')
        @if(session('alert'))
        <script>
       $.alert({
              boxWidth: '30%',
              useBootstrap: false,
              backgroundDismiss: true,
              type: 'green',
              typeAnimated: true,
              title: 'Add User!',
              content: 'User was successfully added!',
              });
        </script>
      @endif
      @endsection
      
@endsection
