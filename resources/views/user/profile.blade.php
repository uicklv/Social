@extends('templates.default')

@section('title', 'Добро пожаловать')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="media">
                <img src="{{ $user->getAvatarUrl()  }}" class="mr-3" alt="">
                <div class="media-body">
                    <h5 class="mt-0">{{$user->getNameorUsername()}}</h5>
                    @if($user->location)
                        <p>{{$user->location}}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-lg-offset-3">
            <h5>Список друзей {{ $user->getNameorUsername()}}</h5>

            @if(!$user->allFriends()->count())
                <p>Список пуст :(</p>
            @else
                @foreach($user->allFriends() as $user)
                    <div class="media">
                        <a href="{{route('profile.getprofile', ['user' => $user->id])}}"><img src="{{ $user->getAvatarUrl()  }}" class="mr-3" alt=""></a>
                        <div class="media-body">
                            <h5 class="mt-0"><a href="{{route('profile.getprofile', ['user' => $user->id])}}">{{$user->getNameorUsername()}}</a></h5>
                            @if($user->location)
                                <p>{{$user->location}}</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                @endforeach
            @endif

        </div>
    </div>
@endsection

