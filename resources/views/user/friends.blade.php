@extends('templates.default')

@section('title', 'Добро пожаловать')

@section('content')
    <div class="row">
        <div class="col-lg-6">
           <h5>Your friends</h5>
            @if(!$friends->count())
                <p>List is empty :(</p>
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
            <h5>Requests</h5>
            @if(!$requests->count())
                <p>List is empty :(</p>
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
                        <div>
                            <a id="addFriend" class="btn btn-success">Принять заявку</a>
                            <a id="deleteFriend" class="btn btn-danger">Отклонить заявку</a>
                            <input type="hidden" id="id_friend" value="{{$friend->id}}">
                            @csrf
                        </div>
                    </div>
                    <hr>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#addFriend').click(function(e) {
            let token = $('input[name="_token"]').val();
            e.preventDefault();
            let friend = $('#id_friend').val();
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', token);
                },
                method: 'POST',
                url: '{{route('accept.post')}}',
                data: {
                    user: '{{\Illuminate\Support\Facades\Auth::user()->id}}',
                    friend: friend,
                },
                error: function(xhr) {

                },
                success: function(response, status, xhr, $form) {

                }
            });
        });

        $('#deleteFriend').click(function(e) {
            let token = $('input[name="_token"]').val();
            e.preventDefault();
            let friend = $('#id_friend').val();
            console.log(friend)
            $.ajax({
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', token);
                },
                method: 'POST',
                url: '{{route('deletefriend.post')}}',
                data: {
                    user: '{{\Illuminate\Support\Facades\Auth::user()->id}}',
                    friend: friend,
                },
                error: function(xhr) {

                },
                success: function(response, status, xhr, $form) {
                    $('#buttonFriend').html('Удаление выполнено');
                }
            });
        });
    </script>
@endpush
