{{-- Old Password Field --}}

  <div class="input-group spaceInBetween">
    <span class="input-group-label oldpass">
      <i class="fa fa-key"></i>
    </span>
    <input class="input-group-field {{ $errors->has('txtOldpassword') ? ' is-invalid-input' : '' }}" type="password" placeholder="Old Password" id="txtOldpassword" name="txtOldpassword">
  </div>
 
  @if($errors->has('txtOldpassword'))
    <span class="form-error is-visible spaceInBetween2">{{$errors->first('txtOldpassword')}}</span>
  @endif

{{-- /Old Password Field --}}
                  
  <div class="input-group spaceInBetween ">
    <span class="input-group-label">
      <i class="fa fa-key"></i>
    </span>
    <input class="input-group-field {{ $errors->has('txtpassword') ? ' is-invalid-input' : '' }}" type="password" placeholder="New Password" id="txtpassword" name="txtpassword">
  </div>
  
  @if($errors->has('txtpassword'))
  <span class="form-error is-visible spaceInBetween2">{{$errors->first('txtpassword')}}</span>
  @endif
  @if(session('alert')=='errChngPass')
    <span class="form-error is-visible spaceInBetween2">Please use a new password</span>
  @endif


  
  <div class="input-group spaceInBetween" >
      <span class="input-group-label">
        <i class=" fa fa-key"></i>
      </span>
    
      <input class="input-group-field" {{ $errors->has('txtpassword-confirm') ? ' is-invalid-input' : '' }} type="password" placeholder="Confirm Password" id="txtpassword_confirmation"  name="txtpassword_confirmation">
  </div>


  <div class="modbtncontainer spaceInBetween spacecontainer">
    <button class="button expanded modbtn" type="submit">Change Password</button>
    <a href="#" data-close class="button expanded modbtn"><span> Back</span></a>
  </div>



  
