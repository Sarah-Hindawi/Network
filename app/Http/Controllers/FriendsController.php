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

        $userFriends = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', "%" . $email . "%")->get()->toArray()), true)[0]['friends'];
        $userFriends = explode("||", $userFriends);

        return view('friends', ['friends' => $userFriends]);
    }

    public function addFriend()
    {

        $email = Auth::user()->email;
        $friendEmail = $_POST['email'];

        $userFriends = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', "%" . $email . "%")->get()->toArray()), true)[0]['friendRequests'];

        if (is_null($userFriends)) {
            $userFriends = $friendEmail;

        } else {

            $userFriends .= "||" . $friendEmail;
        }

        DB::table('users')->where('email', 'LIKE', "%" . $email . "%")->update(array('friendRequests' => $userFriends));

        $userId = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', "%" . $friendEmail . "%")->get()->toArray()), true)[0]['id'];

        return redirect('/profile?id=' . $userId);
    }

    public function removeFriend()
    {
        $email = Auth::user()->email;
        $friendEmail = $_POST['email'];

        $userFriends = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', "%" . $email . "%")->get()->toArray()), true)[0]['friends'];
        $userFriends = explode("||", $userFriends);

        //remove the email address of the removed user from the list of friends
        $userFriends = array_diff($userFriends, array($friendEmail));

        $userFriends = implode("||", $userFriends);

        DB::table('users')->where('email', 'LIKE', "%" . $email . "%")->update(array('friends' => $userFriends));

        $userId = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', "%" . $friendEmail . "%")->get()->toArray()), true)[0]['id'];

        return redirect('/profile?id=' . $userId);
    }

    public function displayFriendRequests()
    {
        $email = Auth::user()->email;

        $userFriends = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', "%" . $email . "%")->get()->toArray()), true)[0]['friendRequests'];
        $userFriends = explode("||", $userFriends);

    }

    public function acceptFriend()
    {
    }

    public function removeFriendRequests()
    {
    }

}
