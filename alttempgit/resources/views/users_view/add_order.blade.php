@extends("layouts.userfound")
@section("content")
    @section("contentcss")
        <link rel="stylesheet" href="{{asset('css/multi-select.css')}}">
        <link rel="icon" href="{{asset('images/food.png')}}" />
        {{-- Page Title --}}
            <title>Order Food</title>
        {{-- /Page Title --}}
    @endsection
    <div class="gridContainerEventShow" style="padding: 0% 0% 2% 0%;">
        <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-5">
                    <a href="/eventfound/user/view" class="back-btn hvr-icon-back">
                        <i class="fa fa-chevron-circle-left hvr-icon icon-back"></i>
                         Back
                    </a>
            </div>
        </div>
        <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-4 lblgridtitle bar1">
                <h3> Place Order</h3>
            </div>
            <div class="cell small-5 testorderplace">
                <h5> Total Price</h5>
            </div>
            <div class="cell small-1 hollow lblgridtitle bar2 spaceorderright">
                <a href="#">                        
                    <div id="resPrice" class="cell small-2 tempborder">0.00</div>
                </a>
            </div>    
        </div>
        <div class="grid-x">
            <div class="cell small-1"></div>
            <div class="cell small-5 tempborder tbluser_viewordercell1">
                <select id='callbacks' size="4">
                    @foreach($foodDetails as $foodDetail)
                        <option data-price='{{$foodDetail->item_price}}' value='{{$foodDetail->id}}'>{{$foodDetail->item_name}}</option>
                    @endforeach
                </select>
                <button id="btnaddorder" type="button" class="button place-orderbtnadd userform_btn">Add Order</button>
            </div>
            <div class="cell small-5 tempborder tbluser_viewordercell2">
                <div class="info-container transition-place_order">
                    <img class="pre-menu-img" src="{{asset('images/sample-food.gif')}}" alt="Food Menu Details">
                </div>
            </div>
            <div class="cell small-1"></div>
        </div>
        <div class="grid-x transition-place_order placeordermargintop">
            <div class="cell small-1"></div>
            <div class="cell small-10">
                <fieldset class="placeorderfieldset">
                    <legend class="myorderLegend">My Order</legend>
                    <form id="frmorder" class="frmorderspacing" action="" method="POST">
                        @csrf
                        <input type="hidden" value="{{$get_event[0]}}" name="hfedeadline" id="hfedeadline">
                        <input type="hidden" name="hftprice" id="hftprice">
                        <table id="tblorder" class="tblplaceorderfrm">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th colspan="2">Quantity</th>
                                </tr>
                                <tbody id="tblorder-body"></tbody>
                            </thead>
                        </table>
                        <div class="grid-x">
                            <div class="cell small-9 btncontainerplace_order"><input type="button" class="button expanded userform_btn btnfocus" name="btnsub" id="btnsub" value="Save order"></div>
                            <div class="cell small-3 btncontainerplace_order"><button id="btngetprice" type="button" class="button userform_btn btnfocus" onclick="viewPrice()">Calculate Price</button></div>
                        </div>
                        <input type="hidden" name="hfarritem" id="hfarritem">
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
            
    <script>
        var total_price = 0;
        $(document).ready(function(){
            $("#btnaddorder").attr('disabled','disabled');
            $("#frmorder").hide();
                                    
            $("#callbacks").on("change", function(e)
                {
                 $("#btnaddorder").removeAttr('disabled');
                 var item_id = e.target.value;
                 $.get('/search-item/'+item_id, function(data)
                 {
                 //success data
                     data.forEach(function (d) 
                     {
                         $('.info-container').html("<p><strong>Price (MUR):</strong> "+d.item_price+"</p><p><strong>Item Description:</strong> "+d.item_description+"</p>");
                     });                        
                 })
            });
            $("#btnaddorder").on("click", function(e)
            {             
                    $("#btnsub").removeAttr('disabled');
                    var val = $("#callbacks option:selected").val();
                    var valTxt = $("#callbacks option:selected").text();
                    var price = $("#callbacks option:selected").attr('data-price');
                    $("#frmorder").show();
                    $("#tblorder tbody").append(
                    "<tr id=\'"+val+"\'>"+
                    "<td >"+valTxt+"</td>"+
                    "<td><input type=\'number\' class=\'qty-input\' value='1' placeholder=\'Qty\' id=\'order"+val+"\'><input type=\'hidden\' name=\'hfprice"+val+"\' id=\'hfprice"+val+"\' value=\'"+price+"\'></td>"+
                    "<td hidden>order"+val+"</td>"+
                    "<td><button onclick=\"del("+val+");\" class=\'btndelitm\' title=\'Remove item\' type=\'button\'><i class=\'fas fa-minus-square\'></i> </button></td></tr>");
                    $("#callbacks option:selected").hide();
                    $("#btnaddorder").attr('disabled','disabled');
                });
            });
        
        function del(r)
        {
            $("#callbacks").children("option[value=" + r + "]").show(); 
            $(String("#"+r)).remove();
            $("#callbacks option:selected").prop("selected", false);

            var numOfVisibleRows = $('tbody tr:visible').length;
            if(numOfVisibleRows==0)
            {
                $("#frmorder").hide();
            }
            else
            {
                $("#frmorder").show();
            }
        }

        $("#btnsub").on("click", function(e)
        {
            var Nrows = document.getElementById("tblorder-body").rows.length;
            // console.log(Nrows);
            var item_array = [];
            for(i=0;i<Nrows;i++)
            {
                var id = (document.getElementById("tblorder-body").rows[i].cells[2].innerHTML);
                var val=id.split("order");
                var item_id=val[1];  
                var qty= (document.getElementById(id).value);  
                var item = {item_id:item_id, qty:qty};                
                item_array.push(item);
            }
            var json_item = JSON.stringify(item_array);
            document.getElementById("hfarritem").value = json_item;
            $("#hftprice").val(calPrice());
            document.getElementById("frmorder").submit();
        });          

        function calPrice()
        {
            var total = 0;
            var qty = 0;
            var price = 0;
            $('#tblorder tbody tr').each(function()
            {                
                //Qty
                qty = $("#" + this.id + " input[type='number']").val();

                //Price
                price = $("#" + this.id + " input[type='hidden']").val();

                //total
                total += price * qty;
            });
            return total.toFixed(2);;
        }

        function viewPrice()
        {
            $("#resPrice").text(calPrice());
        }
    </script>
@endsection