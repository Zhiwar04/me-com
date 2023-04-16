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
                'email' => 'zhiwar@gmail.com',
                'password' => hash::make(111),

            ],
        ]);
    }
}