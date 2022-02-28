<?php

namespace App\Imports;

use App\Sancofa\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
HeadingRowFormatter::default('none');
class BookImport implements ToModel,WithHeadingRow,WithValidation,WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Book([
          
          'book_name'    =>  $row['name'],
          'book_id'      =>  $row['id'],
          'catagory'     =>  $row['catagory'],
          'book_author'  =>  $row['author'],
          'donator'      =>  $row['donator'],
          'price'        =>  $row['price'],
          'created_at'   => now(),
        ]);
    }

    public function rules():array
    {
     return
      ['name'     => 'required|string',
      'id'        => 'required|unique:books,book_id',
      'catagory'  => 'required',
      'author'    => 'required',
      'donator'   => 'required|string',
      'price'     => 'required|numeric|gt:0',
      ];
    }

    public function batchSize(): int
    {
        return 500;
    }
}
