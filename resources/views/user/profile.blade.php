@extends('templates.default')

@section('title', 'Добро пожаловать')

@section('content')
{{--    <div class="row">--}}
{{--        <div class="col-lg-6">--}}
{{--            <div class="media">--}}
{{--                <img src="{{ $user->getAvatarUrl()  }}" class="mr-3" alt="">--}}
{{--                <div class="media-body">--}}
{{--                    <h5 class="mt-0">{{$user->getNameorUsername()}}</h5>--}}
{{--                    @if($user->location)--}}
{{--                        <p>{{$user->location}}</p>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-lg-6 col-lg-offset-3">--}}
{{--            <h5>Список друзей {{ $user->getNameorUsername()}}</h5>--}}

{{--            @if(!$user->allFriends()->count())--}}
{{--                <p>Список пуст :(</p>--}}
{{--            @else--}}
{{--                @foreach($user->allFriends() as $user)--}}
{{--                    <div class="media">--}}
{{--                        <a href="{{route('profile.getprofile', ['user' => $user->id])}}"><img src="{{ $user->getAvatarUrl()  }}" class="mr-3" alt=""></a>--}}
{{--                        <div class="media-body">--}}
{{--                            <h5 class="mt-0"><a href="{{route('profile.getprofile', ['user' => $user->id])}}">{{$user->getNameorUsername()}}</a></h5>--}}
{{--                            @if($user->location)--}}
{{--                                <p>{{$user->location}}</p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <hr>--}}
{{--                @endforeach--}}
{{--            @endif--}}

{{--        </div>--}}
{{--    </div>--}}
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="profile">
                    <h1 class="page-header">{{$user->getNameorUsername()}}</h1>
                    <div class="row">
                        <div class="col-md-4">
                            <img src="/img/user.png" class="img-thumbnail" alt="">
                        </div>
                        <div class="col-md-8">
                            <ul>
                                <li><strong>Name:</strong>{{$user->getNameorUsername()}}</li>
                                <li><strong>Email:</strong>{{$user->email}}</li>
                                <li><strong>Country:</strong>{{$user->location}}</li>
                                <li><strong>DOB:</strong>{{\Illuminate\Support\Carbon::parse($user->birthday)->format('d F Y')}}</li>
                            </ul>
                        </div>
                    </div><br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Profile Wall</h3>
                                </div>
                                <div class="panel-body">
                                    <form>
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Write on the wall"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit</button>
                                        <div class="pull-right">
                                            <div class="btn-toolbar">
                                                <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i>Text</button>
                                                <button type="button" class="btn btn-default"><i class="fa fa-file-image-o"></i>Image</button>
                                                <button type="button" class="btn btn-default"><i class="fa fa-file-video-o"></i>Video</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default friends">
                    <div class="panel-heading">
                        <h3 class="panel-title">My Friends</h3>
                    </div>
                    <div class="panel-body">
                        @if(!$user->allFriends()->count())
                            Список пуст :(
                        @else
                            <ul>
                                @foreach($user->allFriends() as $friend)
                                    <li><a href="{{route('profile.getprofile', ['user' => $friend->id])}}" class="thumbnail"><img src="/img/user.png" alt="" title="{{$friend->username}}"></a></li>
                                @endforeach
                            </ul>
                            <div class="clearfix"></div>
                            <a class="btn btn-primary" href="#">View All Friends</a>
                        @endif
                    </div>
                </div>
                <div class="panel panel-default groups">
                    <div class="panel-heading">
                        <h3 class="panel-title">Latest Groups</h3>
                    </div>
                    <div class="panel-body">
                        <div class="group-item">
                            <img src="/img/group.png" alt="">
                            <h4><a href="#" class="">Sample Group One</a></h4>
                            <p>This is a paragraph of intro text, or whatever I want to call it.</p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="group-item">
                            <img src="/img/group.png" alt="">
                            <h4><a href="#" class="">Sample Group Two</a></h4>
                            <p>This is a paragraph of intro text, or whatever I want to call it.</p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="group-item">
                            <img src="/img/group.png" alt="">
                            <h4><a href="#" class="">Sample Group Three</a></h4>
                            <p>This is a paragraph of intro text, or whatever I want to call it.</p>
                        </div>
                        <div class="clearfix"></div>
                        <a href="#" class="btn btn-primary">View All Groups</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

