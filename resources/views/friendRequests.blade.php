@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="height: 50px;">
                        <p style="font-weight: bold">Friend Requests</p>
                    </div>
                    <div class="card-body">

                        @isset($requests)
                            @foreach($requests as $req)
                                <div>
                                <img src="{{url('/images/'. $req[1])}}" width="24" height="24"
                                     style="border-radius: 50%; margin-right: 5px"> <a href="{{ url('profile?id='. $req[2])}}"> {{$req[0]}}</a>


                                <form method="post" action="{{url('/acceptFriend')}}" enctype="multipart/form-data"
                                      style="margin-top: -.8cm; margin-left: 220px">
                                    @csrf
                                    <input type="hidden" name="email" value="{{$req[3]}}">
                                    <button
                                        style="width: 70px; height: 27px; margin-left: 280px; background-color: dodgerblue; font-size: x-small; color: white; border-radius: 8px; position: relative; z-index: 2"
                                        type="submit">
                                        Accept
                                    </button>
                                </form>

                                <form method="post" action="{{url('/removeRequest')}}" enctype="multipart/form-data"
                                      style="margin-top: -.7cm; margin-left: 300px">
                                    @csrf
                                    <input type="hidden" name="email" value="{{$req[3]}}">
                                    <button
                                        style="width: 70px; height: 27px; margin-left: 280px; background-color: darkred; font-size: x-small; color: white; border-radius: 8px; position: relative; z-index: 2"
                                        type="submit">
                                        Remove
                                    </button>
                                </form>
                                </div>
                                <br>
                            @endforeach
                        @endisset
                    </div>
                </div>
@endsection
