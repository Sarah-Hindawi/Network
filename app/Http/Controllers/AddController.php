<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddController extends Controller
{

    public function __construct(){
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

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $email = Auth::user()->email;

        return view('home');
    }
}
