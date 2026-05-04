<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Elektronik</title>
    <style>
        nav { display: flex; justify-content: space-between; padding: 20px; background: #333; color: white; }
        nav a { color: white; text-decoration: none; margin: 0 10px; }
    </style>
</head>
<body>
    <nav>
        <div><strong>LOGO | Toko Elektronik</strong></div>
        <div>
            <a href="/">Home</a>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="/admin" style="color: yellow;">Dashboard Admin</a>
                @endif
                <form action="/logout" method="POST" style="display:inline">
                    @csrf <button type="submit">Logout</button>
                </form>
            @else
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            @endauth
        </div>
    </nav>

    <div style="padding: 20px;">
        @yield('content')
    </div>
</body>
</html>