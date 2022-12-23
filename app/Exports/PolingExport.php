<?php

namespace App\Exports;
use App\ViewPoling;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;;


class PolingExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function view(): View
    {
        $data=ViewPoling::whereYear('tanggal',date('Y'))->orderBy('id','Asc')->get();
        return view('bttd.excel', [
            'data' => $data
        ]);
    }
}
