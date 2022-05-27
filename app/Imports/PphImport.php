<?php

namespace App\Imports;

use App\Pph;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
class PphImport implements ToModel, WithStartRow,WithCalculatedFormulas
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
                'lastdate' => date('Y-m-d'), 
                'sts' => 0, 
            ]);
            // 'HeaderText','Reference','LIFNR','Docno','AmountDpp','AmountPph','DateDocno','sts','nodoc','vocer','lastdate','tgl_faktur'

            
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
