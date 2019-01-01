@extends('layouts.adminfound')
@section('content')
    @section("contentcss")
        <link rel="stylesheet" href="{{asset('css/show_found.css')}}">
        <link rel="icon" href="{{asset('images/foodmenu.png')}}" />
        {{-- Page Title --}}
        <title>Orders</title>
        {{-- /Page Title --}}
    @endsection
    <div class="grid-x padding_cell">
        <div class="cell small-1"></div>
        <div class="cell small-1 ">
            <a class="back-btn hvr-icon-back" href="/eventfound/show/{{$event_id}}"><i class="fa fa-chevron-circle-left hvr-icon"></i> Back</a>
        </div>
    </div>
    <div class="grid-x">
        <div class="cell small-1"></div>
        <div class="cell small-10 adjpad">
            <div class="table-container">
                <h4 class="datatableTitleEventsOrders" align="center">Orders</h4>
                <table id="tblEventsOrders" class="table table-striped nowrap">
                    <thead>
                        <tr>
                             <th hidden>
                                Order ID
                            </th> 
                            <th hidden>
                                Name
                            </th> 
                            <th>
                                Item
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Total
                            </th>
                            <th hidden>
                                Grand Total
                            </th>
                            <th hidden>
                                Paid
                            </th>
                        </tr>
                    </thead>                    
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td hidden>
                                {{$order->id}}
                            </td>
                            <td hidden>
                                {{$order->firstname}} {{$order->lastname}}
                            </td>
                            <td>
                                {{$order->item_name}}
                            </td>
                            <td>
                                {{$order->item_description}}
                            </td>
                            <td>
                                {{$order->item_price}}
                            </td>
                            <td>
                                {{$order->item_quantity}}
                            </td>
                            <td>
                                {{$order->item_price * $order->item_quantity}}
                            </td>
                            <td hidden>
                                {{$order->total_price}}
                            </td>
                            <td hidden>
                                {{$order->paid_status}}
                                {{-- <div class="switch small">
                                @if($order->paid_status == 0)
                                    <input class="switch-input" id="OrderStatus{{$order->id}}" type="checkbox" name="OrderStatus{{$order->id}}">  
                                @else
                                    <input class="switch-input" id="OrderStatus{{$order->id}}" type="checkbox" name="OrderStatus{{$order->id}}" checked>
                                @endif
                                    <label class="switch-paddle" for="OrderStatus{{$order->id}}">
                                        <span class="switch-active" aria-hidden="true">Yes</span>
                                        <span class="switch-inactive" aria-hidden="true">No</span>
                                    </label>
                                </div> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="cell small-1"></div>
    </div>
    @section("contentscript")
        <script>
            function paid_order(orderId)
                {
                    var paid_status;
                    var check = document.getElementById("OrderStatus"+orderId).checked;
                    var type;
                    if(check)
                    {
                        paid_status = 1;
                        type="green";
                    }
                    else
                    {
                        paid_status = 0;
                        type="yellow";
                    }

                    $.get('/update-payment/'+ orderId + '/' + paid_status, function(data)
                    {
                    //success data
                    if(data == "success")
                    {
                        iziToast.show({
                            title: 'Success',
                            message: 'Payment Status has been updated',
                            color:type,
                            position: 'bottomRight',
                            transitionIn:'fadeInUp'
                        });
                    }
                    });
                }
        </script>
    @endsection
@endsection