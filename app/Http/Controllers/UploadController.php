<?php

namespace App\Http\Controllers;
use Storage;
use App\Filelainnya;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index(request $request){
        $data=Storage::disk('google')->allFiles();
        // dd($data);
        return view('upload');
    }
    public function testuploadex(request $request){
        
        $image = $request->file('file');
        $imageFileName =date('dmYhis').'.'. $image->getClientOriginalExtension();
        
        $filePath =$imageFileName;
        $file = \Storage::disk('google');
        if($file->put($filePath, file_get_contents($image))){
            echo $file->getName($imageFileName);
        }else{
            echo'gagal';
        }
    }

    public function testupload(request $request){
        
        $image = $request->file('file');
        $imageFileName ='20210806075018.' . $image->getClientOriginalExtension();
        
        $filePath =$imageFileName;
        $file = \Storage::disk('google');
        if($file->put($filePath, file_get_contents($image))){
            echo linkdrive($imageFileName);
        }else{
            echo'gagal';
        }
    }
}
