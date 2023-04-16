<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            //admin
            [

                'name' => 'zhiwar',
                'username'=>'zhiwar',
                'email' => 'zhiwar@gmail.com',
                'password' => hash::make(111),
                'role' => 'superAdmin'
            ]
            ]);
    }
}