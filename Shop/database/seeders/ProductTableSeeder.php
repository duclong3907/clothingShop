<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Shirt',
            'category_id'=> '1',
            'description' =>'<p>hello shirt</p>',
            'image'=>'http://127.0.0.1:8000/uploads/men.jpg',
            'quantity'=>'1100',
            'price'=>'1000000',
            'discount_price'=>'900000',
            'deleted' => 0,
            'created_at'=>'2023-08-09 01:30:54',
            'updated_at'=>'2023-08-18 05:55:40'
        ]);

        Product::create([
            'title' => 'Shirt1',
            'category_id'=> '1',
            'description' =>'<p>hello shirt1</p>',
            'image'=>'http://127.0.0.1:8000/uploads/men1.webp',
            'quantity'=>'1100',
            'price'=>'1000000',
            'discount_price'=>'900000',
            'deleted' => 0,
            'created_at'=>'2023-08-09 01:30:54',
            'updated_at'=>'2023-08-18 05:55:40'
        ]);

        Product::create([
            'title' => 'Shirt2',
            'category_id'=> '1',
            'description' =>'<p>hello shirt</p>',
            'image'=>'http://127.0.0.1:8000/uploads/men2.jpg',
            'quantity'=>'1100',
            'price'=>'1000000',
            'discount_price'=>'900000',
            'deleted' => 0,
            'created_at'=>'2023-08-09 01:30:54',
            'updated_at'=>'2023-08-18 05:55:40'
        ]);
    }
}
