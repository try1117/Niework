@extends('layouts.app')

@push('scripts')
    <script src="{{ URL::asset('/js/utils.js')}}" rel="javascript" type="text/javascript"></script>
@endpush

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

            <div class="card mt-4">
                <div class="card-header">Posts</div>
                @if (Auth::user())
                    <div class="card-body">
                        <form method="POST" action="{{ route('createPost', $user->id) }}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                          name="body" id="create-post-textarea" rows="4"
                                          placeholder="Feel free to share your thoughts here">
                                </textarea>
                                <button type="submit" class="btn btn-primary mt-2">{{ __('Create Post') }}</button>
                            </div>
                        </form>
                    </div>
                @endif

                <ul class="list-group">
                    @foreach($posts as $post)
                        <li class="list-group-item">
                            @include("post")
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
