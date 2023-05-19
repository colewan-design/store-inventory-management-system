<?php

namespace App\Exports;

use App\Models\Students;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;

class StudentsProfileExport implements FromQuery, WithHeadings, ShouldQueue
{
    use Exportable;

    protected $account_id;

    public function __construct($account_id)
    {
        $this->account_id = $account_id;
    }

    public function query()
    {
        return Students::query()
            ->where('account_id', $this->account_id);
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
