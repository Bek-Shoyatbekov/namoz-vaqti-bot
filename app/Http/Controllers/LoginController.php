<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\Api\TimeResource;
use App\Http\Resources\Api\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = [
            'email' => $request->login,
            'password' => $request->password
        ];

        if(auth()->attempt($credentials)){
            return redirect()->route("admin.index");
        }

        return redirect()->back()->with("incorrect", "Пароль или логин неправильные");
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("index");
    }

}

