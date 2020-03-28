<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Patients;

class PatientController extends Controller
{
    //

    public function saveUserLocation(Reqquest $request) {

        $user = Patients::findOrFail(Auth::user()->id);
        $user->lang = $request->lang;
        $user->long = $request->long;

        if($user->save()){
            return response()->json(['message' => "User location is updated"]);
        }else {
            return response()->json(['message' => "something went wrong"]);
        }

    }

}
