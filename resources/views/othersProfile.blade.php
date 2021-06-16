@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <img src="{{url('/images/'. $info['image'])}}" width="200" height="200"
                 style="margin-left: -800px; border: 3px solid;">
        </div>


        <div class="text-center h4" style="margin-top: -4.8cm; margin-left: -300px"> {{$info['name']}} </div>

        <div class="text-center h4" style="margin-top: .7cm; margin-left: -40px">
            @if($isFriend =="true")
                <form method="post" action="{{url('/removeFriend')}}" enctype="multipart/form-data"
                      style="margin-top: -1.55cm; margin-left: -180px">
                    @csrf
                    <input type="hidden" name="email" value="{{$info['email']}}">
                    <button
                        style="width: 70px; height: 27px; margin-left: 280px; background-color: darkred; font-size: x-small; color: white; border-radius: 8px; position: relative; z-index: 2"
                        type="submit">
                        Remove
                        <input type="hidden" name="isFriend" value="remove">
                    </button>
                </form>
            @elseif($isFriend=="false")
                <form method="post" action="{{url('/addFriend')}}" enctype="multipart/form-data"
                      style="margin-top: -1.55cm; margin-left: -180px">
                    @csrf
                    <input type="hidden" name="email" value="{{$info['email']}}">
                    <button
                        style="width: 70px; height: 27px; margin-left: 280px; background-color: dodgerblue; font-size: x-small; color: white; border-radius: 8px; position: relative; z-index: 2"
                        type="submit">
                        Add
                        <input type="hidden" name="isFriend" value="add">
                    </button>
                </form>
            @elseif($isFriend=="requested")
                <form method="post" action="{{url('/cancelRequest')}}" enctype="multipart/form-data"
                      style="margin-top: -1.55cm; margin-left: -180px">
                    @csrf
                    <input type="hidden" name="email" value="{{$info['email']}}">
                    <button
                        style="width: 70px; height: 27px; margin-left: 280px; background-color: gray; font-size: x-small; color: white; border-radius: 8px; position: relative; z-index: 2"
                        type="submit">
                        Cancel
                        <input type="hidden" name="isFriend" value="cancel">
                    </button>
                </form>
            @else
                <form method="post" action="{{url('/acceptFriend')}}" enctype="multipart/form-data"
                      style="margin-top: -1.55cm; margin-left: -180px">
                    @csrf
                    <input type="hidden" name="email" value="{{$info['email']}}">
                    <button
                        style="width: 70px; height: 27px; margin-left: 280px; background-color: dodgerblue; font-size: x-small; color: white; border-radius: 8px; position: relative; z-index: 2"
                        type="submit">
                        Accept
                        <input type="hidden" name="isFriend" value="accept">
                    </button>
                </form>
            @endif

        </div>

        <div class="text-center h4" style="margin-top: .7cm; margin-left: -190px">

            @isset($info['about'])
                <p style="text-align:center; margin-top: 20px; margin-left:-54px; font-size: medium">{{$info['about'] }}</p>
            @endisset
        </div>
    </div>

    <div style="margin: 5cm"></div>
    <hr>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @isset($private)
                    <div class="card">
                        <div class="card-header" style="height: 50px;">
                            <h3 style="margin-left: 5.3cm">This account is private</h3>
                        </div>
                    </div>
                @else
                    @isset($data)

                        @foreach($data as $p)

                            <div class="card">
                                <div class="card-header" style="height: 50px;">
                                    <img src="{{url('/images/'. $info['image'])}}" width="29" height="29"
                                         style="border-radius: 50%; margin-left: -10px; margin-right: 3px"> {{$info['name']}}
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

                                    <form method="post" action="{{url('/addcomment')}}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" placeholder="Write a comment..." name="text" size="89"
                                               required>
                                        <input type="hidden" name="id" value="{{$p['id']}}">
                                        <input type="hidden" name="accountEmail" value="{{$info['email']}}">

                                        <input type="image" name="imgbtn"
                                               style="width: 28px; height: 28px; background-color: royalblue; border-radius: 5px; margin-bottom: -9px; margin-left: -0.3cm "
                                               src="{{asset('assets/images/check.png')}}">
                                    </form>
                                </div>
                            </div>
                            <br>

                        @endforeach
                    @endisset
                @endisset
            </div>
        </div>
    </div>
    </div>

@endsection
