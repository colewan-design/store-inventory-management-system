<?php

namespace App\Exports;

use App\Models\gate;
use Maatwebsite\Excel\Concerns\FromCollection;

class GatePassExport implements FromCollection
{
    public function collection()
    {
        return gate::all();
    }

    public function headings(): array
    {
        return [
            'student_id',
            'status',
            'dateTime',
        ];
    }
}
