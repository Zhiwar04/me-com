<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('banners')->insert([
        [
        'banner_title' => 'New Arrivals On Sale',
        'banner_url' => 'https://www.youtube.com',
        'banner_image' => 'banner-1.jpg',
      ],
//[],
      ]);
    }
}