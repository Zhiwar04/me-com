<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            [
         'brand_name' => $brand = 'Apple',
         'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
            'brand_image' => 'apple.png',

            ],
            [
                'brand_name' => $brand = 'Samsung',
                'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
                'brand_image' => 'samsung.png',
            ]
            ]);

              }

}
