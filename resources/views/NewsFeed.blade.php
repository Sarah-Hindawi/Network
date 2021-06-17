@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    @isset($data)
                        @foreach($data as $p)

                            <div class="card">
                                <div class="card-header" style="height: 50px;">
                                    <img src="{{url('/images/'. $p['userImg'])}}" width="29" height="29"
                                         style="border-radius: 50%; margin-left: -10px; margin-right: 3px"> <a
                                        href="{{ url('profile?id='. $p['userId'])}}"> {{$p['name']}}</a>
                                    <br>
                                    <p style="height: 20px; text-align:center; margin-top: -5px; margin-left:-13.9cm; font-size: xx-small">
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
                                        <input type="text" placeholder="Write a comment..." name="text" size="86"
                                               required>
                                        <input type="hidden" name="id" value="{{$p['id']}}">
                                        <input type="hidden" name="accountEmail" value="{{$p['email']}}">
                                        <input type="hidden" name="source" value="newsfeed">

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
