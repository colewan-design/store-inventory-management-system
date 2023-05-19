<?php
namespace App\Exports;

use App\Models\Students;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;

class StudentsExportPerFilter implements FromQuery, WithHeadings, ShouldQueue
{
    use Exportable;

    protected $section;
    protected $age;
    protected $dropout;
    protected $gender;
    protected $address;

    public function __construct($section = null, $age = null, $dropout = null, $gender = null, $address = null)
    {
        $this->section = $section;
        $this->age = $age;
        $this->dropout = $dropout;
        $this->gender = $gender;
        $this->address = $address;
    }

    public function query()
    {
        $query = Students::query();

        if (!is_null($this->section)) {
            $query = $query->where('section', $this->section);
        }

        if (!is_null($this->age)) {
            $query = $query->where('age', $this->age);
        }

        if (!is_null($this->dropout)) {
            $query = $query->where('dropout', $this->dropout);
        }

        if (!is_null($this->gender)) {
            $query = $query->where('gender', $this->gender);
        }

        if (!is_null($this->address)) {
            $query = $query->where('address', $this->address);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Account ID',
            'First Name',
            'Middle Name',
            'Last Name',
            'Address',
            'Gender',
            'Contact Number',
            'Student Birthdate',
            'Email',
            'Level',
            'Section'
        ];
    }
}
