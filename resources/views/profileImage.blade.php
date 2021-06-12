@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><p
                            style="width: 6cm; height: 10px; font-size: large">{{ __('Upload profile image') }}</p></div>

                    <div class="card-body">
                        <form action="{{url('/profileimg')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="image"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control-file" name="image">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" style="width: 3cm; height: 1cm; margin-left: 8.5cm">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



