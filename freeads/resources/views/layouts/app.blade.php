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
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Logo -->
                <div class="logo">
                    <a href="{{ url('/') }}" style="display: flex; align-items: center; gap: 8px;">
                        <span style="font-size: 28px; font-weight: 700; background: linear-gradient(135deg, var(--color-primary) 0%, #1557b0 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">FreeAds</span>
                    </a>
                </div>

                <!-- Main Navigation -->
                <nav style="flex: 1; margin: 0 48px;">
                    <ul style="display: flex; gap: 32px; align-items: center; justify-content: center;">
                        <li><a href="{{ url('/') }}" style="font-weight: 500;">Home</a></li>
                        <li><a href="{{ route('ads.index') }}" style="font-weight: 500;">Browse Ads</a></li>
                        {{-- @auth
                            <li><a href="{{ route('ads.my-ads') }}" style="font-weight: 500;">My Ads</a></li>
                        @endauth --}}
                    </ul>
                </nav>

                <!-- Right Side Actions -->
                <div style="display: flex; align-items: center; gap: 16px;">
                    @guest
                        <a href="{{ route('login') }}" style="font-weight: 500; color: var(--color-text-body);">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-secondary">Post an Ad</a>
                    @endguest
                    
                    @auth
                        <!-- User Menu Dropdown -->
                        <div style="position: relative;">
                            <button onclick="toggleUserMenu()" style="display: flex; align-items: center; gap: 8px; background: var(--color-bg-light); border: 1px solid var(--color-border); border-radius: 8px; padding: 8px 12px; cursor: pointer; font-weight: 500; color: var(--color-text-title);">
                                <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--color-primary) 0%, #1557b0 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px;">
                                    {{ strtoupper(substr(auth()->user()->login, 0, 1)) }}
                                </div>
                                <span>{{ auth()->user()->login }}</span>
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" style="transition: transform 0.2s;">
                                    <path d="M2 4L6 8L10 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </button>
                            
                            <div id="userMenu" style="display: none; position: absolute; right: 0; top: calc(100% + 8px); background: white; border: 1px solid var(--color-border); border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); min-width: 200px; z-index: 1000;">
                                <div style="padding: 12px 16px; border-bottom: 1px solid var(--color-border);">
                                    <div style="font-weight: 600; color: var(--color-text-title);">{{ auth()->user()->login }}</div>
                                    <div style="font-size: 13px; color: var(--color-text-body);">{{ auth()->user()->email }}</div>
                                </div>
                                <a href="{{ route('profile.edit') }}" style="display: block; padding: 12px 16px; color: var(--color-text-body); text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='var(--color-bg-light)'" onmouseout="this.style.background='white'">
                                    👤 Profile Settings
                                </a>
                                <a href="{{ route('ads.my-ads') }}" style="display: block; padding: 12px 16px; color: var(--color-text-body); text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='var(--color-bg-light)'" onmouseout="this.style.background='white'">
                                    📝 My Ads
                                </a>
                                <div style="border-top: 1px solid var(--color-border); padding: 8px;">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" style="width: 100%; text-align: left; padding: 8px 12px; background: none; border: none; color: var(--color-error); cursor: pointer; font-weight: 500; border-radius: 4px; transition: background 0.2s;" onmouseover="this.style.background='#fee'" onmouseout="this.style.background='transparent'">
                                            🚪 Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('ads.create') }}" class="btn btn-secondary">Post an Ad</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <script>
        function toggleUserMenu() {
            const menu = document.getElementById('userMenu');
            menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
        }

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('userMenu');
            const button = event.target.closest('button[onclick="toggleUserMenu()"]');
            if (!button && !menu.contains(event.target)) {
                menu.style.display = 'none';
            }
        });
    </script>

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