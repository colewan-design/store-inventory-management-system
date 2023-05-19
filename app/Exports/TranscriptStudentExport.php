<?php

namespace App\Exports;

use App\Models\Students;
use App\Models\subjects;
use App\Models\student_grades;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TranscriptStudentExport implements FromCollection, WithHeadings
{
    protected $studentId;

    public function __construct($studentId)
    {
        $this->studentId = $studentId;
    }

    public function collection()
    {
        $student = DB::table('students')
            ->where('account_id', $this->studentId)
            ->first();

        if (!$student) {
            return collect([]);
        }

        $grades = DB::table('student_grades')
            ->where('student_id', $this->studentId)
            ->first();

        if (!$grades) {
            return collect([]);
        }

        $average = ($grades->first_grading + $grades->second_grading + $grades->third_grading + $grades->fourth_grading) / 4;

        return collect([
            [
                'Account ID' => $student->account_id,
                'First Name' => $student->first_name,
                'Middle Name' => $student->middle_name,
                'Last Name' => $student->last_name,
                'Address' => $student->address,
                'Gender' => $student->gender,
                'Contact Number' => $student->contact_number,
                'Birthdate' => $student->student_birthdate,
                'Email' => $student->email,
                'Level' => $student->level,
                'Section' => $student->section,
                '1st Grading' => $grades->first_grading,
                '2nd Grading' => $grades->second_grading,
                '3rd Grading' => $grades->third_grading,
                '4th Grading' => $grades->fourth_grading,
                'Average' => $average,
            ],
        ]);
    }

    public function headings(): array
    {
        return [
            'Account ID',
            'First Name',
            'Middle Name',
            'Last Name',
            'Address',
            'Gender',
            'Contact Number',
            'Birthdate',
            'Email',
            'Level',
            'Section',
            '1st Grading',
            '2nd Grading',
            '3rd Grading',
            '4th Grading',
            'Average',
        ];
    }
}
