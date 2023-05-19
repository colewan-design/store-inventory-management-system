<?php

namespace App\Exports;

use App\Models\Students;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class TopStudentsExport implements FromCollection
{
    protected $section;

    public function __construct($section = null)
    {
        $this->section = $section;
    }

    public function collection()
    {
        $students = DB::table('students')
            ->leftJoin('student_grades', 'students.account_id', '=', 'student_grades.student_id')
            ->select('students.account_id', 'students.first_name', 'students.last_name', 'students.address', 'students.gender', 'students.contact_number', 'students.student_birthdate', 'students.email', 'students.level', 'students.section', 'student_grades.first_grading', 'student_grades.second_grading', 'student_grades.third_grading', 'student_grades.fourth_grading')
            ->where('students.section', $this->section)
            ->get();

        $students = $students->map(function ($student) {
            $grades = [$student->first_grading, $student->second_grading, $student->third_grading, $student->fourth_grading];
            $grades = array_filter($grades); // remove null or empty grades
            $average = count($grades) > 0 ? array_sum($grades) / count($grades) : 0;
            $student->average = $average;
            return $student;
        });

        $students = $students->sortByDesc('average')->take(3); // change the number to the desired top records count

        return $students;
    }

    public function headings(): array
    {
        return [
            'account_id',
            'first_name',
            'last_name',
            'address',
            'gender',
            'contact_number',
            'student_birthdate',
            'email',
            'level',
            'section',
            'first_grading',
            'second_grading',
            'third_grading',
            'fourth_grading',
            'average'
        ];
    }
}
