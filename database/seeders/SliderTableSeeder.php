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
            'slider_title' => $slider = 'Fashion',
            'short_title' =>'this is fashion slider',
            'slider_image' => 'fashion.jpg',
            ],
            [
                'slider_title' => $slider = 'Electronics',
                'short_title' =>'this is electronics slider',
                'slider_image' => 'electronic.jpg',
            ]

        ]);
    }
}