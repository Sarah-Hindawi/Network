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

        $userFriends = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $email)->get()->toArray()), true)[0]['friends'];
        $userFriends = explode("||", $userFriends);

        return view('friends', ['friends' => $userFriends]);
    }

    public function addFriend()
    {
        $email = Auth::user()->email;
        $friendEmail = $_POST['email'];

        $friendReqs = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $friendEmail)->get()->toArray()), true)[0]['friendRequests'];

        if (is_null($friendReqs)) {
            $friendReqs = $email;

        } else {
            $friendReqs .= "||" . $email;
        }

        DB::table('users')->where('email', 'LIKE', $friendEmail)->update(array('friendRequests' => $friendReqs));

        $userId = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $friendEmail)->get()->toArray()), true)[0]['id'];

        return redirect('/profile?id=' . $userId);
    }

    public function removeFriend()
    {
        $email = Auth::user()->email;
        $friendEmail = $_POST['email'];

        $userFriends = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $email)->get()->toArray()), true)[0]['friends'];
        $userFriends = explode("||", $userFriends);

        //remove the email address of the removed user from the list of friends
        $userFriends = array_diff($userFriends, array($friendEmail));

        $userFriends = implode("||", $userFriends);

        DB::table('users')->where('email', 'LIKE', $email)->update(array('friends' => $userFriends));

        $userId = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $friendEmail)->get()->toArray()), true)[0]['id'];

        return redirect('/profile?id=' . $userId);
    }

    public function displayFriendRequests()
    {
        $email = Auth::user()->email;

        $users = json_decode(json_encode(DB::table('users')->where('email', 'LIKE',$email)->get()->toArray()), true)[0]['friendRequests'];
        $users = array_unique(explode("||", $users));

        $requestsInfo = [];

        foreach ($users as $user) {
            $req = [];
            $userInfo = json_decode(json_encode(DB::table('users')->where('email', 'LIKE',$user)->get()->toArray()), true)[0];
            $req[0] = $userInfo['name'];
            $req[1] = $userInfo['image'];
            $req[2] = $userInfo['id'];
            $requestsInfo[] = $req;
        }

        return view('friendRequests', ['requests' => $requestsInfo]);
    }

    public function acceptFriend()
    {
        $email = Auth::user()->email;
        $friendEmail = $_POST['email'];

        $userFriends = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $email)->get()->toArray()), true)[0]['friends'];

        if (is_null($userFriends)) {
            $userFriends = $friendEmail;

        } else {

            $userFriends .= "||" . $friendEmail;
        }

        DB::table('users')->where('email', 'LIKE', $email)->update(array('friendRequests' => $userFriends));

        $friendReqs = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $email)->get()->toArray()), true)[0]['friendRequests'];
        $friendReqs = explode("||", $friendReqs);

        $friendReqs = array_diff($friendReqs, array($friendEmail));

        $friendReqs = implode("||", $friendReqs);

        DB::table('users')->where('email', 'LIKE', $email)->update(array('friendRequests' => $friendReqs));

        return view('friendRequests');
    }

    public function removeFriendRequests()
    {

        $email = Auth::user()->email;
        $friendEmail = $_POST['email'];

        $friendReqs = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $email)->get()->toArray()), true)[0]['friendRequests'];
        $friendReqs = explode("||", $friendReqs);

        $friendReqs = array_diff($friendReqs, array($friendEmail));

        $friendReqs = implode("||", $friendReqs);

        DB::table('users')->where('email', 'LIKE', $email)->update(array('friendRequests' => $friendReqs));

        return view('friendRequests');
    }
}
