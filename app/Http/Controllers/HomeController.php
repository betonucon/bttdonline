<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loogin;
use App\Pengumuman;
use App\User;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function waktu()
    {
        echo '<h4>'.date('d F Y').'</h4>';
        echo date('H:i:s');
    }

    public function index()
    {
        // $data=Vendor::all();
        // foreach($data as $o){
        //     $cek=User::where('username',$o['LIFNR'])->count();
        //     if($cek>0){

        //     }else{
        //         $ven            = New User;
        //         $ven->username     = $o['LIFNR'];
        //         $ven->email     = $o['email'];
        //         $ven->password     = Hash::make($o['LIFNR']);
        //         $ven->name     = $o['name'];
        //         $ven->role_id     = 7;
        //         $ven->save();
        //     }
        // }

        $menu='Home';
        $menu_detail=name();
        $data=Pengumuman::orderBy('id','Desc')->paginate(7);
        return view('home',compact('menu','menu_detail','data'));
    }
}
