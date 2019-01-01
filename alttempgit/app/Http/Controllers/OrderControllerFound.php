<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\sendInvEmail;
use Mail;
use Illuminate\Support\Facades\Hash;

class OrderControllerFound extends Controller
{
    public function index()
    {
        $Event_orders = DB::table('events')
        ->select('events.id','events.name', 'status.status', 'events.date_start')
        ->join('status', 'status.id', '=', 'events.status_id')
        ->join('type','type.id','=','events.type_id')
        ->where('events.status_id', '1')
        ->where('type.order_status','1')
        ->get();


        // $items=DB::table('items')
        // ->get();

        return view('orders.order_found')->with('Event_orders',$Event_orders);
    }

    public function viewOrderForm($id)
    {
        $foodDetails = DB::table('event_item')
        ->select("items.item_name", "items.id", "items.item_price")
        ->join("items", "items.id", "=", "event_item.item_id")
        ->where("event_item.event_id", $id)
        ->get();
        
        $get_event = DB::table('events')
                    ->where('id', $id)->get()
                    ->pluck('deadline');

        return view('users_view.add_order')->with('foodDetails', $foodDetails)->with('get_event', $get_event);
    }

    public function addOrderForm(Request $request, $id)
    {
        $tprice = Input::get('hftprice');
        $event_id = $id;
        // $event_deadline = Input::get('hfedeadline');
        $data = $request->get('hfarritem');      
        $user_id = Auth::user()->id;
        $item_array = json_decode($data, true);
        
        $data_order = array(
            'user_id' => $user_id, 
            'event_id' => $event_id, 
            'total_price' => $tprice, 
            // 'deadline' => $event_deadline
        );

        $order_id = DB::table('orders')->insertGetId($data_order);

        $Order_Detail_arr = array();
        foreach ($item_array as $value) 
        {
            $Order_Detail_arr[$value['item_id']] = $value['qty'];
        }

        foreach ($Order_Detail_arr as $item_id => $qty) 
        {
            DB::table('order_details')->insert(
                [
                    'order_id' => $order_id,
                    'item_id' => $item_id,
                    'item_quantity' => $qty
                ]
            );
        }
        return redirect('/eventfound/user/view')->with("alert", "order_added");
    }

    public function viewOrder($eid,$id)
    {
        $getTotalPrice = DB::table("orders")
        ->select("total_price")
        ->where("id", $id)
        ->get();

        $ordersdet=DB::table('order_details')
        ->select('order_details.item_quantity','items.item_name','items.item_price')
        ->join('items', 'items.id', '=', 'order_details.item_id')
        ->where('order_id', $id)
        ->get();

        $deadline =(DB::table('events')
            ->select('deadline')
            ->where('id',$eid)
            ->get())[0];
        

        return view('users_view.usersvieworder_found')
                ->with('ordersdet',  $ordersdet)
                ->with("event_id", $eid)
                ->with("order_id", $id)
                ->with("getTotalPrice", $getTotalPrice)
                ->with("deadline",$deadline);
    }

    public function viewOrderDetails($order_id)
    {
        $get_unselected_item_sql = "SELECT i.id, i.item_name, item_price FROM items i, event_item ei
                                    WHERE ei.item_id = i.id
                                    AND
                                    item_name NOT IN(
                                        SELECT i.item_name
                                        FROM `items` i
                                        LEFT JOIN order_details od ON i.id = od.item_id
                                        WHERE od.order_id = ".$order_id.")";

        $get_unselected_item_qry = DB::SELECT($get_unselected_item_sql);

        $get_selected_item_qry = DB::table("order_details")
                                ->select("items.*", "order_details.item_quantity")
                                ->join("items", "items.id", "=", "order_details.item_id")
                                ->where("order_details.order_id", $order_id)
                                ->get();

        return view('users_view.add_order_edit')->with("items_remained", $get_unselected_item_qry)->with("items_not_remained", $get_selected_item_qry)->with("order_id", $order_id);
    }

    public function updateOrderDetails($order_id, Request $request)
    {        
        $tprice = Input::get('hftprice');

        $getOrderID = DB::table("orders")
        ->select("event_id")
        ->where("id", $order_id)
        ->get();

        $event_id = $getOrderID[0]->event_id;

        $updateOrderDetail = DB::table("order_details")
        ->where("order_id", $order_id)
        ->delete();

        $updateOrderPrice = DB::table("orders")
        ->update([
            "total_price" => $tprice
        ]);

        $data = $request->get('hfarritem');     
        $item_array = json_decode($data, true);
        $Order_Detail_arr = array();
        foreach ($item_array as $value) 
        {
            $Order_Detail_arr[$value['item_id']] = $value['qty'];
        }

        foreach ($Order_Detail_arr as $item_id => $qty) 
        {
            DB::table('order_details')->insert(
                [
                    'order_id' => $order_id,
                    'item_id' => $item_id,
                    'item_quantity' => $qty
                ]
            );
        }

        return redirect("/order/view/".$event_id."/".$order_id);
    }
    
}
