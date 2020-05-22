@extends('templates.default')

@section('title', 'Добро пожаловать')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h3>Результаты поиска: "{{ request()->input('query')}}"</h3>
            @if(!$users->count())
                <p>Ничего не найдено :(</p>
            @else
                    <div class="row">
                        <div class="col-lg-9">
                            @foreach($users as $user)
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
                        </div>
                    </div>
            @endif
        </div>
    </div>
@endsection
