<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(AdminRequest $request)
    {
        $admin = Admin::where('username',$request->username)->first();
         if(!$admin)
         return response()->json("Credentials is wrong",401);
        // return Hash::check($request->password, $admin->password);
        if(Hash::check($request->password, $admin->password))
        {
            $token=$admin->createToken('myauth')->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message'=>'welcome',
                    'token' => $token
                ],200);




        }
    else
    {
        return response()->json("Credentials is wrong",401);
    }
    }
}
