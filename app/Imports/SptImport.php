<?php

namespace App\Imports;

use App\Spt;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SptImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cek=Spt::where('LIFNR',$row[0])->count();
        if($cek>0){
            $qwr        =Spt::where('LIFNR',$row[0])->first();
            $qwr->link  =$row[1];
            $qwr->tanggal   =date('Y-m-d');
            $qwr->save();
            return $qwr;
        }else{
            return new Spt([
                'LIFNR'     => $row[0],
                'link'    => $row[1], 
                'tanggal' => date('Y-m-d'), 
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
