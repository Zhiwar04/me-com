<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //user
            [
                'name' => 'user',
                'username'=>'user',
                'email' => 'zhiwar04@gmail.com',
                'password' => hash::make(111),
                'role' => 'user',
                    'status' => 'active'

            ],
             //admin
             [

                'name' => 'admin',
                'username'=>'admin',
                'email' => 'zhiwar@gmail.com',
                'password' => hash::make(111),
                'role' => 'admin',
                    'status' => 'active'

             ],
                //vendor
                [
                    'name' => 'vendor',
                    'username'=>'vendor',
                    'email' => 'vendor@gmail.com',
                    'password' => hash::make(111),
                    'role' => 'vendor',
                    'status' => 'active'

        ]
        ]
    );
    }
}