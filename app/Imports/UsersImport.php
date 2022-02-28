<?php

namespace App\Imports;

use App\Sancofa\SancofaUser;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
HeadingRowFormatter::default('none');

class UsersImport implements ToModel,WithHeadingRow,WithValidation,ShouldQueue,WithChunkReading

{   

    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
         
      if (!isset($row['department']) || !isset($row['gender']) || !isset($row['university id']) || !isset($row['phone no']) || ($row['gender']!= 'M') || ($row['gender']!='F') || !isset($row['full name']) || !isset($row['sancofa id'])) {
            return null;
        }
      
        return new SancofaUser([
          
            'full_name'     => $row['full name'],
            'gender'         => $row['gender'],
            'department'     => $row['department'],
            'sancofa_id'     => $row['sancofa id'],
            'university_id'  => $row['university id'],
            'created_at'     => now(),
            'phone_no'       => $row['phone no'],
       
        ]);
    }

    public function rules():array
    {
       return [
       // 'full name'     => 'string',
       // 'gender'         => 'present|in:M,F, " "',
       // 'department'     => 'string',
       'sancofa id'     => 'required|unique:sancofa_user,sancofa_id',
       'university id'  => 'unique:sancofa_user,university_id',
       

     ];
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function batchSize(): int
    {
        return 100;
    }


}
