<!--  First name label and input -->
<div class="row {{ $errors->has('firstname') ? ' has-error' : '' }}">
  <div class="small-8 columns">
    <label for="firstname">First Name
      <input type="text" placeholder="First Name" name="firstname" id="firstname" value="{{ old('firstname') }}"/>
    </label>
  </div>
</div>
@if($errors->has('firstname'))
        <span class="form-error is-visible">{{$errors->first('firstname')}}</span>
        @endif
<!--  Last name label and input -->
<div class="row {{ $errors->has('lastname') ? ' has-error' : '' }}">
  <div class="large-12 columns">
    <label for="lastname">Last Name
      <input type="text" placeholder="Last Name" name="lastname" value="{{ old('lastname') }}" id="lastname" />
    </label>
  </div>
</div>
@if($errors->has('lastname'))
        <span class="form-error is-visible">{{$errors->first('lastname')}}</span>
        @endif

<!--  Email label and input -->
<div class="row {{ $errors->has('email') ? ' has-error' : '' }}">
  <div class="large-12 columns">
    <label for="email">Email
      <input type="text" placeholder="email@email.com"  name="email" value="{{ old('email') }}" id="email" />
    </label>
  </div>
</div>
@if($errors->has('email'))
        <span class="form-error is-visible">{{$errors->first('email')}}</span>
        @endif

<!--  contact Number label and input -->
<div class="row {{ $errors->has('contactnum') ? ' has-error' : '' }}">
  <div class="large-12 columns">
    <label for="contactnum">Contact Number
      <input placeholder="xxxx-xxxx" value="{{ old('contactnum') }}" id="contactnum" type="tel"  name="contactnum" maxlength="8" />
    </label>
  </div>
</div>
@if($errors->has('contactnum'))
<span class="form-error is-visible">{{$errors->first('contactnum')}}</span>
@endif
