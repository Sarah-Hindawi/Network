@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><p
                            style="width: 6cm; height: 10px; font-size: large">{{ __('Settings') }}</p></div>

                    <div class="card-body">
                        <form action="{{url('/updateSettings')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="text"
                                       class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="text"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="text"
                                       class="col-md-4 col-form-label text-md-right">{{ __('About') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" name="about"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="privacy"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Private') }}</label>
                                <div class="col-md-6">
                                    <input type="checkbox" id="privacy" name="privacy" value="true" style=" width:20px; height:20px; margin-top: 8px">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" style="width: 3cm; height: 1cm; margin-left: 8.5cm">Update</button>
                            </div>
                        </form>

                        <form method="post" action="{{url('/deleteAccount')}}" enctype="multipart/form-data"
                              style="margin-top: -1.55cm; margin-left: -180px">
                            @csrf
                            <input type="hidden" name="email" value="{{$email}}">
                            <button style="width: 150px; height: 40px; margin-left: 497px; margin-top: 1.9cm; background-color: red; font-size: medium; color: white; border-radius: 8px; position: relative; z-index: 2" type="submit">
                                Delete Account </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



