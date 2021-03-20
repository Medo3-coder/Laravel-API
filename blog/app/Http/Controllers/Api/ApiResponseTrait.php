<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
trait ApiResponseTrait {


public $paginateNumber = 10 ;


    public function apiResponse($data = null , $error = null , $code = 200)
    {

        $array =
        [
            'data'    => $data ,
            'status'  => in_array( $code , $this->successCode())? true : false ,
            'error'   => $error
        ];

        return response($array, $code);
    }


    public function successCode()
    {
        return[
                 200 , 201 , 202              // 200 OK : success 
                                              // 201 CREATED : successfully added data 
                                              //Accepted 202. ...
        ];
    }
    public function createdResponse($data)
   {
    return $this->apiResponse( $data , null , 201  );
   }
    


    public function DeletedResponse()
    {
        return $this->apiResponse(true , ' post is deleted ' , 200);
    }



    public function notFoundResponse()
    {
        return $this->apiResponse(null , 'we not found ' , 404);
    }


    public function ApiValidate($request , $array)
    {

        $validate = Validator::make($request->all() , $array);
      
          if($validate->fails())
          {
            return $this->apiResponse(null , $validate->errors() , 442);
          }
    }


    public function unknownError()
    {
        return $this->apiResponse(null , 'unknown error ' , 520);
    } 


    /*
     every api the response must be like this    
     

     [
         'data'  => هنا هيكون في الداتا
         'status'=> true or false 
         'error' => 
     ]
   
   
   */



}