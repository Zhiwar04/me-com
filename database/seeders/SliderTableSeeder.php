<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sliders')->insert([

            [
                'slider_title' => $slider = 'Electronics',
                'short_title' =>'this is electronics slider',
                'slider_image' => 'electronic.jpg',
            ],
            [
                'slider_title' => $slider = 'Accessories & Bags',
                'short_title' => 'this is Accessories & Bags slider',
                'slider_image' => 'accessories.jpg',
            ],[
                'slider_title' => $slider = 'Fashion',
                'short_title' =>'this is fashion slider',
                'slider_image' => 'fashion.jpg',
                ],
            [
                'slider_title' => $slider = 'Beauty ',
                'short_title' => 'this is Beauty Products slider',
                'slider_image' => 'beauty.jpg',
            ],
            [
                'slider_title' => $slider = 'Home & Kitchen',
                'short_title' => 'this is Home & Kitchen slider',
                'slider_image' => 'home.jpg',
            ],
            [
                'slider_title' => $slider = 'Toys & Games',
                'short_title' => 'this is Toys & Games slider',
                'slider_image' => 'game.jpg',
            ]


        ]);
    }
}
