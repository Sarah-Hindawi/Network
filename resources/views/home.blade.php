@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <img src="{{asset('assets/images/avatar.png')}}" width="200" height="200"
                 style="margin-left: -800px; border: 3px solid;">

            <form method="get" action="{{url('/')}}" enctype="multipart/form-data">
                @csrf
                <input type="image" name="imgbtn"
                       style="width: 22px; height: 22px; margin-left: -25px; margin-top: 175px; background-color: white; border-radius: 3px;"
                       src="{{asset('assets/images/edit.png')}}">
            </form>
        </div>


        <div class="text-center h4" style="margin-top: -4.8cm; margin-left: -300px"> {{Auth::user()->name}} </div>

        <div class="text-center h4" style="margin-top: -0.9cm; margin-left: -270px;">
            <form method="get" action="{{url('/')}}" enctype="multipart/form-data" style="margin-top: -25px">
                @csrf
                <input type="image" name="imgbtn"
                       style="width: 22px; height: 22px; margin-left: 190px; background-color: white; position: relative; z-index: 1"
                       src="{{asset('assets/images/settings.png')}}">
            </form>
        </div>

        <div class="text-center h4" style="margin-top: .7cm; margin-left: -40px">
            <form method="get" action="{{url('/')}}" enctype="multipart/form-data"
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

        <div class="text-center h4" style="margin-top: .7cm; margin-left: -190px">

            @isset($about)
                <p style="text-align:center; margin-top: 20px; margin-left:-54px; font-size: medium">{{$about }}</p>
            @endisset
        </div>
    </div>

    <div style="margin: 5cm"></div>
    <hr>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="height: 50px;">
                        <img src="{{asset('assets/images/avatar.png')}}" width="22" height="22"
                             style="border-radius: 50%; margin-left: -10px; margin-right: 3px"> {{Auth::user()->name}}
                        <br>
                        <p style="height: 20px; text-align:center; margin-left:-16.1cm; font-size: xx-small">
                            {$time}}</p>

                    </div>

                    <div class="card-body">
                        {{--                        @isset($text)--}}
                        {$text}}
                        {{--                        @endisset--}}

                        <div style="margin-top:30px">
                            {{--                        @isset($img)--}}
                            <img src="{{asset('assets/images/avatar.png')}}" width="690" height="400">
                            {{--                        @endisset--}}
                        </div>
                    </div>
                        <div class="card-header" style="height: fit-content;">
                            <p style="font-weight: bold">Comments</p><hr>
                            <img src="{{asset('assets/images/avatar.png')}}" width="22" height="22"
                                 style="border-radius: 50%;"> {{Auth::user()->name}}
                            <br> <p style="height: fit-content; margin-left: 0.75cm">so cool!</p>

                            <img src="{{asset('assets/images/avatar.png')}}" width="22" height="22"
                                 style="border-radius: 50%;"> {{Auth::user()->name}}
                            <br> <p style="height: fit-content; margin-left: 0.75cm">so cool!</p>

                            <form method="get" action="{{url('/')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="text" placeholder="Write a comment..." name="search" size="87">
                                <input type="image" name="imgbtn"
                                       style="width: 28px; height: 28px; background-color: royalblue; border-radius: 5px; margin-bottom: -9px"
                                       src="{{asset('assets/images/check.png')}}">
                            </form>

                            {{--                            <button style="alignment: center; border-radius: 8px; width: 4cm; height: 1cm; margin-top: -11px; margin-left: 7cm">Write a Comment</button>--}}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
