<?php

namespace App\Exports;

use App\Models\Newsletter;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class NewsletterExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Newsletter::all();
    }

    // The $user is a instance of the Newsletter model
    public function map($user): array
    {
        return [
            $user->email,
            Carbon::parse($user->created_at)->format('d/m/Y'),
        ];
    }

    public function headings(): array
    {
        return [
            'Email',
            'Пријавен на'
        ];
    }
}
