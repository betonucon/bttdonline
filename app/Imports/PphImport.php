<?php

namespace App\Imports;

use App\Pph;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PphImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cek=Pph::where('Docno',$row[0])->count();
        if($cek>0){
            
        }else{
            return new Pph([
                'Docno'     => $row[0],
                'DateDocno'    => $row[1], 
                'HeaderText' => $row[2], 
                'LIFNR' => $row[3], 
                'Reference' => $row[4], 
                'AmountDpp' => $row[5], 
                'AmountPph' => $row[6], 
                'sts' => 0, 
            ]);

            
        }
            
    }

     /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
