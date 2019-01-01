<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;

class webconfController extends Controller
{
    public function index()
    {
        $types = DB::table('type')
        ->get();
        // $statuses=DB::table('status')
        // ->get();->with('statuses', $statuses)
        $items=DB::table('items')
        ->get();
        return view('website_config.configuration')->with('types', $types)->with('items',$items);
    }

    public function addEventType(Request $request)
    {

        $orderStatus=Input::get('orderStatus');
        if($orderStatus==null){
            $orderStatus=0;
        }

        $this->validate($request,
        [
            'txttype' => 'unique:type,type|required|alpha|max:255'
        ]       
        );

        $type = Input::get('txttype');
        DB::table('type')->insert(
            [
                'type' => $type,
                'order_status'=>$orderStatus
            ]
        );
        return back()->with('alert','addTypeSuccess');
    }

    public function typeupdate(Request $request)
    {
        $this->validate($request,
        [
            'txtType' => 'max:255|regex:/^[a-zA-Z\s]+$/'
        ]      
        );
        $id = Input::get('typeid');
        $type = Input::get('txtType');
        $orderStatus=Input::get('orderStatus2');

        if($orderStatus==null){
            $orderStatus=0;
        }

        echo $orderStatus;
       
        DB::table('type')
        ->where('id', $id)
        ->update([
            'type' => $type,
            'order_status'=>$orderStatus
            ]);

        return back()->with('alert','editTypeSuccess');
    }
    public function typedelete($id)
    {
       DB::table('type')->where('id', $id)->delete();
       return back()->with('alert','deleteTypeSuccess');
    }
    public function statusdelete($id)
    {
       DB::table('status')->where('id', $id)->delete();
       return back()->with('alert','deleteStatusSuccess');
    }
/*     public function addStatus(Request $request){
        $this->validate($request,
        [
            'txtstatus' => 'unique:status,status|required|alpha|max:255',
            
        ]       
        );

        $status = Input::get('txtstatus');
        
       
        DB::table('status')->insert(
            ['status' => $status]
        );
        return back()->with('alert','addStatusSuccess');
        

    }
    public function statusupdate(Request $request)
    {
        $this->validate($request,
        [
            'txtStatus' => 'unique:status,status|required|alpha|max:255',
            
        ]       
        );

        $id = Input::get('statusid');

       $status = Input::get('txtStatus');
       
       
        DB::table('status')
            ->where('id', $id)
        ->update(['status' => $status]);
            

         //return redirect('/eventfound/view');
         return back()->with('alert','editStatusSuccess');
    } */

    public function addItem(Request $request){
         $this->validate($request,
         [
             'txtitem' => 'required|unique:items,item_name|max:255|regex:/^[a-zA-Z\s]+$/',
             'txtitemdesc' => 'required|max:255',
             'txtitemprice' => 'required||regex:/^\d*(\.\d{1,2})?$/',
         ]       
         );

        $itemname = Input::get('txtitem');
        $itemdesc = Input::get('txtitemdesc');
        $itemprice = Input::get('txtitemprice');
       
        $data = array(
            'item_name' => $itemname, 
            'item_description' => $itemdesc, 
            'item_price' => $itemprice, 
            
        );
           
        DB::table('items')->insert($data);
        return back()->with('alert','addUserSuccess');
    }

    public function itemupdate(Request $request)
    {
        
        $this->validate($request,
        [
            'txtItem' =>  'required|max:255|regex:/^[a-zA-Z\s]+$/',
            'txtItemDesc' => 'required|max:255',
            'txtItemPrice' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        ]       
        );

        $id = Input::get('itemid');

       $itemname = Input::get('txtItem');
       $itemprice = Input::get('txtItemPrice');
       $itemdesc = Input::get('txtItemDesc');



       
       DB::table('items')
       ->where('id', $id)
   ->update(['item_name' => $itemname]);
       
   
       DB::table('items')
       ->where('id', $id)
   ->update(['item_description' => $itemdesc]);

       DB::table('items')
       ->where('id', $id)
       ->update(['item_price' => $itemprice]);
       
     
        
       return back()->with('alert','editEventSuccess');
    }


    public function itemdelete($id)
    {
       DB::table('items')->where('id', $id)->delete();
       return back()->with('alert','deleteUserSuccess');
    }


}
