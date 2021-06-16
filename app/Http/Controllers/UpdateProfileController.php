<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use \Datetime;


class UpdateProfileController extends Controller
{
    public function create()
    {
        return view('settings', ["email" => Auth::user()->email]);

    }

    public function createProfileImg()
    {
        return view('profileImage');
    }

    public function storeProfileImg(Request $request)
    {

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

    public function updateSettings(Request $request)
    {

        $email = Auth::user()->email;

        if (isset($request->about)) {
            DB::table('users')->where('email', 'LIKE', $email)->update(array('about' => $_POST['about']));
        }

        if (isset($request->privacy)) {
            DB::table('users')->where('email', 'LIKE', $email)->update(array('private' => true));
        }

        if (isset($request->name)) {
            DB::table('users')->where('email', 'LIKE', $email)->update(array('name' => $_POST['name']));
        }

        if (isset($request->password)) {
            DB::table('users')->where('email', 'LIKE', $email)->update(array('password' => $_POST['password']));
        }
        return redirect('/home');
    }


    public function deleteAccount()
    {
    }


}
