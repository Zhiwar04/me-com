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
            [ /// id=1
         'brand_name' => $brand = 'Apple',
         'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
            'brand_image' => 'apple.png',

            ],
            [  // id=2
                'brand_name' => $brand = 'Samsung',
                'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
                'brand_image' => 'samsung.png',
            ],
            [  /// id=3
                'brand_name' => $brand = 'Zara',
                'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
                'brand_image' => 'zara.png',
            ],
             [  /// id=4
                'brand_name' => $brand = 'Shein',
                'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
                'brand_image' => 'shein.png',
            ],
            [  /// id=5
                'brand_name' => $brand = 'Nike',
                'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
                'brand_image' => 'nike.png',
            ], [  // id=6
                'brand_name' => $brand = 'Glorious',
                'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
                'brand_image' => 'glorious.png',
            ],
            [  // id=6
                'brand_name' => $brand = 'Asus',
                'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
                'brand_image' => 'asus.png',
            ],
             [  // id=7
                'brand_name' => $brand = 'IKEA',
                'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
                'brand_image' => 'ikea.png',
            ],
            [  // id=8
               'brand_name' => $brand = 'XOX',
               'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
               'brand_image' => 'xox.png',
           ],[  // id=9
            'brand_name' => $brand = 'Jaws',
            'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
            'brand_image' => 'jaws.png',
        ],[  // id=10
            'brand_name' => $brand = 'Kylie',
            'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
            'brand_image' => 'kylie.png',
        ],[  // id=11
            'brand_name' => $brand = 'HudaBeauty',
            'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
            'brand_image' => 'hudabeauty.png',
        ],[  // id=12
            'brand_name' => $brand = 'The Ordinary',
            'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
            'brand_image' => 'theordinary.png',
        ],[  // id=13
            'brand_name' => $brand = 'La-Roche-Posay',
            'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
            'brand_image' => 'La-Roche-Posay-.png',
        ],[  // id=14
            'brand_name' => $brand = 'Dolce & Gabbana ',
            'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
            'brand_image' => 'D&G.png',
        ],[  // id=15
            'brand_name' => $brand = 'Casio',
            'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
            'brand_image' => 'casio.png',
        ],[  // id=16
            'brand_name' => $brand = 'Lego',
            'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
            'brand_image' => 'lego.png',
        ],[  // id=17
            'brand_name' => $brand = 'Barbie',
            'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
            'brand_image' => 'barbie.png',
        ],[  // id=18
            'brand_name' => $brand = 'Dior',
            'brand_slug' =>strtolower(str_replace(' ','-',$brand)),
            'brand_image' => 'dior.png',
        ],
            ]);

              }

}
