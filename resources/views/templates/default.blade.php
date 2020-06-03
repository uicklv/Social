<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Bootstrap core CSS -->
        <link href="/css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="/css/style.css" rel="stylesheet">
        <link href="/css/font-awesome.css" rel="stylesheet">
        @stack('css')
    </head>

    <body>

    <header>
        <div class="container">
            <img src="/img/logo.png" class="logo" alt="">
        </div>
    </header>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                @if(\Illuminate\Support\Facades\Auth::check())
                <ul class="nav navbar-nav">
                    <li @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'startpage') class="active" @endif><a href="{{route('startpage')}}">Home</a></li>
                    <li><a href="members.html">Members</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="groups.html">Groups</a></li>
                    <li><a href="photos.html">Photos</a></li>
                    <li @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'profile.getprofile') class="active" @endif><a href="{{route('profile.getprofile', ['user' => \Illuminate\Support\Facades\Auth::user()])}}">Profile</a></li>
                    <li><a href="{{route('logout')}}">Logout</a></li>
                </ul>
                @else
                    <ul class="nav navbar-nav">
                        <li class="{{request()->is('/') ? 'active' : '' }}"><a href="{{route('signin.get')}}">Sign in</a></li>
                        <li class="{{request()->is('signup') ? 'active' : '' }}"><a href="{{route('signup.index')}}">Sign up</a></li>
                    </ul>
                @endif
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <section>
        <div class="container">
            @yield('content')
        </div>
    </section>

    <footer>
        <div class="container">
            <p>Dobble Copyright &copy, 2015</p>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    @stack('scripts')
    </body>
</html>
