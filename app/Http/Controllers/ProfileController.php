<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use \Datetime;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $email = Auth::user()->email;

        $posts = DB::table('profiles')->where('email', 'LIKE', "%" . $email . "%")->orderBy('created_at', 'desc')->get()->toArray();
        //an array containing the info of each post
        $postArr = [];

        for ($i = 0; $i < sizeof($posts); $i++) {
            $postArr[] = json_decode(json_encode($posts[$i]), true);
            if (isset($postArr[$i]['comments'])) {
                $comments = $postArr[$i]['comments'];
                $comments = explode("|||", $comments);

                $commentsArr = [];
                foreach ($comments as $c) {
                    $postComment = explode("||", $c);
                    $commenterName = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', "%" . $postComment[0] . "%")->first("name")), true)['name'];

                    $profileImage = json_decode(json_encode(DB::table('users')->where('email', 'LIKE', "%" . $postComment[0] . "%")->first("image")), true)['image'];

                    //replacing the email with the user name
                    $postComment[0] = $commenterName;

                    $postComment[3] = $profileImage;
                    $commentsArr[] = $postComment;
                }
                $postArr[$i]['comments'] = $commentsArr;
            }
        }

        return view('home', ["data" => $postArr]);
    }

    public function addComment()
    {
        $email = Auth::user()->email;

        $post = DB::table('profiles')->where('id', 'LIKE', "%" . $_POST['id'] . "%")->get();

        $comments = json_decode(json_encode($post), true)[0]['comments'];

        $date = new DateTime("now", new \DateTimeZone('America/Halifax'));
        $content = $email . "||" . $_POST['text'] . "||" . $date->format('d-m-Y H-i-s');

        //if there are no comments yet, add a comment of the email of the user and the text of the comment (separated by || for parsing)
        if (!isset($comments)) {
            $comments = $content;
        } else {
            //separate different comments by ||| for parsing and extracting
            $comments = $comments . "|||" . $content;
        }

        DB::table('profiles')->where('id', 'LIKE', "%" . $_POST['id'] . "%")->update(array('comments' => $comments));


        return redirect('/home');
    }
}
