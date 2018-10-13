<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use File;


class AdvertController extends Controller
{
    //
    public function uploadadvert()
    {
     $adverts = [];
     $files = File::allFiles('uploads');
     foreach($files as $path)
    {
       
        $adverts[] = [
                        'src'=>asset('uploads/'.pathinfo($path)['basename']),
                        'fileName'=>pathinfo($path)['basename']
                        
                        
                        ];
    }

    //var_dump($adverts); die;
        
        return view('advert.uploadadvert',['files'=>$adverts]);
    }


     public function saveadvert(UploadRequest $request)
    {
        $destinationPath=public_path('upload');

        if( $request->hasFile('photo') ) {
            $token=time()."png";
            $request->photo->move(base_path('public/uploads'), $token);
                  echo "done";
             }else{
                echo "No file selected for upload";die;
             }
        
 
    }

    public function deleteadvert()
    {
        
    }

    public function load()
    {
        
    }
}
