@include('layouts.automatedEventStatus')  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/foundation.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.foundation.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/responsive.foundation.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-confirm.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/footercss.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsivetablecss.css')}}">
    <link rel="stylesheet" href="{{asset('css/hover.css')}}"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/iziToast.min.css')}}"> 
  
    @yield('contentcss')
    
    
    <script  src="{{asset('js/jquery-3.3.1.js')}}"></script>
	<script  src="{{asset('js/jquery.dataTables.min.js')}}"></script>
	<script  src="{{asset('js/dataTables.foundation.min.js')}}"></script>
	<script  src="{{asset('js/dataTables.responsive.min.js')}}"></script>
    <script  src="{{asset('js/responsive.foundation.min.js')}}"></script>
    <script  src="{{asset('js/jquery-confirm.min.js')}}"></script>
    <script  src="{{asset('js/foundation.js')}}"></script>
    <script  src="{{asset('js/iziToast.min.js')}}"></script>
    <script>
    $(document).ready(function() {
        $(document).foundation();
        $('#tlbuser, #tblevent').DataTable(
            {'responsive':'true'}
        );
    });
</script>
</head>
<body>
        <div class="top-bar borderdown">
                <div class="top-bar-left">
                  <ul class="dropdown menu" data-dropdown-menu>
                    <li class="menu-text skills">ALT</li>
                  </ul>
                </div>
                
                <div class="top-bar-right">
                    <a  class="usernameNavBar" href="#"><b>Welcome, {{ ucfirst(strtolower(Auth::user()->firstname)) }}</b></a> 
                </div>
        </div>
               
    <div class="grid-x">
            <div class="small-2 cell sidebar-height">
                <ul class="vertical menu accordion-menu" data-accordion-menu data-multi-open="false">
                        <li>
                            <a href="/user/profile/view"><i class="fas fa-user-edit"></i> My Profile</a>
                            {{-- <ul class="menu vertical nested">
                                <li><a href="/user/profile/view"><i class="fas fa-user-edit"></i> My Profile</a></li>
                            </ul> --}}
                        </li>
                    <li>
                        <a href="/eventfound/view"><i class="fas fa-calendar-alt"></i> Events</a>
                        {{-- <ul class="menu vertical nested">
                            <li><a href="/eventfound/view/upcoming"><i class="far fa-calendar-plus"></i> Upcoming Events</a></li>                                                 
                        </ul> --}}
                    </li>
                    <li>
                        <a href="/logout"><i class="fa fa-power-off" aria-hidden="true"></i> Log Out</a>
                    </li>
                </ul>
            </div>
                <div class="small-10 cell">
                    @yield('content')
                </div>
            </div>

            {{--footer--}}
            <footer>
               <img src="{{ asset('images/1694498923.png') }}" height="1.5%" width="1.5%" alt="logo astek">  Copyright &copy; 2018 Astek Mauritius.
            </footer>
           {{--modal change password--}}
            <div class="reveal chngemod" id="changepassword" tabindex="-1" role="dialog" data-reveal>
                <div class="changepasswrdmodal-header">
                    <h4 class="modal-title chngepasstitle" >Change Password</h4>
                </div>
                <form action="{{route('users.passchg')}}" method="post"  class="form-body">
                    {{csrf_field()}}
                    <input type="hidden" name="changepassword" id="changepassword" value="">
                    @include('users.changepasswordmod_found')   
                    <button class="close-button" data-close aria-label="Close modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </form>
            </div>
        

            {{-- @if($errors->has('txtpassword'))
                <script>
                    var popup = new Foundation.Reveal($('#changepassword'));
                    popup.open();
                </script>
            @endif --}}

            
            <script type="text/javascript">
                $('.btndelevent').on('click', function (e) { 
                    e.preventDefault();
                    var ref = $(this).attr('href');
                    $.confirm({
                    boxWidth: '30%',
                    useBootstrap: false,
                    title: 'Warning',
                    content: 'Are you sure?',
                    type: 'blue',
                    typeAnimated: true,
                    buttons: 
                    {
                        Yes: {
                            text: 'Yes',
                            action: function()
                            {
                                window.location = ref;
                            }
                        },
                        No: 
                        {
                            text:'No',
                            backgroundDismiss: true,
                        },
                    }
                    });
                });
            </script>
            @yield('contentscript')
</body>
</html>