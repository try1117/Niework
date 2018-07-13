@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('User information')}}</div>

                <div class=" card-body row">
                    <div class="col-4">
                        <img class="" src="/avatars/{{ $user->getAvatar() }}" height="200" width="200"/>
                        {{--<button class="btn btn-primary mt-2">Edit profile</button>--}}
                        @if (Auth::user() && Auth::user()->getId() == $user->getId())
                            <a class="btn btn-primary mt-2" href="{{ route('edit') }}">{{ __('Edit profile') }}</a>
                        @endif

                        {{--<div class="row justify-content-center">--}}
                            {{--<form action="/profile" method="post" enctype="multipart/form-data">--}}
                                {{--@csrf--}}
                                {{--<div class="form-group">--}}
                                    {{--<input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">--}}
                                    {{--<small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>--}}
                                {{--</div>--}}
                                {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                            {{--</form>--}}
                        {{--</div>--}}
                    </div>

                    <div class="col-8">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <label class="col-md-4 col-form-label text-md-left">{{$user->getName()}}</label>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <label class="col-md-4 col-form-label text-md-left">{{$user->getEmailAddress()}}</label>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Registration date') }}</label>
                            <label class="col-md-4 col-form-label text-md-left">{{$user->getRegistrationDate()}}</label>
                        </div>

                        @if ($user->birthDateSelected())
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>
                                <label class="col-md-4 col-form-label text-md-left">{{$user->getBirthDate()}}</label>
                            </div>
                        @endif

                        @if ($user->countrySelected())
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                                <label class="col-md-4 col-form-label text-md-left">{{$user->getCountry()}}</label>
                            </div>
                        @endif
                    </div>
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
