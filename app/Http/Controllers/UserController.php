<?php
namespace App\Http\Controllers;
use App\UsedClasses\Clean;

use Illuminate\Http\Request as Requester;

use App\Http\Requests;
use Datatables;
use DB;
use Request;
use Session;
use App\User;
use DateTime;

class UserController extends Controller
{
    //
     public function viewuser()
    {

    	 $user = DB::table('users')
    	 		      ->get();
    	  return view('user.viewuser',['user' => $user]);
    }



	  public function adduser()
	    {

	    	
	    	  return view('user.adduser');
	    }

      public function addusersave()
    {

    	$inputs = Request::all();
    	
    	
    	//cleaning values

    	$CleanClass = new Clean();
        $name = $CleanClass->Check($inputs['name']);
        $email = $CleanClass->Check($inputs['email']);
        $tel = $CleanClass->Check($inputs['tel']);
        $category = $CleanClass->Check($inputs['category']);
        $location = $CleanClass->Check($inputs['location']);
        $country = $CleanClass->Check($inputs['country']);
        $token=time();
        $password=sha1("PASS1234");


		$now = new DateTime();

        //saving values
        $isSaved=DB::table('users')->insert(
		     array(
		            'name'     =>   $name, 
		            'email'   =>   $email,
		            'tel'   =>   $tel,
		            'category'   =>   $category,
		            'id'   =>   $token,
		            'password'   =>   $password,
                    'location'   =>   $location,
                    'country'   =>   $country,
		            'created_at'   =>   $now,
		            'updated_at'   =>   $now

		     )
		);

		//checking if data was saved
		if($isSaved){
			  session(['isSaved' => '1']);
		}else{
			 Session::forget('isSaved');
		}
        return redirect('/adduser');  
    }


 public function edituser($id)
    {
    	$CleanClass = new Clean();
        $id = $CleanClass->Check($id);
    	 $user = DB::table('users')
    	  			   ->where('id','=',$id)
    	 		       ->get();
    	  return view('user.edituser',['user' => $user]);
    }


       public function editusersave()
    {

    	$inputs = Request::all();
    	
    	
    	//cleaning values

    	$CleanClass = new Clean();
     	$name = $CleanClass->Check($inputs['name']);
        $email = $CleanClass->Check($inputs['email']);
        $tel = $CleanClass->Check($inputs['tel']);
        $category = $CleanClass->Check($inputs['category']);
        $location = $CleanClass->Check($inputs['location']);
        $country = $CleanClass->Check($inputs['country']);
        $status = $CleanClass->Check($inputs['status']);
        $id=$CleanClass->Check($inputs['id']);
        $now = new DateTime();

        //check if id exist
		$count = DB::table('users')
                        ->where('id','=',$id)
                        ->count();
        if($count>0)
        {
	        	 //updating values
        $isUpdated=DB::table('users')
		            ->where('id', $id)
		            ->update( 
						array(
		            'name'     =>   $name, 
		            'email'   =>   $email,
		            'tel'   =>   $tel,
		            'category'   =>   $category,
                    'location'   =>   $location,
                    'country'   =>   $country,
                    'status'   =>   $status,
		            'updated_at'   =>   $now

		   			  )
		            	);


		
	        return redirect('/viewuser/');  
        }           
       
    }


      public function deleteuser()
    {
    	
    	$inputs = Request::all();
    	//cleaning values

    	$CleanClass = new Clean();
        $id = $CleanClass->Check($inputs['id']);
    	 $user =DB::table('users')->where('id', $id)->delete();
    	
    	 //checking if deleted
    	 if($user){

    	 	$arr = array('success' => 1);
    	 	echo json_encode($arr);
    	 }else{
    	 	$arr = array('success' => 0);
    	 	echo json_encode($arr);
    	 }
    	 
    }

//API request 
     public function getuserdetails()
    {

        $inputs = Request::all();  

        //cleaning values

        $CleanClass = new Clean();
        $email = $CleanClass->Check($inputs['email']);
        $password = $CleanClass->Check(sha1($inputs['password']));

        //checking if user exist    
        $user_count = DB::table('users')
                             ->where([
                                    ['email', '=', $email],
                                    ['password', '=', $password]
                                    ])
                             ->count();
       
        if($user_count>0){

                //fetching user
        $user = DB::table('users')
                        ->where([
                                ['email', '=', $email],
                                ['password', '=', $password]
                                ])
                        ->get();

                //displaying in a json format
                $userArr = array();
                        foreach ($user as $userRow)
                        {
                            array_push( $userArr,array(
                                'id' => $userRow->id,
                                'name' => $userRow->name,
                                'email' => $userRow->email,
                                'tel' => $userRow->tel,
                                'category' => $userRow->category,
                                'location' => $userRow->location,
                                'country' => $userRow->country,
                                'status' => $userRow->status
                                ));
                           
                        }
                $data=array('success'=>0,
                            'message'=>'Data Fetched Successfully',
                            'products'=>$userArr);
                       
                 return json_encode($data);

        }else{
            $data=array('success'=>1,
                        'message'=>'Error Fetching Data');
           return $data;
        }
    }

}
