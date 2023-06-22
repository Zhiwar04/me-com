<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
            'product_name' => $product = 't-shirt',
            'product_slug' =>strtolower(str_replace(' ','-',$product)),
            'product_code' => '123456',
            'selling_price' => '5000',
            'discount_price' => '4000',
            'short_descp' => 'this is a t-shirt',
            'long_descp' => 'this is a t-shirt',
            'product_qty' => '10',
            'product_tags' => 'top_product,new_product',
            'product_color' => 'white,black,red',
            'product_size' => 's,m,l',
            'product_thambnail' => 't-shirt.jpg',
            'hot_deals' => '1',
            'featured' => '0',
            'special_offer' => '1',
            'special_deals' => '0',
            'status' => '1',
            'vendor_id' => '4',
            'category_id' => '1',
            'subcategory_id' => '1',
            'brand_id' => '1',

            ]
            ]);
    }
}
