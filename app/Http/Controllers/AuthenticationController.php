<?php

namespace App\Http\Controllers;

use App\Training;
use App\User;
use Exception;
use Illuminate\Http\Request;
use DB;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Carbon;

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
                $player->isPlayer = true;
                $player->isCoach = false;
                $player->save();
                return response()->json([
                    'success' => 'Player added to the Team'
                ]);
            } else
                return response()->json([
                    'success' => 'Player with this Lastname already exists'
                ]);
        } catch (Exception $e) {
            return $e; //response()->json(['success' => $e]);
        }
    }

    public function getAllPlayers(){
        $user = User::where('isPlayer', true)->select('firstname', 'lastname')->get();
        return response()->json(
                // 'firstname' => $user->firstname, 'lastname' =>$user->lastname
                    $user
        );
    }

    public function getuser(Request $request){
        $user = User::where('email', $request->email)->select('firstname', 'lastname', 'email')->first();
        return response()->json([
                    'firstname' => $user->firstname, 'lastname' =>$user->lastname, 'email'=>$user->email
        ]);
    }

    public function addTraining(Request $request)
    {
        $training = new Training();
        try {
            if (!Training::find($request->date)) {
                $training->date =$request->date;
                $training->time =  $request->time;
                $training->duration = $request->duration;
                $training->save();
                return response()->json([
                    'success' => 'Training added'
                ]);
            } else
                return response()->json([
                    'success' => 'Training with this date exists already'
                ]);
        } catch (Exception $e) {
            return $e; //response()->json(['success' => $e]);
        }
    }

    public function getalltrainings(){
        $trainings = Training::select('date', 'time')->get();
        return response()->json(
                    $trainings
        );
    }
}
