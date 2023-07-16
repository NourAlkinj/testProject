<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run(): void
    {
        Product::create([
            'name'=> 'oneProduct',
            'image'=> 'ooone',
            'description'=> 'ooone',
            'user_id' => '1'
        ]);
        Product::create([
            'name'=> 'secondProduct',
            'image'=> 'ssecond',
            'description'=> 'second',
            'user_id' => '1'
        ]);
        Product::create([
            'name'=> 'thirdProduct',
            'image'=> 'third',
            'description'=> 'third',
            'user_id' => '2'
        ]);
        Product::create([
            'name'=> 'fourthProduct',
            'image'=> 'ssecond',
            'description'=> 'fourth',
            'user_id' => '3'
        ]);
    }
}
