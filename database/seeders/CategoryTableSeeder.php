<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
            'category_name' => $category = 'Fashion',
            'category_slug' =>strtolower(str_replace(' ','-',$category)),
            'category_image' => 'fashion.jpg',
            ],
            [
                'category_name' => $category = 'Electronics',
                'category_slug' =>strtolower(str_replace(' ','-',$category)),
                'category_image' => 'electronic.jpg',
            ]

        ]);
    }
}