<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use \Datetime;


class AddController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $email = Auth::user()->email;
        return view('newPost');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image',
        ]);

        if (!isset($request->image) and !isset($request->text)) {
            return view('home');
        }

        $name = $request->image->getClientOriginalName();

        $email = Auth::user()->email;

        $date = new DateTime("now", new \DateTimeZone('America/Halifax'));
        $imageName = $date->format('d-m-Y@H-i-s') . '-' . $email . '-' . $name;

        $request->image->move(public_path('images'), $imageName);


        DB::table('profiles')->insert([
            'email' => $email,
            'caption' => $request->text,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'image' => $imageName,
        ]);



        $email = Auth::user()->email;
        $posts = DB::table('profiles')->where('email', 'LIKE', "%" . $email . "%")->get()->toArray();
        $postArr = [];

        foreach ($posts as $p){
            $postArr[]= json_decode(json_encode($p), true);
        }

        return view('home',  ["data" => $postArr]);
    }
}
