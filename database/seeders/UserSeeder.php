<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([

            [
                'name' => 'Hüseyin',

                'email' => 'huseyin@erbayat.com',

                'password' => bcrypt('12345678'),
                'role' => 'admin'
            ],

            [
                'name' => 'BebekMod',

                'email' => 'info@bebekmod.com',

                'password' => bcrypt('12345678'),
                'role' => 'admin'
            ]

        ]);
    }
}
