<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request as Requester;
use App\Http\Requests;
use App\Http\Requests\UploadRequest;
use File;
use Datatables;
use DB;
use Request;
use Session;
use App\User;
use PDF;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('home');
    }

    public function uploadimage(UploadRequest $request)
    {

          	if($request->hasFile('photo') ) {

          	    $token="temp.png";
                $request->photo->move(base_path('public/uploads'), $token);

                return redirect('gotohome');
         			 }else{
         			 	echo "No file selected for upload";die;
         			 }
    }

    public function gotohome()
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

           return view('home',['files'=>$adverts]);
   }
   public function genpdfinalimage()
   {
     $inputs = Request::all();
     $Papertype=$inputs['papertype'];
     $CodeType=$inputs['codetype'];
     $Number=$inputs['quantity'];
     $Orientation=$inputs['orientation'];
     $font='';
     $content='';
     $isImage=$inputs['isImage'];
     $code_align=$inputs['code_align'];
     $codecolor=$inputs['codecolor'];
     $backgroundCodeColor=$inputs['backgroundCodeColor'];
     $csvdata="";
     $codeHeight="50";
     $codeWidth="50";

     $code_x="0";
     $code_y="5";

     if(isset($inputs['code_x'])){
       $code_x=$inputs['code_x'];
       $code_y=$inputs['code_y'];
     }

     if(isset($inputs['codeHeight'])){
       $codeHeight=$inputs['codeHeight'];
       $codeWidth=$inputs['codeWidth'];
     }

     if(isset($inputs['csvdata'])){
              $csvdata=$inputs['csvdata'];
     }
     $pdfbatchcount=500;
     $preview=0;
     $this->GenPdf($CodeType,$code_align,$Number,$Orientation,$Papertype,$font,$content,$pdfbatchcount,$isImage,$preview,$codecolor,$csvdata,$backgroundCodeColor,$codeHeight,$codeWidth,$code_x,$code_y);
     return;
   }

    public function genpdffinal()
    {
      $inputs = Request::all();
      $Papertype=$inputs['papertype'];
      $CodeType=$inputs['codetype'];
      $Number=$inputs['quantity'];
      $Orientation=$inputs['orientation'];
      $font='';
      $content=$inputs['htmldata'];
      $isImage=$inputs['isImage'];
      $code_align=$inputs['code_align'];
      $codecolor=$inputs['codecolor'];
      $backgroundCodeColor=$inputs['backgroundCodeColor'];
      $csvdata="";
      $codeHeight="50";
      $codeWidth="50";

      $code_x="0";
      $code_y="5";

      if(isset($inputs['code_x'])){
        $code_x=$inputs['code_x'];
        $code_y=$inputs['code_y'];
      }

      if(isset($inputs['codeHeight'])){
        $codeHeight=$inputs['codeHeight'];
        $codeWidth=$inputs['codeWidth'];
      }
      if(isset($inputs['csvdata'])){
          $csvdata=$inputs['csvdata'];
      }

      //changing batch no
      $pdfbatchcount=500;
      if(isset($inputs['noPerBatch'])){
        $pdfbatchcount=$inputs['noPerBatch'];
      }

      $preview=0;
      $this->GenPdf($CodeType,$code_align,$Number,$Orientation,$Papertype,$font,$content,$pdfbatchcount,$isImage,$preview,$codecolor,$csvdata,$backgroundCodeColor,$codeHeight,$codeWidth,$code_x,$code_y);
      //  echo "string";die;
      return;
    }
    public function genpdfpreview()
    {

      $inputs = Request::all();
      $Papertype=$inputs['papertype'];
      $CodeType=$inputs['codetype'];
      $Number=$inputs['quantity'];

      $Orientation=$inputs['orientation'];
      $font='';
      $content=$inputs['htmldata'];
      $isImage=$inputs['isImage'];
      $code_align=$inputs['code_align'];
      $codecolor=$inputs['codecolor'];
      $backgroundCodeColor=array(0,0,0);
      if(isset($inputs['backgroundCodeColor'])){
        $backgroundCodeColor=$inputs['backgroundCodeColor'];
      }


      $csvdata="";
      $codeHeight="50";
      $codeWidth="50";
      $code_x="0";
      $code_y="5";

      if(isset($inputs['code_x'])){
        $code_x=$inputs['code_x'];
        $code_y=$inputs['code_y'];
      }

      if(isset($inputs['codeHeight'])){
        $codeHeight=$inputs['codeHeight'];
        $codeWidth=$inputs['codeWidth'];
      }



      if(isset($inputs['csvdata'])){
          $csvdata=$inputs['csvdata'];
      }


      $preview=1;


      $pdfbatchcount=2;
      //generate pdf
      $batch=$this->GenPdf($CodeType,$code_align,$Number,$Orientation,$Papertype,$font,$content,$pdfbatchcount,$isImage,$preview,$codecolor,$csvdata,$backgroundCodeColor,$codeHeight,$codeWidth,$code_x,$code_y);
      $arr = array('batch' => $batch);
    	 	echo json_encode($arr);
      return;
    }



    public function GenPdf($CodeType,$code_align,$Number,$Orientation,$Papertype,$font,$content,$pdfbatchcount,$isImage,$preview,$codecolor,$csvdata,$backgroundCodeColor,$codeHeight,$codeWidth,$code_x,$code_y){

        $style = array(
           'position' => $code_align,
           'align' => 'R',
           'stretch' => false,
           'fitwidth' => true,
           'cellfitalign' => '',
           'border' => true,
           'hpadding' => 'auto',
           'vpadding' => 'auto',
           'fgcolor' => array(0,0,0),
           'bgcolor' => $backgroundCodeColor,//array(255,255,255),//false
           'text' => true,
           'font' => 'helvetica',
           'fontsize' => 8,
           'stretchtext' => 4,
            'fgcolor' => $codecolor
        );


        $batch=time();
        $j=0;
        $batchcount=0;
        for ($i = 0; $i < $Number; $i++) {
             $time=$batch+$i;
             PDF::SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
             PDF::AddPage($Orientation, $Papertype);
             //checking if we need to add bar code
             $this->getcode($CodeType,$style,$time,$codeHeight,$codeWidth,$code_x,$code_y);

             if($isImage==1){
                 //when is image
                 $bMargin = PDF::getBreakMargin();
              //  PDF::SetMargins(PDF_MARGIN_LEFT, -100, PDF_MARGIN_RIGHT,false);
                 $auto_page_break = PDF::getAutoPageBreak();
                 PDF::SetAutoPageBreak(true, -10);
                 $img_file = public_path('/uploads/temp.png');
                 //PDF::SetXY(700, 700);
                 PDF::Image($img_file, 0, 0,0, 0, '', '', '', false, 300, '', false, false, 0);
                 $this->getcode($CodeType,$style,$time,$codeHeight,$codeWidth,$code_x,$code_y);


             }else{
               //when is html
               $keyToCompare=explode(',',$csvdata[0][0]);
               $V=$i+1;
               $newKeysValFromCsvData=explode(',',$csvdata[$V][0]);
               $newcontent=$content;

               for($k=0;$k<sizeof($newKeysValFromCsvData);$k++){
                          $keyVal=$keyToCompare[$k];
                          $newcontent=str_replace(":".$keyVal,$newKeysValFromCsvData[$k],$newcontent);
                     }

              PDF::writeHTML($newcontent, true, false, true, false, '');

             }

             //check if pdf page is too much to Fit

             $j+=1;
             if($j==$pdfbatchcount)
             {

               //save batch
               $batchcount+=1;
               $btcName='export\BATCH-' . $batch .'-'.$batchcount. '.pdf';
               if($preview==1)
               {
                 $btcName='temp\BATCH-preview-1'. '.pdf';
               }

               PDF::Output(public_path($btcName), 'F');
               PDF::reset();
               $j=0;

               if($preview==1)
               {
                 return $btcName;
               }

             }

           }

           $btcName='export\BATCH-' . $batch .'-1'. '.pdf';
           if($preview==1)
           {
             $btcName='temp\BATCH-preview-1'. '.pdf';
           }


           if($Number <=$pdfbatchcount){

               PDF::Output(public_path($btcName), 'F');
               PDF::reset();

               return $btcName;
           }else{


             PDF::Output(public_path($btcName), 'F');
             PDF::reset();

           }


    }
    public function getcode($CodeType,$style,$time,$codeHeight,$codeWidth,$code_x,$code_y)
    {

      if($CodeType!='')
      {
          if($CodeType=='QR')
          {
            //add QR Code
             //h,w 50,50
            //x,y=0,5
            PDF::write2DBarcode($time, 'QRCODE,H', $code_x,$code_y, $codeHeight,$codeWidth, $style, 'N');
            PDF::Ln();
          }else
          {
             //add Bar Code
             //h,w 18,0.2
             //x,y=0,5
             PDF::write1DBarcode('000'.$time, 'S25', $code_x,$code_y, '', $codeHeight, $codeWidth, $style, 'N');
             PDF::Ln();

          }
      }
    }
}
