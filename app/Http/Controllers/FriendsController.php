<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Ramsey\Collection\Exception\NoSuchElementException;

class FriendsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $email = Auth::user()->email;

        $users = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $email)->get()->toArray()), true)[0]['friends'];
        $requestsInfo = [];

        if (!is_null($users) and $users != "") {
            $users = array_unique(explode("||", $users));

            foreach ($users as $user) {
                $req = [];
                $userInfo = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $user)->get()->toArray()), true)[0];
                $req[0] = $userInfo['name'];
                $req[1] = $userInfo['image'];
                $req[2] = $userInfo['id'];
                $req[3] = $userInfo['email'];
                $requestsInfo[] = $req;
            }
        }

        return view('friends', ['friends' => $requestsInfo]);
    }

    public function addFriend()
    {
        $email = Auth::user()->email;

        $friendEmail = $_POST['email'];

        $friendReqs = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $friendEmail)->get()->toArray()), true)[0]['friendRequests'];

        if (is_null($friendReqs) or $friendReqs == "") {
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


        //removing friend from the other end
        $userFriends = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $friendEmail)->get()->toArray()), true)[0]['friends'];
        $userFriends = explode("||", $userFriends);
        $userFriends = array_diff($userFriends, array($email));
        $userFriends = implode("||", $userFriends);

        DB::table('users')->where('email', 'LIKE', $friendEmail)->update(array('friends' => $userFriends));

        if (isset($_POST['isFriend'])) {
            $userId = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $friendEmail)->get()->toArray()), true)[0]['id'];
            return redirect('/profile?id=' . $userId);
        }
        return redirect('/requests');
    }

    public function displayFriendRequests()
    {
        $email = Auth::user()->email;

        $allUsers = json_decode(json_encode(DB::table('users')->get(['email'])), true);
        $allEmails = [];
        foreach ($allUsers as $all){
            $allEmails[] = $all['email'];
        }

        $users = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $email)->get()->toArray()), true)[0]['friendRequests'];

        $requestsInfo = [];

        if (!is_null($users) and $users != "") {
            //intersection to avoid displaying requests from deleted accounts
            $users = array_intersect(array_unique(explode("||", $users)), $allEmails);

            foreach ($users as $user) {
                $req = [];
                $userInfo = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $user)->get()->toArray()), true)[0];
                $req[0] = $userInfo['name'];
                $req[1] = $userInfo['image'];
                $req[2] = $userInfo['id'];
                $req[3] = $userInfo['email'];
                $requestsInfo[] = $req;

            }
        }

        return view('friendRequests', ['requests' => $requestsInfo]);
    }

    public function acceptFriend()
    {
        $email = Auth::user()->email;
        $friendEmail = $_POST['email'];

        $userFriends = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $email)->get()->toArray()), true)[0]['friends'];

        if (is_null($userFriends) or $userFriends == "") {
            $userFriends = $friendEmail;

        } else {

            $userFriends .= "||" . $friendEmail;
        }

        DB::table('users')->where('email', 'LIKE', $email)->update(array('friends' => $userFriends));

        $friendReqs = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $email)->get()->toArray()), true)[0]['friendRequests'];
        $friendReqs = explode("||", $friendReqs);

        $friendReqs = array_diff($friendReqs, array($friendEmail));

        $friendReqs = implode("||", $friendReqs);

        DB::table('users')->where('email', 'LIKE', $email)->update(array('friendRequests' => $friendReqs));

        //adding the friend on the other end
        $userFriends = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $friendEmail)->get()->toArray()), true)[0]['friends'];
        if (is_null($userFriends) or $userFriends == "") {
            $userFriends = $email;
        } else {
            $userFriends .= "||" . $email;
        }
        DB::table('users')->where('email', 'LIKE', $friendEmail)->update(array('friends' => $userFriends));

        if (isset($_POST['isFriend'])) {
            $userId = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $friendEmail)->get()->toArray()), true)[0]['id'];
            return redirect('/profile?id=' . $userId);
        }
        return redirect('/requests');
    }

    public function removeRequest()
    {

        $email = Auth::user()->email;
        $friendEmail = $_POST['email'];

        $friendReqs = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $email)->get()->toArray()), true)[0]['friendRequests'];
        $friendReqs = explode("||", $friendReqs);

        $friendReqs = array_diff($friendReqs, array($friendEmail));

        $friendReqs = implode("||", $friendReqs);

        DB::table('users')->where('email', 'LIKE', $email)->update(array('friendRequests' => $friendReqs));

        return redirect('/requests');
    }

    public function cancelRequest()
    {
        $email = Auth::user()->email;
        $friendEmail = $_POST['email'];

        $friendReqs = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $friendEmail)->get()->toArray()), true)[0]['friendRequests'];
        $friendReqs = explode("||", $friendReqs);

        $friendReqs = array_diff($friendReqs, array($email));

        $friendReqs = implode("||", $friendReqs);

        DB::table('users')->where('email', 'LIKE', $friendEmail)->update(array('friendRequests' => $friendReqs));

        $userId = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $friendEmail)->get()->toArray()), true)[0]['id'];

        return redirect('/profile?id=' . $userId);
    }
}
