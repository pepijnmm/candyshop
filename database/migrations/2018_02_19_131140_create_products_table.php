<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public $rules = [
        'name' => 'required||unique:posts|max:100',
        'price' => 'required|max:30|regex:/^[0-9]{3}+\.?[0-9]{2}$/',
        'description' => 'required|max:500',
        'stock' => 'required',
        'weight' => 'required',
        'image_location' => 'required',
        'discount' => '',
    ];
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->double('price', 5, 2);
            $table->string('name', 100);
            $table->string('description', 500);
            $table->double('weight');
            $table->integer('storage');
            $table->integer('discount')->nullable(true);
            $table->string('image_location');
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
        Schema::dropIfExists('products');
    }
}
