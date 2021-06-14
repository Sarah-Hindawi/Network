<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class FriendsController extends Controller
{
    public function create()
    {
        $email = Auth::user()->email;

        DB::table('users')->where('email', 'LIKE', "%" . $email . "%")->get()->toArray();
//        $userInfo = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', "%" . $email . "%")->get()->toArray()), true);

        return view('friends');
    }
}
