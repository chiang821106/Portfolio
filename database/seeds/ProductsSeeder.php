<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'p_name' => '女孩子',
            'p_description' => 'by創作者:ashly',
            'p_photo' => 'img/product-img/product-1.jpg',
            'p_price' => 500
         ]);
  
         DB::table('products')->insert([
             'p_name' => '孫悟空',
             'p_description' => 'by創作者:rocky',
             'p_photo' => 'img/product-img/product-2.jpg',
             'p_price' => 500
         ]);
  
         DB::table('products')->insert([
             'p_name' => '少林武僧',
             'p_description' => 'by創作者:mark',
             'p_photo' => 'img/product-img/product-3.jpg',
             'p_price' => 500
         ]);
  
         DB::table('products')->insert([
             'p_name' => '吃我一拳',
             'p_description' => 'by創作者:justin',
             'p_photo' => 'img/product-img/product-4.jpg',
             'p_price' => 500
         ]);
  
         DB::table('products')->insert([
             'p_name' => '公主與野獸',
             'p_description' => 'by創作者:karen',
             'p_photo' => 'img/product-img/product-5.jpg',
             'p_price' => 500
         ]);
  
         DB::table('products')->insert([
             'p_name' => '大戰佛祖',
             'p_description' => 'by創作者:david',
             'p_photo' => 'img/product-img/product-6.jpg',
             'p_price' => 500
         ]); //
         DB::table('products')->insert([
             'p_name' => '大戰佛祖2',
             'p_description' => 'by創作者:david',
             'p_photo' => 'img/product-img/product-6.jpg',
             'p_price' => 500
         ]); //
    }
}
