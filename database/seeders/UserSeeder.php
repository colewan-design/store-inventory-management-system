<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
 

     public function run()
     {
         // Create a Superadmin user
         DB::table('users')->insert([
            'account_id' => 'S01',
             'name' => 'Superadmin',
             'email' => 'superadmin@gmail.com',
             'role' => 'Superadmin',
             'password' => Hash::make('superadmin')
         ]);

         // Create a Staff user
         DB::table('users')->insert([
            'account_id' => 'ST01',
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'role' => 'Staff',
            'password' => Hash::make('staff')
        ]);

         // Create a School Admin user
         DB::table('users')->insert([
            'account_id' => 'SA01',
            'name' => 'School Admin',
            'email' => 'schooladmin@gmail.com',
            'role' => 'School Admin',
            'password' => Hash::make('schooladmin')
        ]);

        // Create a Guard user
        DB::table('users')->insert([
            'account_id' => 'G01',
            'name' => 'Guard',
            'email' => 'guard@gmail.com',
            'role' => 'Guard',
            'password' => Hash::make('guard')
        ]);

        // Create a Finance Officer user
        DB::table('users')->insert([
            'account_id' => 'FO01',
            'name' => 'Finance Officer',
            'email' => 'finance@gmail.com',
            'role' => 'Finance Officer',
            'password' => Hash::make('finance')
        ]);
 
         // Create a Teacher user
         DB::table('users')->insert([
            'account_id' => 'T04262301',
             'name' => 'Teacher',
             'email' => 'teacher@gmail.com',
             'role' => 'Teacher',
             'password' => Hash::make('teacher')
         ]);
 
         // Create a Parent user
         DB::table('users')->insert([
            'account_id' => 'P01',
             'name' => 'John Doe Johnson',
             'email' => 'parent@gmail.com',
             'contact_number' => '+63 2 8877 0101',
             'role' => 'Parent',
             'password' => Hash::make('parent')
         ]);
 
         // Create a Student user
         DB::table('users')->insert([
            'account_id' => 'ST04252301',
             'name' => 'Student',
             'email' => 'student@gmail.com',
             'role' => 'Student',
             'password' => Hash::make('student')
         ]);
          // Create a Student user
          DB::table('files')->insert([
            'user_id' => '1',
            'name' => 'test file',
            'type' => 'Student',
            'size' => 0
        ]);
     }
}
