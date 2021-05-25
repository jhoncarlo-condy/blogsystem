<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        <link rel="icon" href="https://www.pngkey.com/png/full/232-2326777_blogger-logo-icons-no-attribution-white-blog-icon.png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            body {
            background-image: url('https://images.unsplash.com/photo-1518665750801-883c188a660d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=667&q=80');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            }


            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            {{-- @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/dashboard') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif --}}
            <img style="height:150px;widht:150px;"src="https://www.pngkey.com/png/full/232-2326777_blogger-logo-icons-no-attribution-white-blog-icon.png" alt="">

            <div class="content">

                <div class="title m-b-md">
                    <label>Blog</label>
                </div>
                @if (Route::has('login'))
                <div class="links">
                        @auth
                            @if (Auth::user()->usertype == 1)
                            <a href="{{ route('users.dashboard') }}">Home</a>
                            @elseif (Auth::user()->usertype == 2)
                            <a href="{{ route('users.dashboard') }}">Home</a>
                            @else
                            <a href="{{ route('post.index') }}">Home</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a><br><br>
                            <div class="links container mt-4">
                                <a href="{{ route('post.index') }}">Login as Guest</a>
                            </div>
                        @endauth
                    </div>
                </div>
                @endif

            </div>
        </div>
    </body>
</html>
