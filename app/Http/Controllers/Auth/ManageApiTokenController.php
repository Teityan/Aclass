<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ManageApiTokenController extends Controller
{
    public function index(){
        $token =  Auth::user()->api_token;
        return view('pages.others.token',['token'=>$token]);
    }

    public function change(Request $request){
        $user = Auth::user();
        $user->api_token = Str::random(60);
        $user->save();
        return redirect()->back()->with(['result' => 'success', 'message' => '新しいトークンを発行しました。']);
    }
}
