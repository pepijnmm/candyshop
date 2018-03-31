<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavigationItemSeeder extends Seeder
{
    public function run()
    {
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
    }
}