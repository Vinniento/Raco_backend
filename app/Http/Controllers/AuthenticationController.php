<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use DB;
use Facade\FlareClient\Http\Response;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();
        try {
            if (!User::find($request->email)) {

                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->email = $request->email;
                $user->password = $request->password;
                $user->save();
                return response()->json([
                    'success' => 'User was created: ' . $user
                ]);
                //return $this->login($request);
            } else
                return response()->json([
                    'success' => 'Failed: user already exists'
                ]);
            // return response()->json(['registerData' => $request]);
        } catch (Exception $e) {
            return $e;
        }
    }
    public function login(Request $request)
    {
        $creds = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();
        if ($user != null) {
            return response()->json(['success' => 'valid']);
        } else {
            return response()->json(['success' => 'invalid'
            ]);
        }
    }
}
