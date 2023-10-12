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
            //fashion
            [ /// subcategory_id=1
                'category_id' => '1',
                'subcategory_name' => $sub_category = "man clothes",
                'subcategory_slug' => strtolower(str_replace(' ', '-', $sub_category)),
            ],
            [ /// subcategory_id=2
                'category_id' => '1',
                'sub_category_name' => $sub_category = 'woman clothes',
                'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

            ], [ /// subcategory_id=3
                'category_id' => '1',
                'sub_category_name' => $sub_category = 'kids clothes',
                'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),
            ],

            //electronics
            [ /// subcategory_id=1
                'category_id' => '2',
                'sub_category_name' => $sub_category = 'Mobile',
                'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

            ], [ /// subcategory_id=2
                'category_id' => '2',
                'sub_category_name' => $sub_category = 'Laptop',
                'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

            ],
            [ /// subcategory_id=3
                'category_id' => '2',
                'sub_category_name' => $sub_category = 'Other',
                'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

            ],  /// home&kitchen
            [ /// subcategory_id=1
                'category_id' => '3',
                'sub_category_name' => $sub_category = 'Householde Goods',
                'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

            ], [ /// subcategory_id=2
                'category_id' => '3',
                'sub_category_name' => $sub_category = 'kitchen Tools',
                'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

            ], [ /// subcategory_id=3
                'category_id' => '3',
                'sub_category_name' => $sub_category = 'Cleaners',
                'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

            ],
            //beauty product
            [ /// subcategory_id=1
                'category_id' => '4',
                'sub_category_name' => $sub_category = 'Makeup',
                'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

            ], [ /// subcategory_id=2
                'category_id' => '4',
                'sub_category_name' => $sub_category = 'SkinCare',
                'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

            ],

/// jewelry & Accessories
            [ /// subcategory_id=1
                'category_id' => '5',
                'sub_category_name' => $sub_category = 'Bags',
                'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

            ],  [ /// subcategory_id=2
                'category_id' => '5',
                'sub_category_name' => $sub_category = 'Accessories',
                'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

            ],
             [ /// subcategory_id=3
                'category_id' => '5',
                'sub_category_name' => $sub_category = 'Sunglasses',
                'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

            ],

            /// toys&games
            [ /// subcategory_id=1
               'category_id' => '6',
               'sub_category_name' => $sub_category = 'Puzzle',
               'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

            ],
            [ /// subcategory_id=2
            'category_id' => '6',
            'sub_category_name' => $sub_category = 'Board Game',
            'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

        ],
        [ /// subcategory_id=3
        'category_id' => '6',
        'sub_category_name' => $sub_category = 'Other',
        'sub_category_slug' => strtolower(str_replace(' ', '-', $sub_category)),

    ]

        ]);
    }
}
