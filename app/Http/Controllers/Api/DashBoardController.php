<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    //

    public function index(){



    }

    public function patientDetails(){

        $user = DB::table('users')
        ->join('patients', 'patients.id', Auth::user()->id)
        ->select('*')
        ->where('id', Auth::user()->id)
        ->get();

        return response('patientUserData', $user);


    }

}
