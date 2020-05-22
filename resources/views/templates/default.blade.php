<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="/fontawesome.css" rel="stylesheet">
    @stack('css')
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
                <a class="navbar-brand" href="{{route('home')}}">SOC</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @if(!\Illuminate\Support\Facades\Auth::user())
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('signup.index')}}">Регистрация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('signin.get')}}">Вход</a>
                        </li>
                    </ul>
                </div>
                @else
                <form class="form-inline" method="GET" action="{{route('search.results')}}">
                    <input class="form-control mr-sm-2" name="query" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{\Illuminate\Support\Facades\Auth::user()->getNameorUsername()}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('logout')}}">Выход</a>
                    </div>
                </div>
                @endif

        </div>
    </nav>
        <div class="container">
            <div class="row mb-4">
                    <div class="col align-middle" style="height:50px">
                        @if(session()->has('info'))
                                <div class="alert alert-primary mt-2" role="alert">
                                {{session()->get('info')}}
                                </div>
                        @endif
                    </div>
            </div>
            <div class="row">
                <div class="col">
                    @if(\Illuminate\Support\Facades\Auth::check())
                    <ul class="nav flex-column mt-4">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('profile.getprofile', ['user' => \Illuminate\Support\Facades\Auth::user()->id])}}">Мой профиль</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('friends.index')}}">Мои друзья</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('profile.edit')}}">Редактирование профиля</a>
                        </li>
                    </ul>
                    @endif
                </div>
                <div class="col-9">
                    @yield('content')
                </div>
            </div>
        </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
@stack('scripts')
</body>
</html>
