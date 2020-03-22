<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\MedicineRate;
use App\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    //

    public function patientRecords(){

        //$hospital = Patients::where('user_id', Auth::user()->id)->get();

        $patient = Patients::findOrFail(Auth::user()->id);

        $mHospital[] = json_decode($patient->favourite_hospitals);
        $countMhospitals = count($mHospital);
        $CountMedicine = MedicineRate::where('user_id', Auth::user()->id)->count('amount');
        $countHealthRate = $patient->health_rate;
        $countVisits = $patient->visits;

        return response()->json(['countVisits'=> $countVisits, 'countHealthRate'=>$countHealthRate, 'CountMedicine'=> $CountMedicine, 'countMhospitals'=> $countMhospitals]);


    }

    public function patientDetails(){

        $user = DB::table('users')
        ->join('patients', 'patients.user_id', '=','users.id')
        ->select('*')
        ->where('users.id', Auth::user()->id)
        ->get();

        return response('patientUserData', $user);


    }

}
