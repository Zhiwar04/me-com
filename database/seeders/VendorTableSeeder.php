<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vendors')->insert([

            //vendor
            [
                'name' => 'vendor',
                'username'=>'vendor',
                'email' => 'vendor@gmail.com',
                'password' => hash::make(111),

            ]]);
    }
}
