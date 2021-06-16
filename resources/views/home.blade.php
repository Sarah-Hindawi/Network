@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <img src="{{url('/images/'. Auth::user()->image)}}" width="200" height="200"
                 style="margin-left: -800px; border: 3px solid;">


            <form method="get" action="{{url('/profileimg')}}" enctype="multipart/form-data">
                @csrf
                <input type="image" name="imgbtn"
                       style="width: 22px; height: 22px; margin-left: -25px; margin-top: 175px; background-color: white; border-radius: 3px;"
                       src="{{asset('assets/images/edit.png')}}">
            </form>
        </div>


        <div class="text-center h4" style="margin-top: -4.8cm; margin-left: -300px"> {{Auth::user()->name}} </div>

        <div class="text-center h4" style="margin-top: -0.9cm; margin-left: -270px;">
            <form method="get" action="{{url('/settings')}}" enctype="multipart/form-data" style="margin-top: -25px">
                @csrf
                <input type="image" name="imgbtn"
                       style="width: 22px; height: 22px; margin-left: 190px; background-color: white; position: relative; z-index: 1"
                       src="{{asset('assets/images/settings.png')}}">
            </form>
        </div>

        <div class="text-center h4" style="margin-top: .7cm; margin-left: -40px">
            <form method="get" action="{{url('/friends')}}" enctype="multipart/form-data"
                  style="margin-top: -1.55cm; margin-left: -180px">
                @csrf
                <button
                    style="width: 80px; height: 27px; margin-left: 280px; background-color: dodgerblue; font-size: x-small; color: white; border-radius: 8px; position: relative; z-index: 2"
                    type="submit"> Friends
                </button>
            </form>

            <form method="get" action="{{url('/newpost/create')}}" enctype="multipart/form-data"
                  style="margin-top: -0.8cm; margin-left: -180px">
                @csrf
                <button
                    style="width: 80px; height: 27px; margin-left:450px; background-color: forestgreen; font-size: x-small; color: white; border-radius: 8px"
                    type="submit"> Add a Post
                </button>
            </form>
        </div>

        <div class="text-center h4" style="margin-top: .7cm; margin-left: -180px">

            @isset(Auth::user()->about)
                <p style="text-align:center; margin-top: 20px; margin-left:-54px; font-size: medium">{{Auth::user()->about }}</p>
            @endisset
        </div>
    </div>

    <div style="margin: 5cm"></div>
    <hr>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @isset($data)

                    @foreach($data as $p)

                        <div class="card">
                            <div class="card-header" style="height: 50px;">
                                <img src="{{url('/images/'. Auth::user()->image)}}" width="29" height="29"
                                     style="border-radius: 50%; margin-left: -10px; margin-right: 3px"> {{Auth::user()->name}}
                                <br>
                                <p style="height: 20px; text-align:center; margin-top: -5px; margin-left:-14.45cm; font-size: xx-small">
                                    {{$p['created_at']}}
                                </p>

                            </div>

                            <div class="card-body">
                                @isset($p['caption'])
                                    {{$p['caption']}}
                                @endisset

                                <div style="margin-top:30px">
                                    @isset($p['image'])
                                        <img src="{{url('/images/'.$p['image'])}}" width="690" height="400">
                                    @endisset
                                </div>
                            </div>
                            <div class="card-header" style="height: fit-content;">
                                <p style="font-weight: bold">Comments</p>
                                <hr>
                                @isset($p['comments'])
                                    @foreach($p['comments'] as $comment)
                                        <img src="{{url('/images/'. $comment[3])}}" width="24" height="24"
                                             style="border-radius: 50%; margin-top: .2cm; margin-right: 5px"> {{$comment[0]}}
                                        <p style="font-size: xx-small; margin-left: .9cm; margin-top: -.2cm"> {{$comment[2]}}</p>
                                        <p style="height: fit-content; margin-left: 0.9cm; margin-top: -.4cm">{{$comment[1]}}</p>
                                        <hr style="margin-top: -.3cm; margin-bottom: -1px">

                                    @endforeach
                                @endisset

                                <form method="post" action="{{url('/comment')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" placeholder="Write a comment..." name="text" size="89" required>
                                    <input type="hidden" name="id" value="{{$p['id']}}">
                                    <input type="hidden" name="commenterImg" value="{{Auth::user()->image}}">
                                    <input type="image" name="imgbtn"
                                           style="width: 28px; height: 28px; background-color: royalblue; border-radius: 5px; margin-bottom: -9px; margin-left: -0.3cm "
                                           src="{{asset('assets/images/check.png')}}">
                                </form>
                            </div>
                        </div>
                        <br>

                    @endforeach
                @endisset
            </div>
        </div>
    </div>
    </div>

@endsection
