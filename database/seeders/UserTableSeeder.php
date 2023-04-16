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
            //admin
            [

                'name' => 'admin',
                'username'=>'admin',
                'email' => 'admin@gmail.com',
                'password' => hash::make(111),
                'role' => 'admin'
            ],
            //vendor
            [
                'name' => 'vendor',
                'username'=>'vendor',
                'email' => 'vendor@gmail.com',
                'password' => hash::make(111),
                'role' => 'vendor'
            ],
            //user
            [
                'name' => 'user',
                'username'=>'user',
                'email' => 'zhiwar@gmail.com',
                'password' => hash::make(111),
                'role' => 'user'
            ],
        ]);
    }
}
