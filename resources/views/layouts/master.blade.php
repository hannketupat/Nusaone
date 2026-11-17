<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NusaOne - E-Commerce</title>
    <!-- Google Font Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0A192F;
            --navy-dark: #071224;
            --navy-light: #162a4a;
            --gold: #C5A059;
            --gold-hover: #b38e44;
            --white: #ffffff;
            --bg: #F8F9FA;
            --border: #e2e8f0;
            --muted: #64748b;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F9FA; color: #0A192F; }
        .store-header { position: sticky; top: 0; height: 76px; padding: 0 48px; background-color: #ffffff; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; gap: 32px; z-index: 100; box-shadow: 0 2px 8px rgba(10, 25, 47, 0.04); }
        .store-brand { color: #0A192F; font-size: 22px; font-weight: 800; letter-spacing: -0.5px; text-decoration: none; transition: color 0.2s ease; }
        .store-brand:hover { color: #C5A059; }
        .store-brand span { color: #C5A059; }
        .header-search-form { flex: 1; display: flex; align-items: center; gap: 8px; max-width: 560px; background-color: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 12px; padding: 5px 5px 5px 16px; transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s; }
        .header-search-form:focus-within { background-color: #ffffff; border-color: #C5A059; box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.15); }
        .header-search-input { flex: 1; border: none; outline: none; background: transparent; font-family: inherit; font-size: 14px; font-weight: 500; color: #0A192F; padding: 9px 0; }
        .header-search-input::placeholder { color: #94a3b8; font-weight: 500; }
        .header-search-btn { background-color: #0A192F; color: #ffffff; border: 1px solid #0A192F; padding: 10px 20px; border-radius: 9px; font-family: inherit; font-size: 14px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 7px; transition: all 0.2s ease; }
        .header-search-btn:hover { background-color: #C5A059; border-color: #C5A059; color: #ffffff; transform: translateY(-1px); }
        .store-nav { display: flex; align-items: center; gap: 14px; flex-shrink: 0; flex-wrap: wrap; }
        .nav-seller-btn { background-color: #0A192F; color: #ffffff; border: 1px solid #0A192F; padding: 10px 18px; border-radius: 10px; font-weight: 700; font-size: 14px; text-decoration: none; display: inline-block; transition: all 0.2s ease; }
        .nav-seller-btn:hover { background-color: #C5A059; border-color: #C5A059; color: #ffffff; }
        .nav-outline-btn { background-color: #ffffff; color: #0A192F; border: 1px solid #C5A059; padding: 9px 16px; border-radius: 10px; font-weight: 700; font-size: 14px; text-decoration: none; display: inline-block; transition: all 0.2s ease; }
        .nav-outline-btn:hover { background-color: #C5A059; color: #ffffff; }
        .nav-link { color: #0A192F; font-size: 14px; font-weight: 700; text-decoration: none; transition: color 0.2s ease; }
        .nav-link:hover { color: #C5A059; text-decoration: none; }
        .nav-user { font-size: 14px; font-weight: 700; color: #0A192F; white-space: nowrap; }
        .nav-user span { display: block; font-size: 11px; font-weight: 600; color: #64748b; }
        .btn-logout { background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca; padding: 9px 15px; border-radius: 10px; font-family: inherit; font-size: 14px; font-weight: 700; cursor: pointer; transition: background-color 0.2s ease; }
        .btn-logout:hover { background-color: #fee2e2; }
        .flash-message { padding: 13px 18px; border-radius: 10px; font-size: 14px; font-weight: 600; margin-bottom: 22px; }
        .flash-success { background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .flash-status { background-color: #F8F9FA; color: #0A192F; border: 1px solid #C5A059; }
        main { padding: 40px 50px; min-height: 70vh; max-width: 1280px; margin: 0 auto; }
        .store-footer { background-color: #0A192F; color: #ffffff; padding: 26px 20px; text-align: center; border-top: 2px solid #C5A059; }
        .store-footer p { margin: 0; font-size: 14px; }
        .store-footer p { margin: 0; }
        @media (max-width: 768px) { main { padding: 24px 18px; } .store-nav { gap: 10px; } .nav-user { width: 100%; } }
    </style>
    @yield('styles')
</head>
<body>

    <!-- 1. HEADER TOKO (Front-Store) -->
    <header class="store-header navbar">
        <a href="/" class="store-brand">NUSA<span>ONE</span></a>

        <form action="/" method="GET" class="header-search-form">
            <input type="text" name="search" class="header-search-input" placeholder="Cari produk busana, batik, atau kerajinan..." value="{{ request('search') }}">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if(request('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif
            <button type="submit" class="header-search-btn">
                Cari
            </button>
        </form>

        <nav class="store-nav">
            @guest
                <a href="/login" class="nav-outline-btn">Masuk</a>
                <a href="/register" class="nav-seller-btn">Daftar</a>
            @else
                @if(Auth::user()->role === 'admin')
                    <div class="nav-user">
                        <span>Seller:</span>
                        {{ Auth::user()->name }}
                    </div>
                    <a href="/admin/transactions" class="nav-seller-btn">Panel Seller</a>
                @else
                    <div class="nav-user">
                        <span>Halo,</span>
                        {{ Auth::user()->name }}
                    </div>
                    <a href="/pesanan-saya" class="nav-link">Pesanan Saya</a>
                @endif
                <form action="/logout" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            @endguest
        </nav>
    </header>

    <!-- 2. MAIN (Area Konten Dinamis) -->
    <main class="store-main">
        @if(session('success'))
            <div class="flash-message flash-success">{{ session('success') }}</div>
        @endif
        @if(session('status'))
            <div class="flash-message flash-status">{{ session('status') }}</div>
        @endif

        @yield('konten')
    </main>

    <!-- 3. FOOTER -->
    <footer class="store-footer footer">
        <p>&copy; 2026 Hak Cipta Dilindungi - NusaOne</p>
    </footer>

</body>
</html>
