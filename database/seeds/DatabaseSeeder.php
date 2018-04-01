<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Hashing\BcryptHasher;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        factory(App\User::class, 10)->create();
        factory(App\Product::class, 10)->create();
        factory(App\Order::class, 10)->create();
        factory(App\Category::class, 10)->create();
        factory(App\Address::class, 10)->create();
        DB::table('navigation_items')->insert(
            [
                'name' => 'Home',
                'action' => 'PublicController@index',
                'route' => 'index',
            ]
        );

        DB::table('navigation_items')->insert(
            [
                'name' => 'About',
                'action' => 'PublicController@about',
                'route' => 'about',
            ]
        );
        DB::table('users')->insert(
            [
                'first_name' => 'user',
                'second_name' => 'user',
                'email' => 'user',
                'role'=> 0,
                'password' => '$2y$10$mM/SFzzfgLGEKhoHijJTTevTmXMVX0scbebucdr4XubqGH9HACSZy', // user
            ]
        );

        DB::table('users')->insert(
            [
                'first_name' => 'admin',
                'second_name' => 'admin',
                'email' => 'admin',
                'role'=> 1,
                'password' =>'$2y$10$.2MTtwETa71tphE2NLEn3.FHzB2pSPwjauNBWIGpixvBWeqJ5CIWu', // admin
            ]
        );

        for ($x = 1; $x <= random_int(1, 10); $x++) {
            for ($y = 1; $y <= random_int($x + 1, 10); $y++) {
                DB::table('order_product')->insert(
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
                DB::table('category_product')->insert(
                    [
                        'category_id' => $x,
                        'product_id' => $y,
                    ]
                );
            }
        }
    }
}
