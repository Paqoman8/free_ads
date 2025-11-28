<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FreeAds') - Classified Ads</title>
    <meta name="description" content="Simple classified ads platform">
    <!-- Custom Styles -->
    <style>
        /* Basic Utility Classes */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
        .flex { display: flex; }
        .justify-between { justify-content: space-between; }
        .items-center { align-items: center; }
        .btn { padding: 0.5rem 1rem; text-decoration: none; background: #eee; color: #333; border-radius: 4px; }
        .btn-primary { background: #007bff; color: white; }
        header { border-bottom: 1px solid #eee; padding: 1rem 0; margin-bottom: 2rem; }
        footer { border-top: 1px solid #eee; padding: 2rem 0; margin-top: 4rem; text-align: center; color: #666; }
    </style>
</head>
<body>
    <header>
        <div class="container flex justify-between items-center">
            <div class="logo">
                <a href="{{ url('/') }}" style="font-weight: bold; font-size: 1.5rem; text-decoration: none; color: #333;">FreeAds</a>
            </div>
            <nav>
                <ul class="flex" style="list-style: none; gap: 1rem; margin: 0; padding: 0;">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/ads') }}">Browse Ads</a></li>
                    <!-- Auth Links Placeholder -->
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}" class="btn btn-primary">Post an Ad</a></li>
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
