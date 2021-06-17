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
                                    <textarea class="form-control" name="about">{{$about}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="privacy"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Private') }}</label>
                                <div class="col-md-6">
                                    <input type="checkbox" id="privacy" name="privacy" value="true"
                                           style=" width:20px; height:20px; margin-top: 8px" {{$privacy}}>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success"
                                        style="width: 3cm; height: 1cm; margin-left: 8.5cm">Update
                                </button>
                            </div>
                        </form>

                        <hr>
                        <p style="color: red; font-size: medium">Delete Account</p>
                        <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account?')"
                           href="{{url('/deleteAccount')}}">Delete</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



