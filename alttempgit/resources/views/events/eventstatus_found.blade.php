@extends('layouts.adminfound')

@section('contentcss')
    <!-- Additional Page CSS -->
        <link rel="stylesheet" href="{{asset('css/editUser.css')}}">
        <link rel="stylesheet" href="{{asset('css/show_found.css')}}">
        <link rel="stylesheet" href="{{asset('css/found.css')}}">
        <link rel="stylesheet" href="{{asset('css/responsive-tables.css')}}">
    <!-- /Additional Page CSS -->

    {{-- Page Tab icon --}}
        <link rel="icon" href="{{asset('images/eventStatus.png')}}" />
    {{-- /Page Tab icon --}}

    {{-- Page Title --}}
        <title>View Event Status</title>
    {{-- /Page Title --}}

@endsection

@section('content')
    {{-- View User Datatable --}}

        <div class=" grid-x padding_cell">
            <div class="cell small-1"></div>
            <div class="cell small-1">
                <a href="/eventfound/show/{{$event_id}}/" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i>Back</a>
            </div>
        </div>

        <div class="grid-x">
            <div class="cell small-1"></div>
            <div class="cell small-10">
            
                <div class="table-container">
                    <h4 class="datatableTitleUsers">Event Status</h4>
                    <table id="tbluser" class="table table-striped nowrap">
                        <thead>
                            <tr>
                                <th>
                                    First Name
                                </th>
                                <th>
                                    Last Name
                                </th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_event as $user_events)
                                <tr>
                                    <td>
                                        {{$user_events->firstname}} 
                                    </td>
                                    <td>
                                        {{$user_events->lastname}}
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
@endsection


    