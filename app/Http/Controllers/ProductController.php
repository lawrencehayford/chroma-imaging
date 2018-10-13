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

class ProductController extends Controller
{
    //product controller
	
      public function addproduct()
    {
        return view('product.addproduct');
    }

      public function saveproduct()
    {

    	$inputs = Request::all();
    	
    	
    	//cleaning values

    	$CleanClass = new Clean();
        $productname = $CleanClass->Check($inputs['productname']);
        $category = $CleanClass->Check($inputs['category']);
        $price = $CleanClass->Check($inputs['price']);
        $quantity = $CleanClass->Check($inputs['quantity']);
        $description = $CleanClass->Check($inputs['description']);
        $token=time();

        //saving values
        $isSaved=DB::table('product')->insert(
		     array(
		            'productname'     =>   $productname, 
		            'category'   =>   $category,
		            'price'   =>   $price,
		            'quantity'   =>   $quantity,
		            'description'   =>   $description,
		            'id'   =>   $token

		     )
		);

		//checking if data was saved
		if($isSaved){
			  session(['isSaved' => '1']);
		}else{
			 Session::forget('isSaved');
		}
        return redirect('/addproduct');  
    }


    public function viewproduct()
    {
    	 $product = DB::table('product')
    	 		      ->get();
    	  return view('product.viewproduct',['product' => $product]);
    }

     public function deleteproduct()
    {
    	
    	$inputs = Request::all();
    	//cleaning values

    	$CleanClass = new Clean();
        $id = $CleanClass->Check($inputs['id']);
    	 $product =DB::table('product')->where('id', $id)->delete();
    	
    	 //checking if deleted
    	 if($product){

    	 	$arr = array('success' => 1);
    	 	echo json_encode($arr);
    	 }else{
    	 	$arr = array('success' => 0);
    	 	echo json_encode($arr);
    	 }
    	 
    }

    public function editproduct($id)
    {
    	$CleanClass = new Clean();
        $id = $CleanClass->Check($id);
    	 $product = DB::table('product')
    	  			   ->where('id','=',$id)
    	 		       ->get();
    	  return view('product.editproduct',['product' => $product]);
    }



      public function saveeditproduct()
    {

    	$inputs = Request::all();
    	
    	
    	//cleaning values

    	$CleanClass = new Clean();
        $productname = $CleanClass->Check($inputs['productname']);
        $category = $CleanClass->Check($inputs['category']);
        $price = $CleanClass->Check($inputs['price']);
        $quantity = $CleanClass->Check($inputs['quantity']);
        $description = $CleanClass->Check($inputs['description']);
        $id=$CleanClass->Check($inputs['id']);

        //check if id exist
		$count = DB::table('product')
                        ->where('id','=',$id)
                        ->count();
        if($count>0)
        {
	        	 //updating values
        $isUpdated=DB::table('product')
		            ->where('id', $id)
		            ->update( array(
					            'productname'     =>   $productname, 
					            'category'   =>   $category,
					            'price'   =>   $price,
					            'quantity'   =>   $quantity,
					            'description'   =>   $description,

					     ));


		
	        return redirect('/viewproduct/');  
        }           
       
    }

//API request
    public function getproductlist()
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

                //fetching product
                $product = DB::table('product')
                      ->get();

                //displaying in a json format
                $productArr = array();
                        foreach ($product as $productRow)
                        {
                            array_push( $productArr,array(
                                'id' => $productRow->id,
                                'productname' => $productRow->productname,
                                'category' => $productRow->category,
                                'price' => $productRow->price,
                                'quantity' => $productRow->quantity,
                                'description' => $productRow->description
                                ));
                           
                        }
                $data=array('success'=>0,
                            'message'=>'Data Fetched Successfully',
                            'products'=>$productArr);
                       
                 return json_encode($data);

        }else{
            $data=array('success'=>1,
                        'message'=>'Error Fetching Data');
           return $data;
        }
    }
}
