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
                                <img src="{{url('/images/'. $req[1])}}" width="24" height="24"
                                     style="border-radius: 50%; margin-right: 5px"> <a href="{{ url('profile?id='. $req[2])}}"> {{$req[0]}}</a>
                                <br><br>
                            @endforeach
                        @endisset
                    </div>
                </div>
@endsection
