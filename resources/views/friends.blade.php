@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="height: 50px;">
                        <p style="font-weight: bold">Comments</p>
                    </div>
                    <div class="card-body">

                        @isset($p['friends'])
                            @foreach($p['friends'] as $friend)
                                <img src="{{url('/images/'. $friend[1])}}" width="24" height="24"
                                     style="border-radius: 50%; margin-top: .2cm; margin-right: 5px"> {{$friend[0]}}
                            @endforeach
                        @endisset
                    </div>
                </div>
@endsection
