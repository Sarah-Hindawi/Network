<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use \Datetime;
use Illuminate\Support\Facades\Hash;


class UpdateProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $privacy = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', Auth::user()->email)->get()->toArray()), true)[0]['private'];
        if ($privacy) {
            $privacy = "checked";
        }
        else{
            $privacy = "";
        }

        $about = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', Auth::user()->email)->get()->toArray()), true)[0]['about'];

        return view('settings', ["email" => Auth::user()->email, "privacy" => $privacy, "about" => $about]);

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
        } else {
            DB::table('users')->where('email', 'LIKE', $email)->update(array('private' => false));

        }

        if (isset($request->name)) {
            DB::table('users')->where('email', 'LIKE', $email)->update(array('name' => $_POST['name']));
        }

        if (isset($request->password)) {
            DB::table('users')->where('email', 'LIKE', $email)->update(array('password' => Hash::make($_POST['password'])));
        }
        return redirect('/home');
    }


    public function deleteAccount()
    {
        $email = Auth::user()->email;

        $friends = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $email)->get()->toArray()), true)[0]['friends'];

        if (!is_null($friends) and $friends != "") {
            $friends = array_unique(explode("||", $friends));

            foreach ($friends as $user) {
                $this->removeFriends($email, $user);
            }
        }

        DB::table('profiles')->where('email', 'LIKE', $email )->delete();
        DB::table('users')->where('email', 'LIKE', $email)->delete();

        Auth::logout();
        return view('welcome');
    }

    public function removeFriends($email, $friendEmail){

        $userFriends = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $email)->get()->toArray()), true)[0]['friends'];
        $userFriends = explode("||", $userFriends);

        //remove the email address of the removed user from the list of friends
        $userFriends = array_diff($userFriends, array($friendEmail));

        $userFriends = implode("||", $userFriends);

        DB::table('users')->where('email', 'LIKE', $email)->update(array('friends' => $userFriends));


        //removing friend from the other end
        $userFriends = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $friendEmail)->get()->toArray()), true)[0]['friends'];
        $userFriends = explode("||", $userFriends);
        $userFriends = array_diff($userFriends, array($email));
        $userFriends = implode("||", $userFriends);

        DB::table('users')->where('email', 'LIKE', $friendEmail)->update(array('friends' => $userFriends));
    }
}
