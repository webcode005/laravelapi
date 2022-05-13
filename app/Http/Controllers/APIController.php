<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Validator;

class APIController extends Controller
{
    //


        public function getUsers($id=NULL)
        {

            if(!empty($id))
            {
                $users = User::find($id);
                    return response()->json(["users"=>$users],200);
            }
            else 
            {
                $users = User::get();
                  return response()->json(["users"=>$users],200);      
            }

        }

        public function addUsers(Request $request)
        {
            //print_r($request->input());

            if($request->isMethod('post'))
            {
                $UserData = $request->input();
                
                // Simple API validation

                // if(empty($UserData["name"]) || empty($UserData["email"]) || empty($UserData["password"]))
                //   {
                //       $message = "Please Fill All Fields";
                //       return response()->json(["status"=>false,"message"=>$message],422);
                //   }

                // // Check email validation

                // if (!filter_var($UserData["email"], FILTER_VALIDATE_EMAIL)) 
                //   {
                //     $error_message = $UserData["email"]." is not a valid email address";                    
                //   } 
                  

                // // Check if User Email Already Exist

                // $userCount = User::where('email',$UserData["email"])->count();
             
                // if ($userCount > 0) 
                //   {
                //     $error_message = $UserData["email"]." already Exists!";                   
                //   } 

                // if(isset($error_message) && !empty($error_message))

                //   {
                //     return response()->json(["status"=>false,"message"=>$error_message],422); 
                //   }
                 

                // Advance API Validation

                $rules = [
                    "name" =>"required|regex:/^[\pL\s\-]+$/u",
                    "email" =>"required|email|unique:users",
                    "password" =>"required",
                ];

                $customMessages = [
                    "name.required" =>"Name is required",
                    "email.required" =>"Email is required",
                    "email.unique" =>"Email already Exists in database",
                    "password.required" =>"Password is required",
                ];
                
                $validator = Validator::make($UserData,$rules,$customMessages);

                if($validator->fails())

                  {
                    return response()->json($validator->errors(),422); 
                  }


                    $user = new User;
                    $user->name = $UserData['name'];
                    $user->email = $UserData['email'];
                    $user->password = bcrypt($UserData['password']);
                    $user->save();

                    return response()->json(["message"=>"Record Added Successfully!"],201); 

            }


        }

        public function addmultipleUsers(Request $request)
        {
            //print_r($request->input());           

            if($request->isMethod('post'))
            {
                
                $UserData = $request->input();

                //echo"<pre>"; print_r($UserData); die;

                   // Advance API Validation

                $rules = [
                    "users.*.name" =>"required|regex:/^[\pL\s\-]+$/u",
                    "users.*.email" =>"required|email|unique:users",
                    "users.*.password" =>"required",
                ];

                $customMessages = [
                    "users.*.name.required" =>"Name is required",
                    "users.*.email.required" =>"Email is required",
                    "users.*.email.unique" =>"Email already Exists in database",
                    "users.*.password.required" =>"Password is required",
                ];
                
                $validator = Validator::make($UserData,$rules,$customMessages);

                if($validator->fails())

                  {
                    return response()->json($validator->errors(),422); 
                  }

                foreach ($UserData["users"] as $key=>$value) 
                {

                    $user = new User;
                    $user->name = $value['name'];
                    $user->email = $value['email'];
                    $user->password = bcrypt($value['password']);
                    $user->save();
                }


                return response()->json(["message"=>"Record Added Successfully!"],201); 


            }


        }
        

        public function updateUserDetails(Request $request,$id)
        {           

            if($request->isMethod('put'))
            {
                $UserData = $request->input();
                //echo "<pre>"; print_r($UserData); die;
                
                $rules = [
                    "name" =>"required|regex:/^[\pL\s\-]+$/u",
                    "password" =>"required",
                ];

                $customMessages = [
                    "name.required" =>"Name is required",                   
                    "password.required" =>"Password is required",
                ];
                
                $validator = Validator::make($UserData,$rules,$customMessages);

                if($validator->fails())

                  {
                    return response()->json($validator->errors(),422); 
                  }

                
                // Update record
                User::where('id',$id)->update(['name'=>$UserData['name'],'password'=>bcrypt($UserData['password'])]);

                return response()->json(["message"=>"Record Updated Successfully!"],202);
                
            }

        }

        public function updateUserName(Request $request,$id)
        {           

            if($request->isMethod('patch'))
            {
                $UserData = $request->input();
                //echo "<pre>"; print_r($UserData); die;
                
                $rules = [
                    "name" =>"required|regex:/^[\pL\s\-]+$/u",
                    
                ];

                $customMessages = [
                    "name.required" =>"Name is required",                   
                 
                ];
                
                $validator = Validator::make($UserData,$rules,$customMessages);

                if($validator->fails())

                  {
                    return response()->json($validator->errors(),422); 
                  }

                
                // Update record
                User::where('id',$id)->update(['name'=>$UserData['name']]);

                return response()->json(["message"=>"Record Updated Successfully!"],202);
                
            }

        }

        
        public function deleteUser(Request $request,$id)
        {           

            if($request->isMethod('delete'))
            {             
                // Delete record
                User::where('id',$id)->delete();

                return response()->json(["message"=>"Record Deleted Successfully!"],202);
                
            }

        }

        
        public function deleteUserWithJson(Request $request)
        {           

            if($request->isMethod('delete'))
            {             
                // Delete record through json
                $UserData = $request->all();
                User::where('id',$UserData['id'])->delete();

                return response()->json(["message"=>"Record Deleted Successfully!"],202);
                
            }

        }

        
        public function deleteMultipleUser(Request $request,$ids)
        {           

            if($request->isMethod('delete'))
            {          
                $ids = explode(",",$ids) ;
                                // Delete record
                User::wherein('id',$ids)->delete();

                return response()->json(["message"=>"Record Deleted Successfully!"],202);
                
            }

        }

        
        public function deleteMultipleUserWithJson(Request $request)
        {           

            if($request->isMethod('delete'))
            {             
                // Delete record through json
                $UserData = $request->all();
                //print_r($UserData['ids']); die;

                foreach ($UserData['ids'] as $key => $value) {

                    User::where('id',$value)->delete();

                }
                

                return response()->json(["message"=>"Record Deleted Successfully!"],202);
                
            }

        }

}
