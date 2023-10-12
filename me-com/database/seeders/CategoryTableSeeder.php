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
            [ /// category_id=1
            'category_name' => $category = 'Fashion',
            'category_slug' =>strtolower(str_replace(' ','-',$category)),
            'category_image' => 'fashion.jpg',
            ],
            [/// category_id=2
                'category_name' => $category = 'Electronics',
                'category_slug' =>strtolower(str_replace(' ','-',$category)),
                'category_image' => 'electronic.jpg',
            ],
            [/// category_id=3
                'category_name' => $category = 'Home & Kitchen',
                'category_slug' =>strtolower(str_replace(' ','-',$category)),
                'category_image' => 'home.jpg',
            ],
            [/// category_id=4
                'category_name' => $category = 'Beauty',
                'category_slug' =>strtolower(str_replace(' ','-',$category)),
                'category_image' => 'beauty.jpg',
            ],
            [/// category_id=5
                'category_name' => $category = 'Accessories & Bags',
                'category_slug' =>strtolower(str_replace(' ','-',$category)),
                'category_image' => 'accessories.jpg',
            ],
            [/// category_id=6
                'category_name' => $category = 'Toys & Games',
                'category_slug' =>strtolower(str_replace(' ','-',$category)),
                'category_image' => 'game.jpg',
            ]

        ]);
    }
}
