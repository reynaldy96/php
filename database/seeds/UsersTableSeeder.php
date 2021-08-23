<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Master',
            'email' => 'admin.mochamadrizkyreynaldy@Gmail.com',
            'password' => bcrypt('opdragon96'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Author',
            'email' => 'more.mochamadrizkyreynaldy@Gmail.com',
            'password' => bcrypt('mstropdragon96'),
        ]);

        DB::table('role_users')->insert([
            'user_id' => '1',
            'role_id' => '1',
        ]);

        DB::table('category')->insert([
            'name' => 'Elektronik',
            'slug' => 'elektro',
        ]);

        DB::table('sub_category')->insert([
            'name' => 'Handphone',
            'category_id' => '1',
            'slug' => 'hp',
        ]);

        DB::table('brands')->insert([
            'name' => 'Apple Xs Max',
            'sub_category_id' => '1',
            'slug' => 'apple',
        ]);

        DB::table('role_users')->insert([
            'user_id' => '2',
            'role_id' => '2',
        ]);

        DB::table('activations')->insert([
            'user_id' => '1',
            'code' => 'wkewhdkdfsakdfldhflkdsflkds',
            'completed' => '1',
        ]);

        DB::table('activations')->insert([
            'user_id' => '2',
            'code' => 'shdkdsfhkjfdsfdssassadsadsa',
            'completed' => '1',
        ]);
    }
}
