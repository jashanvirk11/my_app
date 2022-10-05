<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getdata()
    {
        $user = User::all();
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);
        $data =$user->delete();
        if($data){
            return "Data has been deleted ";
        }
        else{
            return "Data hasnot  been deleted ";
        }
        
    }

    public function update(Request $req)
    {
        
        $user = User::find($req->id);
  
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = $req->password;
        $result = $user->save();

        if($result){
            return "updated Successfully";
        }
        else{
            return "data does not Successfully";
        }
    }
 
        public function test(Request $request){
        $rules  = array(
            "name"=>'required'
        );
        
        $validator = Validator::make($request->all(),$rules);
        
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make( $request->password);
        $user->save();
        if($user->save()){
            return response()->json([
                'status' => true,
                'message' => "data have been saved successfully!",
            ], 200);
        }
        else{
            return response()->json([
                'status' => true,
                'message' => "operation failed!",
            ], 200);
        }
        }

        }


    public function search($searchkeyword){
        $user = User::where('name','like',"%".$searchkeyword."%")->get();
        return $user;
    }
 
    public function getdatawithid($id)
    {
        $user = User::find($id);
        return $user;
    }  
    
    public function signup(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make( $request->password);
        $user->save();
        return response()->json([
            'status' => true,
            'message' => "User created successfully!",
        ], 200);
    }

    public function signin(Request $request){

        $user = User::where('email',$request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }
    
         $token = $user->createToken('my-app-token')->plainTextToken;
    
        $response = [
            'user' => $user,
            'token' => $token
        ];
    
         return response($response, 201);
             }
        
 }

