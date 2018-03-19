<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create();
        factory(App\Product::class, 10)->create();
        factory(App\Order::class, 10)->create();
        factory(App\Category::class, 10)->create();
        factory(App\Address::class, 10)->create();

        for ($x = 1; $x <= random_int(1, 10); $x++) {
            for ($y = 1; $y <= random_int($x + 1, 10); $y++) {
                DB::table('product_on_order')->insert(
                    [
                        'order_id' => $x,
                        'product_id' => $y,
                        'amount' => random_int(1, 25),
                    ]
                );
            }
        }

        for ($x = 1; $x <= random_int(1, 10); $x++) {
            for ($y = 1; $y <= random_int($x + 1, 10); $y++) {
                DB::table('product_on_category')->insert(
                    [
                        'category_id' => $x,
                        'product_id' => $y,
                    ]
                );
            }
        }
    }
}
