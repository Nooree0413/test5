<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('index');
    return view('auth.login');
});

Auth::routes();

Route::resource('events', 'EventControllerFound');
Route::resource('users', 'UserControllerFound');

//Log out from website foundation
Route::get('/logout', 'UserControllerFound@logout');

//------------------------------------------------------------------------------------------

//admin route after login
Route::get('protected', ['middleware' => ['auth', 'admin'], function() {
    return view('/admin/dashboard');
}]);

//user route after login
Route::get('protected', ['middleware' => ['auth'], function() {
    // this page requires that you be logged inbut you don't need to be an admin
    return view( '/eventfound/view' );
}]);

//ajax select
Route::get('/search-item/{id}', function($id)
{
    $item_qry = DB::table('items')
                ->where('id', $id)
                ->get();
    return Response::json($item_qry);
});


//routes  that only admin can access
Route::group(['middleware' => 'admin'], function () {
Route::get('/check-type/{id}', function($id)
{
    $check_type_qry = DB::table('type')
                ->where('id', $id)
                ->get();
    return Response::json($check_type_qry);
});

//To make payment on orderlist
Route::get('/update-payment/{order_id}/{paid_status}', function($order_id, $paid_status)
{
    $update_payment = DB::table('orders')
                ->where('id', $order_id)                
                ->update([
                    "paid_status" => $paid_status
                ]);
   return Response::json("success");
});

Route::post('/webconftype', 'webconfController@addEventType')->name('webconf.addEventType');
Route::post('/webconfstatus', 'webconfController@addStatus')->name('webconf.addStatus');
Route::post('/webconfedittype', 'webconfController@typeupdate')->name('webconf.typeupdate');
Route::post('/webconfedits', 'webconfController@statusupdate')->name('webconf.statusupdate');
Route::get('/webconft/{id}', 'webconfController@typedelete')->name('webconf.typedelete');
Route::get('/webconf/{id}', 'webconfController@statusdelete')->name('webconf.statusdelete');
Route::get('/webconf/item/delete/{id}', 'webconfController@itemdelete')->name('webconf.itemdelete');
Route::post('/webconfedit', 'webconfController@itemupdate')->name('webconf.itemupdate');
Route::post('/webconfitem', 'webconfController@addItem')->name('webconf.addItem');
Route::get('/webconf', 'webconfController@index');

 // ---------------------------FOR ORDERS----------------------------------
Route::get('/orderlist', 'OrderControllerFound@index');

//Access the page of the Add event form
Route::get('events/add/eventform', 'EventControllerFound@index');
Route::get('/view/order/{id}', 'EventControllerFound@viewOrder');
Route::post('events/add/eventform', 'EventControllerFound@add_event')->name('user.addEvent');
Route::get('/show/menu/{id}', 'EventControllerFound@show_menu') ;
Route::post('/show/menu/{id}', 'EventControllerFound@add_item_menu') ;
Route::get('/delete/menu/{event_id}/{item_id}', 'EventControllerFound@delete_menu_item') ;
Route::get('/eventform/{id}', 'EventControllerFound@sendInvEmail');
Route::get('/eventfound/checkEventStatus/{id}', 'UserEventControllerFound@checkEventStatus');


Route::get('/admin/dashboard', 'AdminControllerFound@index');

//Access Foundation css view user page
Route::get('/usersfound/view', 'UserControllerFound@index');

//Access Foundation css view event page
Route::get('/eventfound/view', 'EventControllerFound@index');

//Delete user Foundation css view user page
Route::get('/usersfound/delete/{id}', 'UserControllerFound@delete');

//Delete event Foundation css view user page
Route::get('/eventfound/delete/{id}', 'EventControllerFound@delete');
Route::get('/create_foundation', 'UserControllerFound@createview');
Route::post('/create_foundation', 'UserControllerFound@add_user')->name('user.add');

//Accessing the show event form based on its id foundation
Route::get('/eventfound/show/{id}', 'EventControllerFound@show');
Route::post('change/pass/update', 'UserControllerFound@passchg')->name('users.passchgadmin');

//Accessing the show user form based on its id foundation
Route::get('/usersfound/show/{id}', 'UserControllerFound@show');

//Access the page view add events form foundation
Route::get('/eventform', 'EventControllerFound@add_event_form');

//Delete user_event record foundation css
Route::get('/eventstatus_found/delete/{event_id}{user_id}', 'EventControllerFound@deleteUserEvent');

//Update user_event record foundation css
Route::post('/usersfound/view/update', 'userEditFoundController@update')->name('usersEdit.update');

route::get('/orderfound/view', 'OrderControllerFound@index');

//Edit profile of user
Route::get('/admin/editprofile','UserControllerFound@profileviewa');
//Update user profile details
Route::post('/admin/editprofile','UserControllerFound@profileAdminUpdate')->name('user.editProfile');

Route::get('/eventfound/updateUserEventStatus/{id}', 'UserEventControllerFound@updateUserEventStatus');

//Edit event form using event id
Route::get('/eventfound/edit/{id}', 'EventControllerFound@edit');

//Update event's details
Route::post('/eventfound/edit/{id}', 'EventControllerFound@edit_event');

//Access payment page
Route::get('/show/payment', 'EventControllerFound@pay_event');

});

//routes that only users can access
Route::group(['middleware' => 'user'], function () {
// ---------------------------FOR USERS ONLY----------------------------------
Route::get('/eventfound/user/view', 'UserOnlyControllerFound@index');
Route::get('/eventfound/user/updateStatus', 'UserOnlyControllerFound@update_status');
Route::get('users_view/userviewshow/{id}', 'UserOnlyControllerFound@showEvent');
Route::get('user/profile/view', 'UserOnlyControllerFound@profileview');
Route::post('user/profile/view', 'UserOnlyControllerFound@profileupdate');
Route::post('/pass/update', 'UserControllerFound@passchg')->name('users.passchg');
// ---------------------------FOR USERS ONLY----------------------------------
Route::get('/order/add/{id}', 'OrderControllerFound@viewOrderForm');
Route::post('/order/add/{id}', 'OrderControllerFound@addOrderForm');
Route::get('/order/view/{eid}/{id}', 'OrderControllerFound@viewOrder');
Route::get('/order/modify/{order_id}', 'OrderControllerFound@viewOrderDetails');
Route::post('/order/modify/{order_id}', 'OrderControllerFound@updateOrderDetails');

//ajax select item from add order in user side
Route::get('/search-item/{id}', function($id)
{
    $item_qry = DB::table('items')
                ->where('id', $id)
                ->get();
    return Response::json($item_qry);
});

//ajax delete item from order_details table in user side
Route::get('/delete-item/{id}/{order_id}', function($id, $order_id)
{
    $item_remove = DB::table('order_details')
                    ->where("item_id", $id)
                    ->where("order_id", $order_id)
                    ->delete();

    return "Item_deleted";
});

//ajax insert item in order_details table in user side
Route::get('/insert-item/{order_id}/{item_id}', function($order_id, $item_id)
{
    $item_inserted = DB::table('order_details')
                    ->insert([
                        "order_id" => $order_id,
                        "item_id" => $item_id
                    ]);                    

    return "Item_inserted";
});

//ajax reset order price in order_details table in user side
Route::get('/reset/orderprice/{order_id}', function($order_id)
{
    $item_price_reset = DB::table('orders')
                    ->where("id", $order_id)
                    ->update([
                        "total_price" => '0'
                    ]);                    

    return "Total Price Reset";
});

//ajax list item in order_details table in user side
Route::get('/list-item/{order_id}', function($order_id)
{
    /* $get_unselected_item_sql = "SELECT DISTINCT od.order_id, ei.item_id, i.item_name,i.item_price from event_item ei
    inner join items i on ei.item_id=i.id
    left join order_details od on ei.item_id!=od.item_id
    where od.order_id=".$order_id; */
    $event_id=(DB::table('orders')->select('event_id')->where('id',$order_id)->get())[0]->event_id;
    $get_unselected_item_sql = "SELECT i.id, i.item_name, item_price FROM items i, event_item ei
                                    WHERE ei.item_id = i.id
                                    AND ei.event_id=".$event_id.
                                    " AND
                                    item_name NOT IN(
                                        SELECT i.item_name
                                        FROM `items` i
                                        LEFT JOIN order_details od ON i.id = od.item_id
                                        WHERE od.order_id = ".$order_id.")";

    $get_unselected_item_qry = DB::SELECT($get_unselected_item_sql);

    return Response::json($get_unselected_item_qry);
});

// ---------------------------FOR USERS ONLY----------------------------------

// Route::get('/eventform/userstatus/{uid}{eid}', 'UserEventControllerFound@updateUserStatus');
});

Route::get('/eventform/userstatus/{uid}{eid}', 'UserEventControllerFound@updateUserStatus');


