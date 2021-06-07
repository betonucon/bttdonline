<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loogin;
use App\Pengumuman;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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

    public function index(request $request)
    {
        if(Auth::user()['role_id']==7){
            $menu='Home';
            $menu_detail=name();
            $data=Pengumuman::orderBy('id','Desc')->paginate(7);
            return view('home',compact('menu','menu_detail','data'));
        }else{
            $menu='Home';
            $menu_detail=name();
            if($request->tahun==''){
                $tahun=date('Y');
            }else{
                $tahun=$request->tahun;
            }
            // dd($tahun);
            $data=Pengumuman::orderBy('id','Desc')->paginate(7);
            return view('home_lokal',compact('menu','menu_detail','data','tahun'));
        }
        
    }
}
