<?php

namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
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
            'password' => bcrypt(request('password'))

        ]);


       return $this->issueToken($request,'password');
    }

}
