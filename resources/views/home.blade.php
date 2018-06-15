@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('User information')}}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                        <label class="col-md-4 col-form-label text-md-left">{{Auth::user()->getName()}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <label class="col-md-4 col-form-label text-md-left">{{Auth::user()->getEmailAddress()}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Registration date') }}</label>
                        <label class="col-md-4 col-form-label text-md-left">{{Auth::user()->getRegistrationDate()}}</label>
                    </div>

                    @if (Auth::user()->birthDateSelected())
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Date of birth') }}</label>
                            <label class="col-md-4 col-form-label text-md-left">{{Auth::user()->getBirthDate()}}</label>
                        </div>
                    @endif

                    @if (Auth::user()->countrySelected())
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Country') }}</label>
                            <label class="col-md-4 col-form-label text-md-left">{{Auth::user()->getCountry()}}</label>
                        </div>
                    @endif
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
