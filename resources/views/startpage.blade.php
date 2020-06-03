@extends('templates.default')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Wall</h3>
                        </div>
                    </div>
                    @foreach($posts as $post)
                        <div class="panel panel-default post">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <a href="profile.html" class="post-avatar thumbnail"><img src="/img/user.png" alt=""><div class="text-center">{{\App\User::find($post->user_id)->getNameorUsername()}}</div></a>
                                        <div class="likes text-center">7 Likes</div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="bubble">
                                            <div class="pointer">
                                                <p>{{$post->caption}}</p>
                                            </div>
                                            <div class="pointer-border"></div>
                                        </div>
                                        <p class="text-right">{{\Illuminate\Support\Carbon::parse($post->created_at)->format('d F Y / H:i ')}}</p>
                                        <p class="post-actions"><a href="#">Comment</a> - <a href="#">Like</a> - <a href="#">Follow</a> - <a href="#">Share</a></p>
                                        <div class="comment-form">
                                            <form class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="enter comment">
                                                </div>
                                                <button type="submit" class="btn btn-default">Add</button>
                                            </form>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="comments">
                                            <div class="comment">
                                                <a href="#" class="comment-avatar pull-left"><img src="/img/user.png" alt=""></a>
                                                <div class="comment-text">
                                                    <p>I am just going to paste in a paragraph, then we will add another clearfix.</p>
                                                </div>
                                            </div>
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default friends">
                        <div class="panel-heading">
                            <h3 class="panel-title">My Friends</h3>
                        </div>
                        <div class="panel-body">
                            @if(!$friends->count())
                                Список пуст :(
                            @else
                                <ul>
                                    @foreach($friends as $friend)
                                        <li><a href="{{route('profile.getprofile', ['user' => $friend->id])}}" class="thumbnail"><img src="img/user.png" alt="" title="{{$friend->username}}"></a></li>
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
                                <img src="img/group.png" alt="">
                                <h4><a href="#" class="">Sample Group One</a></h4>
                                <p>This is a paragraph of intro text, or whatever I want to call it.</p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="group-item">
                                <img src="img/group.png" alt="">
                                <h4><a href="#" class="">Sample Group Two</a></h4>
                                <p>This is a paragraph of intro text, or whatever I want to call it.</p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="group-item">
                                <img src="img/group.png" alt="">
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
