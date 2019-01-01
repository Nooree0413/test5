@extends('layouts.adminfound')
@section('content')
    @section("contentcss")
        <link rel="stylesheet" href="{{asset('css/show_found.css')}}">
        <link rel="icon" href="{{asset('images/foodmenu.png')}}" />
        {{-- Page Title --}}
        <title>Order List</title>
        {{-- /Page Title --}}
    @endsection
    <div class="grid-x padding_cell">
        <div class="cell small-1"></div>
        <div class="cell small-1 ">
            <a class="back-btn hvr-icon-pulse" href="/admin/dashboard"><i class="fa fa-home hvr-icon"></i> Home</a>
        </div>
    </div>
    <div class="grid-x">
        <div class="cell small-1"></div>
        <div class="cell small-10 adjpad">
            <div class="table-container">
                <h4 class="datatableTitleEvents">Order List</h4>
                <table id="tblevent" class="table table-striped nowrap">
                    <thead>
                        <tr>
                            <th>
                                Event Name
                            </th> 
                            <th>
                                Status
                            </th>
                            <th>
                                Start Date
                            </th>                            
                            <th>
                               Order Details
                            </th>
                        </tr>
                    </thead>                    
                    <tbody>
                        @foreach($Event_orders as $Event_order)
                        <tr>
                            <td>
                                {{$Event_order->name}}
                            </td>
                            <td>
                                {{$Event_order->status}}
                            </td>
                            <td>
                                {{$Event_order->date_start}}
                            </td>
                            <td>
                                <a href="/view/order/{{$Event_order->id}}"><span data-tooltip tabindex="1" title="show"><i class="far fa-eye"></i></span> &nbsp; 
                            </td>                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="cell small-1"></div>
    </div>
@endsection