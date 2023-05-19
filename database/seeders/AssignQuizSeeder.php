<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignQuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a Superadmin user
        DB::table('assign_quizzes')->insert([
            'student_id' => '01',
            'quiz_id' => '01',
            'date_assigned' => date('Y-m-d'),
            'score' => 0,
            'date_due' => date('Y-m-d'),
            'status' => 'Failed',
            'notes' => 'Notes here',
        ]);
    }
}
