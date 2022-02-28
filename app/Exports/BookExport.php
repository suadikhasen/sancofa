<?php

namespace App\Exports;

use App\Sancofa\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;	
class BookExport implements FromQuery,ShouldQueue,WithHeadings
{   
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Book::query();
    }

    public function headings(): array
    {
        return [
            'Book Id',
            'Book Name',
            'Book Author',
            'Book Donator',
            'Book Catagory',
            'Price',
            'Registration Date',
            'Book Status',
        ];
    }
}
