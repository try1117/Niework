@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('User information')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update') }}">
                            @csrf

                            <div class="row">
                                <div class="col-4">
                                    <img class="" src="/avatars/{{ Auth::user()->getAvatar() }}" />
                                    <div class="mt-3">
                                        {{--<form action="{{ route('update_avatar') }}" method="POST" enctype="multipart/form-data">--}}
                                            {{--@csrf--}}
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                                                <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                                            </div>
                                        {{--</form>--}}
                                    </div>
                                    {{--</div>--}}
                                </div>

                                <div class="col-8">

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-7">
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" value="{{ Auth::user()->getName() }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-7">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   name="email" value="{{ Auth::user()->getEmailAddress() }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-7">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   name="password">

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-7">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>

                                        <div class="col-md-7">
                                            <input id="birth_date" type="date" class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : '' }}"
                                                   name="birth_date" value="{{Auth::user()->getBirthDate()}}">

                                            @if ($errors->has('birth_date'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('birth_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                                        <div class="col-md-7">
                                            {!! Form::select('country_id', Niework\Models\Country::getCountriesList(), Auth::user()->getCountryId(),
                                                ['class' => 'form-control']); !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="btn-toolbar">
                                    <button type="submit" class="btn btn-success mx-2">{{ __('Save') }}</button>
                                    <a class="btn btn-secondary mx-2" href={{ route('home') }}>{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </form>
                    </div> {{-- card body --}}
                </div> {{-- card --}}
            </div>
        </div>
    </div>
@endsection
