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
                    <div id="posts">
                    {{--     ajax data     --}}
                    </div>
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

@push('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function() {

                    $.ajax({
                        method: 'GET',
                        url: '{{route('post.getall')}}',
                        error: function() {
                        },
                        success: function(response, status, xhr, $form) {
                            var result = jQuery.parseJSON(response);
                            console.log(result);
                            if(result) {
                                var Temp = document.getElementById("posts").innerHTML;
                                for (var k in result) {
                                    Temp += ' <div class="panel panel-default post">\n' +
                                        '                            <div class="panel-body">\n' +
                                        '                                <div class="row">\n' +
                                        '                                    <div class="col-sm-2">\n' +
                                        '                                        <a href="profile.html" class="post-avatar thumbnail"><img src="/img/user.png" alt=""><div class="text-center">' + result[k].name + '</div></a>\n' +
                                        '                                        <div class="likes text-center">7 Likes</div>\n' +
                                        '                                    </div>\n' +
                                        '                                    <div class="col-sm-10">\n' +
                                        '                                        <div class="bubble">\n' +
                                        '                                            <div class="pointer">\n' +
                                        '                                                <p>' + result[k].caption + '</p>\n' +
                                        '                                            </div>\n' +
                                        '                                            <div class="pointer-border"></div>\n' +
                                        '                                        </div>\n' +
                                        '                                        <p class="text-right">' + result[k].created_at + '</p>\n' +
                                        '                                        <p class="post-actions"><a href="#">Comment</a> - <a href="#">Like</a> - <a href="#">Follow</a> - <a href="#">Share</a></p>\n' +
                                        '                                        <div class="comment-form">\n' +
                                        '                                            <form class="form-inline">\n' +
                                        '                                                <div class="form-group">\n' +
                                        '                                                    <input type="text" class="form-control" placeholder="enter comment">\n' +
                                        '                                                </div>\n' +
                                        '                                                <button type="submit" class="btn btn-default">Add</button>\n' +
                                        '                                            </form>\n' +
                                        '                                        </div>\n' +
                                        '                                        <div class="clearfix"></div>\n' +
                                        '\n' +
                                        '                                        <div class="comments">\n';
                                        for(var key in result[k].comments)
                                        {
                                            Temp +=                                     '<div class="comment">\n' +
                                            '                                                <a href="/user/' + result[k].comments[key].user_id +  '" class="comment-avatar pull-left"><img src="/img/user.png" alt="" title="' + result[k].comments[key].name + '"></a>\n' +
                                            '                                                <div class="comment-text">\n' +
                                            '                                                    <p>' + result[k].comments[key].caption + '</p>\n' +
                                            '                                                </div>\n'+
                                            '                                            </div>\n'+
                                            '<p>' + result[k].comments[key].created_at + '</p>';
                                        }
                                    Temp +=    '                                            <div class="clearfix">\n' +
                                        '                                            </div>\n' +
                                        '                                        </div>\n' +
                                        '                                    </div>\n' +
                                        '                                </div>\n' +
                                        '                            </div>\n' +
                                        '                        </div>';
                                    document.getElementById("posts").innerHTML = Temp;
                                }
                            }
                        },
                    });
        });
    </script>

@endpush
