@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('User information')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('edit') }}">
                            @csrf

                            <div class="row">
                                <div class="col-4">
                                    <img class="" src="/avatars/{{ Auth::user()->getAvatar() }}" />
                                    {{--<button class="btn btn-primary mt-2">Edit profile</button>--}}
                                    {{--<a class="btn btn-primary mt-2" href="{{ route('edit') }}">{{ __('Edit profile') }}</a>--}}

                                    <div class="row justify-content-center mt-2">
                                        <form action="/profile" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                                                <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-8">

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" value="{{ old('name') }}" required autofocus placeholder={{Auth::user()->getName()}}>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                        <label class="col-md-4 col-form-label text-md-left">{{Auth::user()->getEmailAddress()}}</label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Registration date') }}</label>
                                        <label class="col-md-4 col-form-label text-md-left">{{Auth::user()->getRegistrationDate()}}</label>
                                    </div>

                                    @if (Auth::user()->birthDateSelected())
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>
                                            <label class="col-md-4 col-form-label text-md-left">{{Auth::user()->getBirthDate()}}</label>
                                        </div>
                                    @endif

                                    @if (Auth::user()->countrySelected())
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                                            <label class="col-md-4 col-form-label text-md-left">{{Auth::user()->getCountry()}}</label>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="btn-toolbar">
                                    <button type="submit" class="btn btn-primary mx-2">Submit</button>
                                    <button type="submit" class="btn btn-primary mx-2">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{--<div class="card">--}}
                {{--<div class="card-header">Dashboard</div>--}}

                {{--<div class="card-body">--}}
                {{--@if (session('status'))--}}
                {{--<div class="alert alert-success">--}}
                {{--{{ session('status') }}--}}
                {{--</div>--}}
                {{--@endif--}}

                {{--You are logged in!--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection
