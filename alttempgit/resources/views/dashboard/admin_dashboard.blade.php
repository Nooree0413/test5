@extends('layouts.adminfound')

@section('contentcss')
    <!-- Additional Page CSS -->
        <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <!-- /Additional Page CSS -->

    {{-- Page Tab icon --}}
        <link rel="icon" href="{{asset('images/dashboard.png')}}" />
    {{-- /Page Tab icon --}}

    {{-- Page Title --}}
        <title>Dashboard</title>
    {{-- /Page Title --}}

@endsection

@section('content')
    <div class="container" style="padding:2%">
        <h1 align="center">Admin Dashboard</h1>
        @if(isset($LatestEvent))        
            <div class="row">
                <div class="columns">
                    <ul class="stats-list">
                        <li>
                            <span class='numscroller' data-min='1' data-max={{$users_count}} data-delay='5' data-increment='10'></span>
                            <span class="stats-list-label">Invited</span>
                        </li>
                        <li class="stats-list-positive">
                            <span class='numscroller' data-min='1' data-max={{$users_going}} data-delay='5' data-increment='100'></span>
                            <span class="stats-list-label">Coming</span>
                        </li>
                        <li class="stats-list-negative">                        
                            <span class='numscroller' data-min='1' data-max={{$users_NotGoing}} data-delay='5' data-increment='10'></span>
                            <span class="stats-list-label">Not coming</span>
                        </li>
                    </ul>
                </div>        
            </div>
            <div align="center">
                <a href="/eventfound/show/{{$LatestEvent->id}}"><h5> {{$LatestEvent->name}}</h5> </a>
            </div>        
        @endif
        <br>
        <div class="row">
            <div class="columns">
                <a class="dashboard-nav-card" href="/usersfound/view">
                    <i class="dashboard-nav-card-icon fa fa-users" aria-hidden="true">
                        <span class='numscroller' data-min='1' data-max={{$users_count}} data-delay='5' data-increment='5' style="color:White"></span>
                    </i>
                    <h4 class="dashboard-nav-card-title">Users</h4>
                </a>
            </div>
            <div class="columns">
                <a class="dashboard-nav-card" href="/eventfound/view">
                    <i class="dashboard-nav-card-icon fas fa-calendar-alt" aria-hidden="true">
                        <span class='numscroller' data-min='1' data-max={{$events}} data-delay='5' data-increment='10' style="color:White"></span>
                    </i>
                    <h4 class="dashboard-nav-card-title">Events</h4>
                </a>
            </div>
            @foreach($eventStatusCount as $evtStatus)
                <div class="columns">
                <a class="dashboard-nav-card" href="/eventfound/view?status={{$evtStatus->id}}">
                        <i class="dashboard-nav-card-icon fa fa-users" aria-hidden="true">
                            <span class='numscroller' data-min='1' data-max={{$evtStatus->total}} data-delay='5' data-increment='10' style="color:White"></span>
                        </i>
                        <h4 class="dashboard-nav-card-title">{{$evtStatus->status}}</h4>
                    </a>
                </div>
            @endforeach            
        </div>
        <br>
        <div class="row">
            <div class="columns">
                <div class="dashboard-number-card positive">
                    <h5 class="dashboard-number-value">
                        <span class='numscroller' data-min='1' data-max='15000' data-delay='5' data-increment='100'></span>
                    </h5>
                    <div>
                        <p class="dashboard-number-area">Category</p>
                        <p class="dashboard-number-delta">
                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                            $3000(10%)
                        </p>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="dashboard-number-card warning">
                    <h5 class="dashboard-number-value">
                        <span class='numscroller' data-min='1' data-max='20000' data-delay='5' data-increment='100'></span>
                    </h5>
                    <div>
                        <p class="dashboard-number-area">Category</p>
                        <p class="dashboard-number-delta">
                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                            $3000(10%)
                        </p>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="dashboard-number-card negative">
                    <h5 class="dashboard-number-value">
                        <span class='numscroller' data-min='1' data-max='10000' data-delay='50' data-increment='100'></span>
                    </h5>
                    <div>
                        <p class="dashboard-number-area">Category</p>
                        <p class="dashboard-number-delta">
                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                            $3000(10%)
                        </p>
                    </div>
                </div>
            </div>        
        </div>
        <br>
        <div class="row">
            <div class="columns">
                <ul class="bar-graph">
                    {{-- <li class="bar-graph-axis">
                        <div class="bar-graph-label">100%</div>
                        <div class="bar-graph-label">80%</div>
                        <div class="bar-graph-label">60%</div>
                        <div class="bar-graph-label">40%</div>
                        <div class="bar-graph-label">20%</div>
                        <div class="bar-graph-label">0%</div>
                    </li> --}}                    
                    <li class="bar primary" style="height: 0%;" data-percentage="95" title="95">
                        <div class="percent">95<span>%</span></div>
                        <div class="description">Yetis</div>
                    </li>
                    <li class="bar secondary" style="height: 0%;" data-percentage="90" title="90">
                        <div class="percent">90<span>%</span></div>
                        <div class="description">ZURBians</div>
                    </li>
                    <li class="bar success" style="height: 0%;" data-percentage="80" title="80">
                        <div class="percent">80<span>%</span></div>
                        <div class="description">Cows</div>
                    </li>
                    <li class="bar warning" style="height: 0%;" data-percentage="75" title="75">
                        <div class="percent">75<span>%</span></div>
                        <div class="description">Cows that think they're Yetis</div>
                    </li>
                    <li class="bar alert" style="height: 0%;" data-percentage="40" title="40">
                        <div class="percent">40<span>%</span></div>
                        <div class="description">Who knows</div>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="columns">
                <div class="circle-graph" data-circle-graph data-percent="10">
                    <div class="circle-graph-progress">
                        <div class="circle-graph-progress-fill"></div>
                    </div>
                    <div class="circle-graph-percents">
                        <div class="circle-graph-percents-wrapper">
                        <span class="circle-graph-percents-number">
                            <span class='numscroller' data-min='1' data-max=10 data-delay='1' data-increment='1'></span>%
                        </span>
                        <span class="circle-graph-percents-units">of 100</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="circle-graph" data-circle-graph data-percent="30">
                    <div class="circle-graph-progress">
                        <div class="circle-graph-progress-fill"></div>
                    </div>
                    <div class="circle-graph-percents">
                        <div class="circle-graph-percents-wrapper">
                        <span class="circle-graph-percents-number">
                            <span class='numscroller' data-min='1' data-max=30 data-delay='3' data-increment='3'></span>%
                        </span>
                        <span class="circle-graph-percents-units">of 100</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="circle-graph" data-circle-graph data-percent="50">
                    <div class="circle-graph-progress">
                        <div class="circle-graph-progress-fill"></div>
                    </div>
                    <div class="circle-graph-percents">
                        <div class="circle-graph-percents-wrapper">
                        <span class="circle-graph-percents-number">
                            <span class='numscroller' data-min='1' data-max=50 data-delay='5' data-increment='5'></span>%
                        </span>
                        <span class="circle-graph-percents-units">of 100</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="circle-graph" data-circle-graph data-percent="80">
                    <div class="circle-graph-progress">
                        <div class="circle-graph-progress-fill"></div>
                    </div>
                    <div class="circle-graph-percents">
                        <div class="circle-graph-percents-wrapper">
                        <span class="circle-graph-percents-number">
                            <span class='numscroller' data-min='1' data-max=80 data-delay='5' data-increment='5'></span>%
                        </span>
                        <span class="circle-graph-percents-units">of 100</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="circle-graph" data-circle-graph data-percent="99">
                    <div class="circle-graph-progress">
                        <div class="circle-graph-progress-fill"></div>
                    </div>
                    <div class="circle-graph-percents">
                        <div class="circle-graph-percents-wrapper">
                        <span class="circle-graph-percents-number">
                            <span class='numscroller' data-min='1' data-max=99 data-delay='5' data-increment='5'></span>%
                        </span>
                        <span class="circle-graph-percents-units">of 100</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {           
            $(".bar-graph .bar").each( function( key, bar ) {
                
                var percentage = $(this).data('percentage');
                //alert(percentage);
                $(this).animate({
                'height' : percentage + '%'
                }, 2500);
            });
        });
       
        $("[data-circle-graph]").each(function() {
            var $graph = $(this),
                percent = parseInt($graph.data('percent'), 10),
                deg = 360*percent/100;
            
            $graph.find('.circle-graph-progress-fill').rotate({
                animateTo:deg,
                duration:6000,
            });
            if(percent > 50) {
                $graph.addClass('gt-50');
            }
        });
    </script>
@endsection
