<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@4.4.1/dist/css/bootstrap-icons.min.css">

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-color" style="background-color: #CCE5FF; height:100px;">
            <div class="container">
                <!-- Search Box -->
                <div class="nav-item mx-2">
                    <input type="text" id="search" placeholder="Type to search for a topic"
                        style="height:50px; width:230px; text-align:center">
                </div>

                <!-- Leaderboard -->
                <div class="nav-item mx-2">
                    <a href="/leaderboard"
                        style="text-decoration:none; font-family: 'Fredoka One', sans-serif; font-size:28px; color:#330066;">Leaderboard</a>
                </div>

                <!-- My Collections, Badges, Profile and Sign In/Log Out -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="display:none">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby=" userDropdown">
                        <a class="dropdown-item" href="/collections">My Collections</a>
                        <a class="dropdown-item" href="/badges">Badges</a>
                        <a class="dropdown-item" href="/profile">Profile</a>
                        <hr>
                        <a class="dropdown-item" href="/signIn">Sign In</a>
                        <!--signIn/signOut if else-->
                    </div>
                    <img src="images/AvatarIcon.png" alt="Avatar" id="avatar">
                </div>

                <!-- Modules -->
                <div class="nav-item mx-2">
                    <a href="/modules"
                        style="text-decoration:none; font-family: 'Fredoka One', sans-serif; font-size:28px; color:#330066;">Modules</a>
                </div>

                <!-- Logo -->
                <div class="nav-item mx-2">
                    <img src="images/SciLearn.png" alt="SciLearn" class="my-image img-fluid"
                        style="width: 180px; height: 90px">
                </div>
            </div>
        </nav>

    </header>


    <div class=" container">
        @yield('content')
    </div>

    <footer>
        <p style="font-size:1em; text-align:center">@SciLearn and the SciLearn logo are trademarks and/or registered
            trademarks of UTAR.
            2023 UTAR, all rights
            reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- search function -->
    <script>
    $('#search').keypress(function(e) {
        if (e.which == 13) {
            var query = $(this).val().trim();
            window.location.href = '/search?q=' + encodeURIComponent(query);
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