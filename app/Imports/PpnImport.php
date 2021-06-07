<?php

namespace App\Imports;

use App\Ppn;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PpnImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cek=Ppn::where('HeaderText',$row[0])->count();
        if($cek>0){
            
        }else{
            return new Ppn([
                'HeaderText' => $row[0], 
                'LIFNR' => $row[1], 
                'Reference' => $row[2], 
                'DateDocno'    => $row[3], 
                'AmountDpp' => $row[4], 
                'AmountPph' => $row[5], 
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
