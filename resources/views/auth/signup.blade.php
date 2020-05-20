@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h3>Регистрация</h3>
            <form method="POST" action="{{route('signup.handle')}}" novalidate>
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" value="{{old('email')}}">
                    @if($errors->has('email'))
                        <span class="help-block text-danger" role="alert">
                            @foreach($errors->get('email') as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="username">Login</label>
                    <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" id="username" value="{{old('username')}}">
                    @if($errors->has('username'))
                        <span class="help-block text-danger" role="alert">
                            @foreach($errors->get('username') as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"  name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password">
                    @if($errors->has('password'))
                        <span class="help-block text-danger" role="alert">
                            @foreach($errors->get('password') as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Password Confirm</label>
                    <input type="password"  name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation">
                    @if($errors->has('password_confirmation'))
                        <span class="help-block text-danger" role="alert">
                            @foreach($errors->get('password_confirmation') as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Зарегестрироваться</button>
            </form>
        </div>
    </div>
@endsection
