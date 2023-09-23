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
      ], [
        'banner_title' => 'New Offers',
        'banner_url' => 'https://www.korektel.com',
        'banner_image' => 'banner-2.jpg',
      ], [
        'banner_title' => ' ',
        'banner_url' => 'http://127.0.0.1:8000',
        'banner_image' => 'banner-3.jpg',
      ], [
        'banner_title' => ' ',
        'banner_url' => 'https://moonlinetravel.com',
        'banner_image' => 'banner-4.jpg',
      ], [
        'banner_title' => ' ',
        'banner_url' => 'https://dawakar.com',
        'banner_image' => 'banner-5.jpg',
      ]
//[],
      ]);
    }
}
