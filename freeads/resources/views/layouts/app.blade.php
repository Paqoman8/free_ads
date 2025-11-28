<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FreeAds') - Classified Ads</title>
    <meta name="description" content="Simple classified ads platform">
    <!-- FreeAds Design System -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header>
        <div class="container flex justify-between items-center">
            <div class="logo">
                <a href="{{ url('/') }}">FreeAds</a>
            </div>
            <nav>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('ads.index') }}">Browse Ads</a></li>
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}" class="btn btn-secondary">Post an Ad</a></li>
                    @endguest
                    @auth
                        <li><a href="{{ route('ads.my-ads') }}">My Ads</a></li>
                        <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit"
                                    style="background: none; border: none; color: var(--color-text-body); cursor: pointer; font-size: 16px; font-weight: 500;">Logout</button>
                            </form>
                        </li>
                        <li><a href="{{ route('ads.create') }}" class="btn btn-secondary">Post an Ad</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} FreeAds. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>