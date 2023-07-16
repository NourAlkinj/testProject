<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'first_name'=> 'ali',
            'last_name'=> 'ali',
            'email'=> 'user1',
            'password'=> 'uuuu',
            'phone_number'=> '12233445',
            'product_ids'=> [['id' => 1], ['id' => 2]],
        ]);
        User::create([
            'first_name'=> 'ahmad',
            'last_name'=> 'ahmad',
            'email'=> 'user2',
            'password'=> 'dddd',
            'phone_number'=> '566783',
            'product_ids'=> [['id' => 3]],
        ]);
        User::create([
            'first_name'=> 'sami',
            'last_name'=> 'sami',
            'email'=> 'user3',
            'password'=> 'bbbb',
            'phone_number'=> '783422',
            'product_ids'=> [['id' => 4], ['id' => 1]],
        ]);
        User::create([
            'first_name'=> 'hala',
            'last_name'=> 'hala',
            'email'=> 'user4',
            'password'=> 'cccc',
            'phone_number'=> '99909',
            'product_ids'=> null,
        ]);
    }
}
