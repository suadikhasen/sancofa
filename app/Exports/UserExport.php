<?php

namespace App\Exports;

use App\Sancofa\SancofaUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromQuery,ShouldQueue,WithHeadings
{   
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return SancofaUser::query()->select('sancofa_id','full_name','gender','phone_no','department','university_id','created_at')->orderBy('full_name');
    }

    public function headings(): array
    {
        return [

            'sancofa id',
            'full name',
            'gender',
            'phone_no',
            'university_id',
            'department',
            'registration date',
            
        ];
    }
}
