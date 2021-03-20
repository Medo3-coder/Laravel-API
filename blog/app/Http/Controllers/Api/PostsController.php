<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

use App\Post ;




class PostsController extends Controller
{

    use ApiResponseTrait;

   public function index()
   {
     


                                 
    $posts = PostResource::collection(Post::paginate($this->paginateNumber));
                    
     return $this->apiResponse( $posts);  // contant , status

   }

   public function show($id)
   {
       $post =Post::find($id) ;
       if($post)
       {
        return $this->returnSuccessPost($post);
       }
       else
       {
        return $this->notFoundResponse();
       }


       
   }



   public function delete($id)
   {
       $post =Post::find($id) ;
       if($post)
       {
         $post->delete();
        return $this->DeletedResponse();
       }
       else
       {
        return $this->notFoundResponse();
       }


       
   }



    public function store(Request $request)
   {

    $validation = $this->validation($request);

    if($validation instanceof response)
    {
      return $validation ;
    }


     $post = Post::create( $request->all());
     if($post)
     {
      return $this->createdResponse( new PostResource($post));
     }
     else{
      return $this->notFoundResponse();
     }
    


  }

  public function update($id , Request $request )
  {

    
    $validation = $this->validation($request);

    if($validation instanceof response)
    {
      return $validation ;
    }


/*************************** */

    $post =Post::find($id) ;  //select the post 

    if(!$post)
      {
        return $this->notFoundResponse();     //if empty post return not found response
       }


       $post->update($request->all());   // update the post 



     if($post)
     {                          
       return $this->returnSuccessPost($post);
     }
     
      return $this->unknownError();
    
  }


  public function validation($request )
  {

    return $this->ApiValidate($request , [
    

      'title' => 'required',
      'body'  => 'required'
    ]);
  }



  public function returnSuccessPost($post)
  {
    return $this->apiResponse(new PostResource($post));
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
