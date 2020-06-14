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
                            <button type="submit" class="new_submit" >post</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function() {


            //global function for get button id
                   window.reply_click =  function(clicked_id)
                    {
                        var data = $('#form_' + clicked_id).serialize();
                        var post_id =  clicked_id;
                        var user_id = '{{\Illuminate\Support\Facades\Auth::user()->id}}';
                        $.ajax({
                            method: 'POST',
                            url: '{{route('comment.post')}}',
                            data: data + '&user_id=' +  user_id + '&post_id=' + post_id,
                            error: function (xhr) {
                                var response = jQuery.parseJSON(xhr.responseText);
                                if(response.errors.comment) {
                                    //if errors exist - show messages
                                    $('#error_' + clicked_id).html('');
                                    $('#error_' + clicked_id).css('display', 'block');
                                    $('#error_' + clicked_id).append(response.errors.comment);
                                    $('#error_' + clicked_id).delay(3000).fadeOut();
                                }
                            },
                            success: function (response, status, xhr) {
                                //reload comments data after added new comment
                                document.getElementById("posts").innerHTML = '';
                                getData();
                            },
                        });
                    }
                     function getData() {
                        $.ajax({
                            method: 'GET',
                            url: '{{route('post.getall')}}',
                            error: function () {
                            },
                            success: function (response, status, xhr, e) {
                                var result = jQuery.parseJSON(response);

                                if (result) {
                                    var Temp = document.getElementById("posts").innerHTML;
                                    for (var k in result) {
                                        Temp += ' <div class="panel panel-default post">\n' +
                                            '                            <div class="panel-body">\n' +
                                            '                                <div class="row">\n' +
                                            '                                    <div class="col-sm-2">\n' +
                                            '                                        <a href="profile.html" class="post-avatar thumbnail"><img src="/img/user.png" alt=""><div class="text-center">' + result[k].name + '</div></a>\n' +
                                            '                                        <div class="likes text-center" id="like_div_' + result[k].id + '" ></div>\n' +
                                            '                                    </div>\n' +
                                            '                                    <div class="col-sm-10">\n' +
                                            '                                        <div class="bubble">\n' +
                                            '                                            <div class="pointer">\n' +
                                            '                                                <p>' + result[k].caption + '</p>\n' +
                                            '                                            </div>\n' +
                                            '                                            <div class="pointer-border"></div>\n' +
                                            '                                        </div>\n' +
                                            '                                        <p class="text-right">' + result[k].created_at + '</p>\n' +
                                            '                                        <form id="form_' + result[k].id + '">@csrf<p class="post-actions"> - <a class="like" id="like_' + result[k].id + '" href="#">Like</a> - </p></form>\n' +
                                            '                                        <div class="comment-form">\n' +
                                            '                                            <form class="form-inline" id="form_' + result[k].id + '">\n' +
                                            '                                                <div class="alert alert-danger" id="error_' + result[k].id + '" role="alert" style="display:none"></div>\n' +
                                            '                                                <div class="form-group">\n' +
                                            '                                                    <input type="text" class="form-control" name="comment" id="comment_' + result[k].id + '" placeholder="enter comment">\n' +
                                            '                                                @csrf</div>\n' +
                                            '                                                <button type="button" id="' + result[k].id + '" class="btn btn-default" onClick="window.reply_click(this.id)">Add</button>\n' +
                                            '                                            </form>\n' +
                                            '                                        </div>\n' +
                                            '                                        <div class="clearfix"></div>\n' +
                                            '\n' +
                                            '                                        <div class="comments">\n';
                                                                                    for (var key in result[k].comments) {
                                                                                    Temp += '<div class="comment">\n' +
                                                '                                                <a href="/user/' + result[k].comments[key].user_id + '" class="comment-avatar pull-left"><img src="/img/user.png" alt="" title="' + result[k].comments[key].name + '"></a>\n' +
                                                '                                                <div class="comment-text">\n' +
                                                '                                                    <p>' + result[k].comments[key].caption + '</p>\n' +
                                                '                                                </div>\n' +
                                                '                                            </div>\n' +
                                                                                            '<p>' + result[k].comments[key].created_at + '</p>';
                                                                                    }
                                                                                    if(result[k].comments){
                                                                                        Temp += '<p><a id="shaw_all" href="#">Все комментарии</a></p>';
                                                                                    }
                                             Temp += '                                         <div class="clearfix">\n' +
                                            '                                            </div>\n' +
                                            '                                        </div>\n' +
                                            '                                    </div>\n' +
                                            '                                </div>\n' +
                                            '                            </div>\n' +
                                            '                        </div>';
                                        document.getElementById("posts").innerHTML = Temp;
                                    }

                                    function getLikes() {
                                        $.ajax({
                                            method: 'GET',
                                            url: '{{route('like.get')}}',
                                            error: function (xhr) {
                                            },
                                            success: function (response, status, xhr) {

                                                var result = jQuery.parseJSON(response);

                                                for (var k in result) {

                                                    $('#like_div_' + result[k].post_id).html(result[k].likes + ' Likes');
                                                }

                                            },
                                        });
                                    }
                                    getLikes();

                                    $(".like").on('click', function (e) {
                                        e.preventDefault();
                                        var post_id =  $(this).attr('id').slice(5);
                                        token = $('#form_' + post_id).find( $('input[name="_token"]')).val();
                                        console.log(token);
                                        var user_id = '{{\Illuminate\Support\Facades\Auth::user()->id}}';
                                        $.ajax({
                                            beforeSend: function(xhr) {
                                                xhr.setRequestHeader('X-CSRF-Token', token);
                                            },
                                            method: 'POST',
                                            url: '{{route('like.post')}}',
                                            data: {'user_id':  user_id, 'post_id': post_id},
                                            error: function (xhr) {

                                            },
                                            success: function (response, status, xhr) {
                                                getLikes();
                                            },
                                        });
                                    });





                                }
                            },
                        });
                    }

                    getData();


        });
    </script>

@endpush
