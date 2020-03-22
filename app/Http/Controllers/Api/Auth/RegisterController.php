<?php

namespace App\Http\Controllers\Api\Auth;

use App\Doctors;
use App\Http\Controllers\Controller;
use App\Patients;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;

class RegisterController extends Controller
{

    use IssueTokenTrait;

    private $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }

    public function register(Request $request){


        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed'
        ]);

        //dd($request->all());

        $user = User::create([

            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make($request->password)

        ]);



       return $this->issueToken($request,'password');
    }

    public function registerDoctor(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
            'doctor_stamp' => 'required',
            'phone_number' => 'required'
        ]);


        if(!Auth::check()){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = "doctor";
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->save();
        }

        $doctor = new Doctors();
        $doctor->user_id = $user->id;
        $doctor->hospital_id = $request->hospital_id;
        $doctor->doctor_stamp = $request->doctor_stamp;
        $doctor->doctor_speciality = $request->doctor_speciality;

        if($request->hasfile('image')){
            $photo = $request->image;
        $doctor->uploads = $photo->store('uploads/hop/logo');
        }

        $doctor->work_phone = $request->work_phone;
        $doctor->work_time = $request->work_time;

        if(!$doctor->save()){

            $user->delete();

            return response()->json(['error'=>"something went wrong"]);

        }

        return $this->issueToken($request,'password');

    }

    public function registerPatient(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
            'phone_number' => 'required'
        ]);


        if(!Auth::check()){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = "patient";
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->save();
        }

        $patient = new Patients();
        $patient->user_id = $user->id;
        // $patient->lang = $request->lang;
        // $patient->long = $request->long;
        if($request->hasFile("image")){
            $photo = $request->image;
        $patient->uploads = $photo->store('uploads/hop/logo');

        }
        if(!$patient->save()){

            $user->delete();
            return response()->json(['error', "something went wrong"]);

        }

        return $this->issueToken($request,'password');

    }

}
