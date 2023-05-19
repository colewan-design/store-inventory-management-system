<?php

namespace App\Exports;

use App\Models\Attendances;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    protected $accountId;

    public function __construct($accountId)
    {
        $this->accountId = $accountId;
    }

    public function collection()
    {
        $attendances = DB::table('attendances')
            ->where('student_id', $this->accountId)
            ->get();

        if (!$attendances->count()) {
            return collect([]);
        }

        return $attendances->map(function($attendance) {
            return [
                'Student ID' => $attendance->student_id,
                'Attendance Date' => $attendance->date,
                'Status' => $attendance->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Student ID',
            'Attendance Date',
            'Status',
        ];
    }
}
