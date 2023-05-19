<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class DocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
 

     public function run()
     {
         // Insert Something into the Document DB
         DB::table('files')->insert([
            'id' => '1',
            'user_id' => '01',
            'name' => 'image1sample',
            'type' => 'jpg',
            'size' => '23 kb',
            'created_at' => '2023-03-22',
            'updated_at' => '2023-03-22',
         ]);

     }
}
