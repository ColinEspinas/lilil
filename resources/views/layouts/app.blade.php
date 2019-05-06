<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ $pageName ?? 'Page' }} - Lilil</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" async></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/ColinEspinas/lilcss/css/utility.css'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/ColinEspinas/lilcss/css/grid.min.css'>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <div id="app">
        <nav class="main-nav">
            <ul class="main-nav-items">
                <li class="nav-item user-item"><button class="dropdown-btn" onclick="toggleDropdown('user');"><i data-feather="user" class="dropdown-icon"></i><div class="nav-status"></div></button>
                    <ul class="dropdown-item" id="user" style="display:none">
                        <li><a href=""><i data-feather="layout"></i><span>My profile</span></a></li>
                        <li><a href=""><i data-feather="user-check"></i><span>My follows</span></a></li>
                        <li><a href=""><i data-feather="settings"></i><span>Settings</span></a></li>
                        <li>
                            <a type="submit" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i data-feather="log-out"></i><span>Log out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            <li class="nav-item"><a href="{{ route('home') }}"><i data-feather="home"></i></a></li>
            <li class="nav-item"><a href="{{ route('home') }}"><i data-feather="search"></i></a></li>
            <li class="nav-item"><a href="{{ route('likes') }}"><i data-feather="heart"></i></a></li>
            </ul>
            <h3 class="username-display">{{ Auth::user()->pseudo }}</h3>
        </nav>
        <main class="main-content">
            @yield('content')
        </main>
    </div>
    <script>
        feather.replace()
    </script>
</body>

</html>
