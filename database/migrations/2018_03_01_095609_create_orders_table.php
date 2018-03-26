<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->string('session_id')->nullable();
            $table->enum('status', ['active', 'paid', 'send', 'received'])->default('active');
            $table->double('total_price')->default('0');
            $table->integer('address_id')->references('id')->on('addresses')->onDelete('restrict')->nullable();;
            $table->string('track_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
