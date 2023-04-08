<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta property="og:title" content="SciLearn - Science Learning Hub" />
    <meta name="author" content="Ling Sun Shuai, Lim Choon Kiat, Olivia Ong Yee Ming, Tan Jia Qi, Yang Chu Yan">
    <!-- <link rel="icon" href="~/images/logo" type="image/x-icon" /> -->
    <meta property="og:description" content="This website allows kids age between 6 to 8 to learn Science." />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SciLearn - @yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <!-- public/css/styles.css -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- public/js/app.js -->
    <script src="{{asset('js/app.js')}}" type="module"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-color">
            <div class="container">
                <!-- Search Box -->
                <div class="nav-item mx-2">
                    <form method="POST" action="{{ route('search') }}">
                        @csrf
                        <input type="text" name="q" id="search" placeholder="Type to search for a topic">
                    </form>
                </div>

                <!-- Leaderboard -->
                <div class="nav-item mx-2 leaderboard">
                    <a href="/leaderboard">Leaderboard</a>
                </div>

                <!-- My Collections, Badges, Profile and Sign In/Log Out -->
                <div class="dropdown">
                    <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby=" userDropdown">
                        @if (Auth::guard(session('role'))->user())
                        <a class="dropdown-item" href="/collections">My Collections</a>
                        <a class="dropdown-item" href="/badges">Badges</a>
                        <a class="dropdown-item" href="/students/profile">Profile</a>
                        <hr>
                        <a class="dropdown-item" href="/logout">Logout</a>
                        <!-- 
								admin view

							-->
                        @else
                        <a class="dropdown-item" href="/login/student">Login</a>
                        <a class="dropdown-item" href="/register/student">Sign Up</a>
                        @endif
                    </div>
                    <img src="/images/AvatarIcon.png" alt="Avatar" id="avatar">
                </div>

                <!-- Modules -->
                <div class="nav-item mx-2 module">
                    <a href="/modules">Modules</a>
                </div>

                <!-- Logo -->
                <div class="nav-item mx-2">
                    <a href="/home">
                        <img src="/images/SciLearn.png" alt="SciLearn" class="my-image img-fluid logo">
                    </a>
                </div>
            </div>
        </nav>

    </header>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <p>@SciLearn and the SciLearn logo are trademarks and/or registered
            trademarks of UTAR.
            {{date("Y")}} UTAR, all rights
            reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- search function -->
    <script>
    $('#search').keypress(function(e) {
        if (e.which == 13) {
            $(this).closest('form').submit();
            return false;
        }
    });
    </script>

    <!-- dropdown -->
    <script>
    $(document).ready(function() {
        $('#avatar').on('click', function() {
            $('#dropdown').dropdown('toggle');
        });
    });
    </script>

</body>

</html>