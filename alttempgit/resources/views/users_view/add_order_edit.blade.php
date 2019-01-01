@extends("layouts.userfound")
@section("content")
    @section("contentcss")        
        <link rel="icon" href="{{asset('images/food.png')}}" />
        {{-- Page Title --}}
            <title>Order Food Modify</title>
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
            <div class="cell small-10 order-div">
                <fieldset class="placeorderfieldset">
                    <legend class="myorderLegend">My Order</legend>
                    <form id="frmorder" class="frmorderspacing" action="" method="POST">
                        @csrf
                        <input type="hidden" name="hftprice" id="hftprice">
                        <input type="hidden" name="hforder_id" id="hforder_id" value="{{$order_id}}">
                        <table id="tblorder" class="tblplaceorderfrm table-striped">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th colspan="2">Quantity</th>
                                </tr>
                                <tbody id="tblorder-body">
                                    @foreach($items_not_remained as $item_not_remained)
                                        <tr id="{{$item_not_remained->id}}">
                                            <td>
                                                {{$item_not_remained->item_name}}
                                            </td>
                                            <td>
                                                <input type='number' class='qty-input' value='{{$item_not_remained->item_quantity}}' id='order{{$item_not_remained->id}}'><input type='hidden' name='hfprice{{$item_not_remained->id}}' id='hfprice{{$item_not_remained->id}}' value='{{$item_not_remained->item_price}}'>
                                            </td>
                                            <td hidden>order{{$item_not_remained->id}}</td>
                                            <td><button onclick="del('{{$item_not_remained->id}}');" class='btndelitm' title='Remove item' type='button'><i class='fas fa-minus-square'></i> </button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </thead>
                        </table>
                        <div class="grid-x">
                            <div class="cell small-9 btncontainerplace_order"><input type="button" class="button expanded userform_btn btnfocus" name="btnsub" id="btnsub" value="Update order"></div>
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
            select_item();
            $("#btnaddorder").attr('disabled','disabled');
            var numOfVisibleRows = $('tbody tr:visible').length;
                if(numOfVisibleRows==0)
                {
                    $("#frmorder").hide();
                }
                else
                {
                    $("#frmorder").show();
                }
                                    
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
                    var val = $("#callbacks option:selected").val(); //item id
                    var valTxt = $("#callbacks option:selected").text(); //item name
                    var price = $("#callbacks option:selected").attr('data-price'); //item price
                    var order_id = $("#hforder_id").val();
                    $("#frmorder").show();
                    $("#tblorder tbody").append(
                    "<tr id=\'"+val+"\'>"+
                    "<td >"+valTxt+"</td>"+
                    "<td><input type=\'number\' class=\'qty-input\' value='1' placeholder=\'Qty\' id=\'order"+val+"\'><input type=\'hidden\' name=\'hfprice"+val+"\' id=\'hfprice"+val+"\' value=\'"+price+"\'></td>"+
                    "<td hidden>order"+val+"</td>"+
                    "<td><button onclick=\"del("+val+");\" class=\'btndelitm\' title=\'Remove item\' type=\'button\'><i class=\'fas fa-minus-square\'></i> </button></td></tr>");
                                        
                    $.get('/insert-item/'+order_id+'/'+val , function(data)
                    {                    
                        if(data == "Item_inserted")
                        {
                            iziToast.success({
                                title: 'Item',
                                message: 'successfully inserted!',
                            });
                        }
                    })
                    $("#callbacks option:selected").hide();
                    $("#btnaddorder").attr('disabled','disabled');
                });
            });

        function select_item()
        {
            var order_id = $("#hforder_id").val();
            $.get('/list-item/'+order_id, function(data)
            { 
                console.log(data);
                var string_html="";
                data.forEach(function (d) 
                {
                    string_html += "<option data-price=\'"+d.item_price+ "\' value=\'"+ d.id +"\'>"+d.item_name+"</option>";
                });
                $('#callbacks').html(string_html);
            });
        }
        
        function del(r)
        {
            $("#callbacks").children("option[value=" + r + "]").show();             
            $(String("#"+r)).remove();
            var order_id = $("#hforder_id").val();
            $("#callbacks option:selected").prop("selected", false);

            $.get('/delete-item/'+r+'/'+order_id, function(data)
            {                    
                if(data == "Item_deleted")
                {
                    iziToast.success({
                                title: 'Item',
                                message: 'successfully deleted!',
                                color: 'yellow',
                            });
                }
            });

            var numOfVisibleRows = $('tbody tr:visible').length;
            if(numOfVisibleRows==0)
            {
                $("#frmorder").hide();
                $.get('/reset/orderprice/'+order_id, function(data)
                {
                    console.log(data);
                });
            }
            else
            {
                $("#frmorder").show();
            }
            select_item();
        }

        $("#btnsub").on("click", function(e)
        {
            var Nrows = document.getElementById("tblorder-body").rows.length;
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
                console.log("qty: " + qty);

                //Price
                price = $("#" + this.id + " input[type='hidden']").val();
                console.log("price: " + price);

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