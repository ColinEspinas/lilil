<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lilil</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

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
    <div class="lil-row height-100">
        <div class="lil-col xs-12-12 md-6-12 lg-4-12">
            <div class="signup-panel width-100 height-100">
                <header class="height-50 width-100">
                    <div class="lil-row middle height-100 width-100">
                        <div class="lil-col 12-12">
                            <h1 class="brand-title text-center">lilil</h1>
                            <h3 class="brand-slogan text-center">The little social network</h3>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="lil-row center">
                        <form action="{{ route('register') }}" method="POST" class="lil-col lg-6-12" id="signup-form" style="display:{{ !Session::get('signForm') || Session::get('signForm') == 'register' ? 'block' : 'none' }}">
                            @csrf
                            <input type="text" name="name" placeholder="Name" class="margin-tb-15 width-100 center" value="{{ old('username') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="right error-message" role="alert">{{ $message }}</span>
                            @enderror
                            <input type="email" name="email" placeholder="Email address" class="margin-tb-15 width-100 center" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="right error-message" role="alert">{{ $message }}</span>
                            @enderror
                            <input type="password" name="password" placeholder="Password" class="margin-tb-15 width-100 center" required autocomplete="new-password">
                            @error('password')
                                <span class="right error-message" role="alert">{{ $message }}</span>
                            @enderror
                            <input type="password" name="password_confirmation" placeholder="Confirm password" class="margin-tb-15 width-100 center" required autocomplete="new-password">
                            <button type="submit" class="btn margin-tb-15 width-100">Sign up</button>
                            <p class="margin-tb-5 text-center"><small>Already have an account? <a onclick="swapSignForms(true)">Log in</a>.</small></p>
                        </form>
                        <form action="{{ route('login') }}" method="POST" class="lil-col lg-6-12" id="login-form" style="display:{{ Session::get('signForm') == 'login' ? 'block' : 'none' }}">
                            @csrf
                            <input type="email" name="email" placeholder="Email address" class="margin-tb-15 width-100 center" value="{{ old('email') }}" required autocomplete="name" autofocus>
                            @error('email')
                                <span class="right error-message" role="alert">{{ $message }}</span>
                            @enderror
                            <input type="password" name="password" placeholder="Password" class="margin-tb-15 width-100 center" required autocomplete="current-password">
                            @error('password')
                                <span class="right error-message" role="alert">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="btn margin-tb-15 width-100">Log in</button>
                            <p class="margin-tb-5 text-center"><small>Don't have an account? <a onclick="swapSignForms(false)">Sign up</a>.</small></p>
                        </form>
                    </div>
                </main>
            </div>
        </div>
        <div class="signup-side lil-col xs-0-12 md-6-12 lg-8-12"></div>
    </div>
    <script>
        feather.replace()
    </script>
</body>

</html>
