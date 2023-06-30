<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class authMobileController extends Controller
{
    //
    public function login(Request $request){
        try{
            
            $username = User::where('username',$request->username)->first();
            if($username){
                $password = User::where('username',$request->username)->where('password',$request->password)->first();
                if($password){
                    return response()->json(['status'=>true,'data'=>$password]);
                }else{
                    return response()->json(['status'=>false,'data'=>[],'message'=>'password tidak cocok']);
                }
            }else{
                return response()->json(['status'=>false,'data'=>[],'message'=>'username tidak di temukan']);
            }
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }
}
