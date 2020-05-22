@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h5>Редактирование Профиля</h5>
            <form method="POST" action="{{route('profile.update', ['user' => \Illuminate\Support\Facades\Auth::user()])}}" novalidate>
                @csrf

                @method('patch')
                <div class="form-group">
                    <label for="first_name">Имя</label>
                    <input type="text" name="first_name" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" id="first_name" value="{{old('first_name', \Illuminate\Support\Facades\Auth::user()->first_name)}}">
                    @if($errors->has('first_name'))
                        <span class="help-block text-danger" role="alert">
                            @foreach($errors->get('first_name') as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="last_name">Фамилия</label>
                    <input type="text" name="last_name" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" id="last_name" value="{{old('last_name', \Illuminate\Support\Facades\Auth::user()->last_name)}}">
                    @if($errors->has('last_name'))
                        <span class="help-block text-danger" role="alert">
                            @foreach($errors->get('last_name') as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="location">Локация</label>
                    <input type="text" name="location" class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" id="location" value="{{old('location', \Illuminate\Support\Facades\Auth::user()->location)}}">
                    @if($errors->has('location'))
                        <span class="help-block text-danger" role="alert">
                            @foreach($errors->get('location') as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Обновить данные</button>
            </form>
        </div>
    </div>
@endsection
