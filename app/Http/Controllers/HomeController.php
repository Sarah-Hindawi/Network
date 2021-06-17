<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $email = Auth::user()->email;
        DB::table('users')->where('email', 'LIKE', $email)->update(array('friends' => 'jhindawi@upei.ca||a@a.com'));

        $users = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $email)->get()->toArray()), true)[0]['friends'];
        $users = array_unique(explode("||", $users));


        $posts = DB::table('profiles')->whereIn('email', $users)->orderBy('created_at', 'desc')->get()->toArray();

        $postArr = [];

        for ($i = 0; $i < sizeof($posts); $i++) {
            $post = json_decode(json_encode($posts[$i]), true);
            $user = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $post['email'])->get()->toArray()), true)[0];
            $post['name'] = $user['name'];
            $post['userImg'] = $user['image'];
            $post['userId'] = $user['id'];

            $postArr[] = $post;

            if (isset($postArr[$i]['comments'])) {
                $comments = $postArr[$i]['comments'];
                $comments = explode("|||", $comments);

                $commentsArr = [];
                foreach ($comments as $c) {
                    $postComment = explode("||", $c);
                    $commenterName = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $postComment[0])->first("name")), true)['name'];

                    $profileImage = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', $postComment[0])->first("image")), true)['image'];

                    //replacing the email with the user name
                    $postComment[0] = $commenterName;
                    $postComment[3] = $profileImage;
                    $commentsArr[] = $postComment;
                }
                $postArr[$i]['comments'] = $commentsArr;
            }
        }

        return view('NewsFeed', ["data" => $postArr]);
    }
}
