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
                    <h1 class="page-header">{{$user->getNameorUsername()}}
                        <div id="buttonFriend">
                            @php
                                $checkFriend = \App\User::checkFriend($user);

                            @endphp
                            @if($checkFriend['isFriend'])
                                <a id="deleteFriend" href="#" class="btn btn-danger">Удалить из друзей</a>
                            @elseif($user->id == \Illuminate\Support\Facades\Auth::user()->id)
                                <a href="#" class="btn btn-default">Настройки профиля</a>
                            @elseif(!$checkFriend['isFriend'] && $checkFriend['isRequest']->isEmpty())
                                <a id="addFriend"  class="btn btn-success">Добавить в друзья</a>
                            @elseif(\Illuminate\Support\Facades\Auth::user()->friendRequests()->contains('id', $user->id))
                                <a id="acceptFriend"  class="btn btn-success">Принять заявку</a>
                            @elseif(!$checkFriend['isRequest']->isEmpty())
                                Заявка в обработке...
                            @endif
                        </div>
                        @csrf
                    </h1>
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
                                    <form action="" id="postform">
                                        @csrf
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Write on the wall" name="caption" id="caption"></textarea>
                                            <div id="div_caption">
                                                <span class="help-block text-danger" id="caption_error" role="alert" style="display: none;"></span>
                                            </div>
                                        </div>
                                        <button id="button_submit" type="submit" class="btn btn-default">Submit</button>
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
                                <div id="div_success" class="alert alert-success alert-dismissible" role="alert" style="display:none">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    Post added, refresh page
                                </div>
                            @foreach($posts as $post)
                                <div class="panel panel-default post">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <a href="profile.html" class="post-avatar thumbnail"><img src="/img/user.png" alt=""><div class="text-center">{{$user->getNameorUsername()}}</div></a>
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
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default friends">
                    <div class="panel-heading">
                        @if(\Illuminate\Support\Facades\Auth::user()->id == $user->id)
                            <h3 class="panel-title">My Friends</h3>
                        @else
                            <h3 class="panel-title">Friends</h3>
                        @endif
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

@push('scripts')
    <script type="text/javascript">
            $(document).ready(function() {

                var handleFormSubmit = function() {
                    $('#button_submit').click(function(e) {
                        e.preventDefault();
                        var form = $(this).closest('#postform').serialize();
                        $.ajax({
                            method: 'POST',
                            url: '{{route('post.store')}}',
                            data: form,
                            error: function(xhr) {
                                var response = jQuery.parseJSON(xhr.responseText);
                                if(response.errors.caption){
                                    document.getElementById('div_caption').classList.add('has-error');
                                    $('#caption_error').css('display', 'block');
                                    $('#caption_error').append(response.errors.caption);
                                }
                            },
                            success: function(response, status, xhr, $form) {
                                $('#div_success').css('display', 'block');
                            }
                        });
                    });
                }

                $('#addFriend').click(function(e) {
                    let token = $('input[name="_token"]').val();
                    e.preventDefault();
                    $.ajax({
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-CSRF-Token', token);
                        },
                        method: 'POST',
                        url: '{{route('addfriend.post')}}',
                        data: {
                            user: '{{\Illuminate\Support\Facades\Auth::user()->id}}',
                            friend: '{{$user->id}}',
                        },
                        error: function(xhr) {

                        },
                        success: function(response, status, xhr, $form) {
                            $('#buttonFriend').html('Заявка отправлена');
                        }
                    });
                });
                $('#acceptFriend').click(function(e) {
                    let token = $('input[name="_token"]').val();
                    e.preventDefault();
                    $.ajax({
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-CSRF-Token', token);
                        },
                        method: 'POST',
                        url: '{{route('accept.post')}}',
                        data: {
                            user: '{{\Illuminate\Support\Facades\Auth::user()->id}}',
                            friend: '{{$user->id}}',
                        },
                        error: function(xhr) {

                        },
                        success: function(response, status, xhr, $form) {
                            $('#buttonFriend').html('Заявка принята');
                        }
                    });
                });

                $('#deleteFriend').click(function(e) {
                    let token = $('input[name="_token"]').val();
                    e.preventDefault();
                    $.ajax({
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-CSRF-Token', token);
                        },
                        method: 'POST',
                        url: '{{route('deletefriend.post')}}',
                        data: {
                            user: '{{\Illuminate\Support\Facades\Auth::user()->id}}',
                            friend: '{{$user->id}}',
                        },
                        error: function(xhr) {

                        },
                        success: function(response, status, xhr, $form) {
                            $('#buttonFriend').html('Удаление выполнено');
                        }
                    });
                });


                handleFormSubmit();
            });
    </script>
@endpush

