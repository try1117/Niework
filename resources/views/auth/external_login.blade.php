@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">{{ __('Authorization') }}</div>

                    <h3 class="text-center mt-4">Grant access to
                        <a href={{ parse_url($redirect_url)["scheme"]."://".parse_url($redirect_url)["host"] }}>
                            @if (ExternalNetwork::all()->where('string_id', $service_id)->first())
                                {{ ExternalNetwork::all()->where('string_id', $service_id)->first()->caption }}
                            @else
                                {{ $service_id }}
                            @endif
                        </a>
                    </h3>

                    <div class="card-body">
                        <form method="POST" action="/api/login">
                            @csrf

                            {{ Form::hidden('service_id', $service_id) }}
                            {{ Form::hidden('redirect_url', $redirect_url) }}

                            {{--<label>{{$service_id}}</label>--}}
                            {{--<label>{{$redirect_url}}</label>--}}

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
