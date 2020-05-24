@extends('templates.default')

@section('title', 'Добро пожаловать')

@section('content')
    <div class="row">
        <div class="col-lg-6">
           <h5>Ваши друзья</h5>
            @if(!$friends->count())
                <p>Список пуст :(</p>
            @else
                @foreach($friends as $friend)
                    <div class="media">
                        <a href="{{route('profile.getprofile', ['user' => $friend->id])}}"><img src="{{ $friend->getAvatarUrl()  }}" class="mr-3" alt=""></a>
                        <div class="media-body">
                            <h5 class="mt-0"><a href="{{route('profile.getprofile', ['user' => $friend->id])}}">{{$friend->getNameorUsername()}}</a></h5>
                            @if($friend->location)
                                <p>{{$friend->location}}</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                @endforeach
            @endif
        </div>

        <div class="col-lg-6">
            <h5>Заявки в друзья</h5>
            @if(!$requests->count())
                <p>Список пуст :(</p>
            @else
                @foreach($requests as $friend)
                    <div class="media">
                        <a href="{{route('profile.getprofile', ['user' => $friend->id])}}"><img src="{{ $friend->getAvatarUrl()  }}" class="mr-3" alt=""></a>
                        <div class="media-body">
                            <h5 class="mt-0"><a href="{{route('profile.getprofile', ['user' => $friend->id])}}">{{$friend->getNameorUsername()}}</a></h5>
                            @if($friend->location)
                                <p>{{$friend->location}}</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                @endforeach
            @endif
        </div>
    </div>
@endsection

