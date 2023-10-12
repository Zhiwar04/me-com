<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
use LDAP\Result;

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
                    'status' => 'active',
                    'photo' => 'avatar-1.png',

            ],
             //admin
             [

                'name' => 'shaida',
                'username'=>'shaida',
                'email' => 'shaida@gmail.com',
                'password' => hash::make(111),
                'role' => 'admin',
                    'status' => 'active',
                    'photo' => 'avatar-1.png',
             ],
             [

                'name' => 'admin',
                'username'=>'admin',
                'email' => 'admin@gmail.com',
                'password' => hash::make(111),
                'role' => 'admin',
                    'status' => 'active',
                    'photo' => 'avatar-1.png',
             ],
                //vendor
                [
                    'name' => 'zhiwar',
                    'username'=>'zhiwar',
                    'email' => 'zhiwar@gmail.com',
                    'password' => hash::make(111),
                    'role' => 'vendor',
                    'status' => 'active',
                    'photo' => resource_path('assets/img/avatars/avatar.jpg'),

        ]
        ]
    );
    }
}
