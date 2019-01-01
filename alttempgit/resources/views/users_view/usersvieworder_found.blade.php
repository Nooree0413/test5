@extends("layouts.userfound")
    @section("contentcss")
        <link rel="icon" href="{{asset('images/food.png')}}" />
        {{-- Page Title --}}
            <title>View Order</title>
        {{-- /Page Title --}}
    @endsection
@section("content")
    <div class="gridContainerEventShow">
        <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-5">
                <a href="/users_view/userviewshow/{{$event_id}}" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i> Back</a>
            </div>
        </div>
        <div class="gridContainerEventShowMain">
            <div class="grid-x grid-padding-y">
                <div class="cell small-1"></div>
                <div class="cell small-5 lblgridtitle bar1">
                    <h3>Orders</h3>
                </div>
                @if(time() <= ((int)strtotime($deadline->deadline)+(24*60*60)))
                <div class="cell small-5 hollow lblgridtitle bar2 total spaceorderright">
                    <span class="total-price-span">Total Order Price: {{$getTotalPrice[0]->total_price}}</span>
                    <a href="/order/modify/{{$order_id}}"><span data-tooltip tabindex="1" class="has-tip bottom spaceordertop " title="Modify order"><i class=" fas fa-cart-plus iconsize"></i></span></a>
                </div> 
                @else
                <div class="cell small-5 hollow lblgridtitle bar2 total-only spaceorderright">
                        <span class="total-price-span">Total Order Price: {{$getTotalPrice[0]->total_price}}</span>
                    </div> 
                @endif   
            </div>
                <div class="grid-x">
                    <div class="cell small-1"></div>
                    <div class="cell small-10 ordwrapper">
                        <table id="tblshoworder" class="table unstriped tblord nowrap">
                            <thead>
                                <tr>
                                    <th>
                                        Item 
                                    </th>
                                    <th>
                                        Item Price
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>
                                        Total Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ordersdet as $orderdets)
                                <tr>
                                    <td>
                                        {{$orderdets->item_name}}
                                    </td>
                                    <td>
                                        {{$orderdets->item_price}}
                                    </td>
                                    <td>
                                        {{$orderdets->item_quantity}}
                                    </td>
                                    <td>
                                        <?php
                                            echo( $orderdets->item_quantity)*($orderdets->item_price)
                                        ?>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="cell small-1"></div>
                </div>
        </div>
    </div>        
@endsection