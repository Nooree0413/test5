<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->unsignedInteger('status_id');
            $table->string('duration');
            $table->datetime('date_start');
            $table->datetime('date_end');
            $table->unsignedInteger('type_id');
            $table->boolean('paid_activity')->nullable();
            $table->date('deadline');
            $table->integer('admin_id');
            $table->boolean('invite_status')->default(false);
            $table->string('image_path')->default('SampleEvent.jpg');                 
            $table->rememberToken();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username')->unique();
            $table->string('contactnum')->unique();
            $table->string('admin');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('img_path')->nullable()->default('userAvatar.png');
            $table->rememberToken();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('user_event', function (Blueprint $table) {
            $table->primary(['user_id', 'event_id']);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('event_id');
            $table->enum('status', ['going','not_going'])->default("not_going");
            $table->boolean('paid_status')->default(false);                
            $table->rememberToken();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
        
        Schema::create('type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type'); 
            $table->boolean('order_status')->default(false);  
            $table->rememberToken();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');   
            $table->rememberToken();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('event_id');            
            $table->float('total_price');
            $table->boolean('paid_status')->default(false);
            $table->rememberToken();
            $table->timestamp('order_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name');
            $table->float('item_price');
            $table->text('item_description');
            $table->rememberToken();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->primary(['order_id', 'item_id']);
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('item_id');
            $table->integer('item_quantity')->default(1);
            $table->rememberToken();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('event_item', function (Blueprint $table) {
            $table->primary(['event_id', 'item_id']);
            $table->unsignedInteger('event_id');
            $table->unsignedInteger('item_id');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('user_event', function (Blueprint $table) 
        {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });

        Schema::table('event_item', function (Blueprint $table) 
        {
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });

        Schema::table('events', function (Blueprint $table) 
        {
            $table->foreign('type_id')->references('id')->on('type')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
        });

        Schema::table('orders', function (Blueprint $table) 
        {
            $table->foreign('user_id')->references('user_id')->on('user_event')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
        
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('events');
        Schema::dropIfExists('user_event');
        Schema::dropIfExists('type');
        Schema::dropIfExists('staus');
    }
}
