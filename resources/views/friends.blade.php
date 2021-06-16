@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="height: 50px;">
                        <p style="font-weight: bold">Friends</p>
                    </div>
                    <div class="card-body">

                        @isset($friends)
                            @foreach($friends as $friend)
                                <div>
                                    <img src="{{url('/images/'. $friend[1])}}" width="24" height="24"
                                         style="border-radius: 50%; margin-top: .2cm; margin-right: 5px"> <a
                                        href="{{ url('profile?id='. $friend[2])}}"> {{$friend[0]}}</a>

                                    <form method="post" action="{{url('/removeFriend')}}" enctype="multipart/form-data"
                                          style="margin-top: -.8cm; margin-left: 300px">
                                        @csrf
                                        <input type="hidden" name="email" value="{{$friend[3]}}">
                                        <button style="width: 70px; height: 27px; margin-left: 280px; background-color: darkred; font-size: x-small; color: white; border-radius: 8px; position: relative; z-index: 2" type="submit"> Delete </button>
                                    </form>
                                </div>
                                <br>
                            @endforeach
                        @endisset
                    </div>
                </div>
@endsection
