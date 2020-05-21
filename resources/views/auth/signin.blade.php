@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h3>Вход</h3>
            <form method="POST" action="{{route('signin.post')}}" novalidate>
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
                <div class="custom-control custom-checkbox mb-2">
                    <input name="remember" type="checkbox" class="custom-control-input" id="remember">
                    <label class="custom-control-label" for="remember">Запомнить меня</label>
                </div>
                <button type="submit" class="btn btn-primary">Вход</button>
            </form>
        </div>
    </div>
@endsection

