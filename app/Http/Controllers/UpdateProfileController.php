<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use \Datetime;


class UpdateProfileController extends Controller
{
    public function createProfileImg(){
        return view('profileImage');
    }

    public function storeProfileImg(Request $request){

        $email = Auth::user()->email;

        $request->validate([
            'image' => 'image|required',
        ]);


        $name = $request->image->getClientOriginalName();
        $date = new DateTime("now", new \DateTimeZone('America/Halifax'));
        $imageName = $date->format('d-m-Y@H-i-s') . '-' . $email . '-' . $name;
        $request->image->move(public_path('images'), $imageName);


        DB::table('users')->where('email', 'LIKE', $email)->update(array('image' => $imageName));

        return view('home');
    }

    public function updateAbout(){

        $email = Auth::user()->email;

        DB::table('users')->where('email', 'LIKE', $email)->update(array('about' => $_POST['about']));

        return view('home');
    }

    public function updatePrivacy(){

        $email = Auth::user()->email;
        DB::table('users')->where('email', 'LIKE', $email)->update(array('private' => $_POST['privacy']));
        return view('home');
    }

    public function updateUserName(){

        $email = Auth::user()->email;
        DB::table('users')->where('email', 'LIKE', $email)->update(array('name' => $_POST['name']));
        return view('home');
    }



}
