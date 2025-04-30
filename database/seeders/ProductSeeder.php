<?php
 
 namespace Database\Seeders;
 
 use Illuminate\Database\Seeder;
 use Illuminate\Support\Facades\DB;
 use App\Models\Category;
 
 class ProductSeeder extends Seeder
 {
     public function run()
     {
         $electronics = Category::where('name', 'Electronics')->first();
         $accessories = Category::where('name', 'Accessories')->first();
 
         DB::table('products')->insert([
             ['name' => 'Laptop', 'category_id' => $electronics->id],
             ['name' => 'Smartphone', 'category_id' => $electronics->id],
             ['name' => 'Tablet', 'category_id' => $electronics->id],
             ['name' => 'Headphones', 'category_id' => $accessories->id],
             ['name' => 'Smartwatch', 'category_id' => $accessories->id],
         ]);
     }
 }