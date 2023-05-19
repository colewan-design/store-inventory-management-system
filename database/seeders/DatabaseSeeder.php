<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Teacher;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Subjects::factory(10)->create();
        $students = \App\Models\Students::factory(10)->create();
        $teachers = \App\Models\Teacher::factory(10)->create();
        \App\Models\Staffs::factory(10)->create();
        \App\Models\Buildings::factory(10)->create();
        \App\Models\Rooms::factory(10)->create();
        \App\Models\Announcements::factory(10)->create();

       // Insert data from teachers table to users table
        foreach ($teachers as $teacher) {
            DB::table('users')->insert([
                'account_id' => $teacher->account_id,
                'name' => $teacher->first_name . ' ' . $teacher->middle_name . ' ' . $teacher->last_name,
                'role' => 'teacher',
                'email' => $teacher->email,
                'contact_number' => $teacher->contact_number,
                'password' => bcrypt('password') // add default password field
            ]);
        }
         // Insert data from students table to users table
         foreach ($students as $student) {
            DB::table('users')->insert([
                'account_id' => $student->account_id,
                'name' => $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name,
                'role' => 'student',
                'email' => $student->email,
                'contact_number' => $student->contact_number,
                'password' => bcrypt('password') // add default password field
            ]);
        }


        $this->call([
        
               //-------wag gagalawin--------------------//
               UserSeeder::class,
               // AssignExamSeeder::class,
                //AssignQuizSeeder::class,
                //-----------------------------------------//
        ]);
    }
}

