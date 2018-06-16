@extends('layouts.app')

@push('styles')
    <link href="{{asset('css/users.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                    <div class="card">
                    <div class="card-header">{{__('List of users')}}</div>
                    <div class="card-body">
                        @foreach ($users as $user)
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <a href={{"profile/".$user->getId()}} class="avatar-container">
                                            <img class="user-avatar" src={{"avatars/".$user->getAvatar()}}>
                                        </a>
                                        <div class="col-md">
                                            <a href={{"profile/".$user->getId()}}>
                                                <h4>{{$user->getName()}}</h4>
                                            </a>
                                            @if ($user->countrySelected())
                                                <h5>From {{$user->getCountry()}}</h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
