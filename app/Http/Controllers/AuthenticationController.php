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
                $user->isCoach = true;
                $user->save();
                return response()->json([
                    'success' => 'Account created'
                ]);
                //return $this->login($request);
            } else
                return response()->json([
                    'success' => 'Email already in use'
                ]);
            // return response()->json(['registerData' => $request]);
        } catch (Exception $e) {
            return $e;
        }
    }
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)
            ->where('password', $request->password)
            ->first();
        if ($user != null) {
            return response()->json(['success' => 'valid']);
        } else {
            return response()->json(['success' => 'invalid']);
        }
    }

    public function addplayer(Request $request)
    {
        $player = new User();
        try {
            if (!User::find($request->lastname)) {
                $player->firstname = $request->firstname;
                $player->lastname = $request->lastname;
                $player->email = $request->email;
                $player->save();
                return response()->json([
                    'success' => 'Player added to the Team'
                ]);
            } else
                return response()->json([
                    'success' => 'Player with this Lastname already exists'
                ]);
        } catch (Exception $e) {
            return response()->json(['success' => $e]);
        }
    }
}
