<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class SubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_categories')->insert([
            [
            'category_id' => '1', //fashion
            'subcategory_name' => $sub_category = "man clothes",
            'subcategory_slug' =>strtolower(str_replace(' ','-',$sub_category)),
            ],
            [
                'category_id' => '1', //fashion
                'sub_category_name' => $sub_category = 'woman clothes',
                'sub_category_slug' =>strtolower(str_replace(' ','-',$sub_category)),

            ],
            [
                'category_id' => '2', //electronics
                'sub_category_name' => $sub_category = 'mobile',
                'sub_category_slug' =>strtolower(str_replace(' ','-',$sub_category)),

            ],
            [
                'category_id' => '2', //electronics
                'sub_category_name' => $sub_category = 'laptop',
                'sub_category_slug' =>strtolower(str_replace(' ','-',$sub_category)),

            ]

        ]);
    }
}