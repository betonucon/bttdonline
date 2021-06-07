<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function index(request $request){
        return view('admin.index');
    }
    public function view_data(request $request){
        $data = User::all();
        echo'
        <table id="data-table-fixed-header" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th width="1%"></th>
                <th width="1%" data-orderable="false"></th>
                <th class="text-nowrap">Rendering engine</th>
                <th class="text-nowrap">Browser</th>
                <th class="text-nowrap">Platform(s)</th>
                <th class="text-nowrap">Engine version</th>
                <th class="text-nowrap">CSS grade</th>
            </tr>
        </thead>
        <tbody>';
        foreach($data as $o){

            echo'
            <tr class="odd gradeX">
                <td class="ttd" width="1%" class="f-s-600 text-inverse">1</td>
                <td class="ttd" width="1%" class="with-img"><img src="../assets/img/user/user-1.jpg" class="img-rounded height-30" /></td>
                <td class="ttd">'.$o['name'].'</td>
                <td class="ttd">Internet Explorer 4.0</td>
                <td class="ttd">Win 95+</td>
                <td class="ttd">4</td>
                <td class="ttd">X</td>
            </tr>';
        }
        echo'
            
            </tbody>
        </table>
        
        ';
    }

    public function simpan(request $request){
        error_reporting(0);
        if (trim($request->kelas) == '') {$error[] = '- PILIH KELAS TUJUAN';}
        if (trim($request->tahun_ajaran) == '') {$error[] = '-PILIH TAHUN AJARAN TUJUAN';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae;font-size:12px"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{

        }
    }
}
