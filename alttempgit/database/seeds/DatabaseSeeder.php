<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            [
                'status' => 'Upcoming'
            ],
            [
                'status' => 'Ongoing'
            ],
            [
                'status' => 'Completed'
            ],
            [
                'status' => 'Cancelled'
            ]
        ]);

        DB::table('type')->insert([
            [
            'type' => 'Team Building',
            'order_status' => false 
            ],
            [
            'type' => 'Food' ,
            'order_status' => true 
            ]
        ]);

        DB::table('users')->insert([
            [
                'firstname' => 'admin',
                'lastname' => 'admin',
                'username' => 'ad12',
                'contactnum' => '57896461',
                'admin' => '1',
                'email' => 'admin_mail@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'firstname' => 'Nadeem',
                'lastname' => 'Garda',
                'username' => 'nad12',
                'contactnum' => '57412326',
                'admin' => '0',
                'email' => 'ns_sahib@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'username' => 'jon12',
                'contactnum' => '57411326',
                'admin' => '0',
                'email' => 'jon12@gmail.com',
                'password' => bcrypt('123456'),
            ]
        ]);
        
        DB::table('events')->insert([
            [
                'name' => 'mama day',
                'description' => 'this is a mama day',
                'status_id' => '2',
                'duration' => '2',
                'date_start' => '2018-07-03',
                'date_end' => '2019-07-05',
                'type_id' => '2',
                'paid_activity' => '1',
                'deadline' => '2018-07-02',
                'admin_id' => '1'
            ],
            [
                'name' => 'Music Day',
                'description' => 'this is a Music day',
                'status_id' => '1',
                'duration' => '2',
                'date_start' => '2018-11-04',
                'date_end' => '2018-12-06',
                'type_id' => '1',
                'paid_activity' => '1',
                'deadline' => '2018-11-03',
                'admin_id' => '1'
            ],
            [
                'name' => 'Dance Day',
                'description' => 'this is a Music day',
                'status_id' => '1',
                'duration' => '2',
                'date_start' => '2018-11-04',
                'date_end' => '2018-12-06',
                'type_id' => '2',
                'paid_activity' => '1',
                'deadline' => '2018-11-03',
                'admin_id' => '1'
            ]
        ]);
        
        // DB::table('user_event')->insert([
        //     'user_id' => '2',
        //     'event_id' => '1',
        //     'status' => 'going',
        //     'paid_status' => '1'
        // ]);

        // DB::table('orders')->insert([
        //     'user_id' => '2',
        //     'event_id' => '1',
        //     'total_price' => 100.00,
        //     'deadline' => '2018-07-02'
        // ]);

        DB::table('items')->insert([
            ['item_name' => 'mine bouilee',
            'item_price' => '100',
            'item_description' => 'This is mine bouilee'],

            ['item_name' => 'mine frite',
            'item_price' => '50',
            'item_description' => 'This is mine frite'],

            ['item_name' => 'mine kanz',
            'item_price' => '0',
            'item_description' => 'This is mine kanz']
        ]);

        DB::table('event_item')->insert([
            [
                'event_id' => '1',
                'item_id' => '1'            
            ],
            [
                'event_id' => '1',
                'item_id' => '2'            
            ],
            [
                'event_id' => '3',
                'item_id' => '1'            
            ],
            [
                'event_id' => '3',
                'item_id' => '2'            
            ]
        ]);

        // DB::table('order_details')->insert([
        //     [
        //     'order_id' => '1',
        //     'item_id' => '2',
        //     'item_quantity' => '2' 
        //     ]
        // ]);
    }
}
