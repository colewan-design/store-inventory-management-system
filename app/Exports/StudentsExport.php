<?php

namespace App\Exports;

use App\Models\Students;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection
{
    protected $section;

    public function __construct($section = null)
    {
        $this->section = $section;
    }

    public function collection()
    {
        $students = Students::query();
        if ($this->section) {
            $students->where('section', $this->section);
        }
        return $students->get();
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
            'section'
        ];
    }
}
