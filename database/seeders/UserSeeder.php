<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'sieukute',
            'email' => 'sieukute@gmail.com',
            'password' => Hash::make('123456'),
            // 'phone' => '213456789',
            // 'image' => 'abc' . '.png',

        ]);

        // for ($i = 0; $i < 10; $i++) {
        //     # code...

        //     DB::table('users')->insert([
        //         'name' => Str::random(10),
        //         'phone' => random_int(1000000000, 9999999999),
        //         'image' => Str::random(10) . '.png',
        //         'email' => Str::random(10) . '@gmail.com',
        //         'password' => Hash::make('123456'),
        //     ]);
        // }
    }
}
