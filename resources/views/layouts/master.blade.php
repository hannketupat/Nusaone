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
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #0f172a; }
        .store-header { position: sticky; top: 0; height: 76px; padding: 0 48px; background-color: #ffffff; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; gap: 32px; z-index: 100; }
        .store-brand { color: #0B5ED7; font-size: 22px; font-weight: 800; letter-spacing: -0.5px; text-decoration: none; }
        .header-search-form { flex: 1; display: flex; align-items: center; gap: 8px; max-width: 560px; background-color: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 12px; padding: 5px 5px 5px 16px; transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s; }
        .header-search-form:focus-within { background-color: #ffffff; border-color: #0B5ED7; box-shadow: 0 0 0 3px rgba(11, 94, 215, 0.12); }
        .header-search-input { flex: 1; border: none; outline: none; background: transparent; font-family: inherit; font-size: 14px; font-weight: 500; color: #0f172a; padding: 9px 0; }
        .header-search-input::placeholder { color: #94a3b8; font-weight: 500; }
        .header-search-btn { background-color: #0B5ED7; color: #ffffff; border: none; padding: 10px 20px; border-radius: 9px; font-family: inherit; font-size: 14px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 7px; transition: background-color 0.2s, transform 0.2s; }
        .header-search-btn:hover { background-color: #094bac; transform: translateY(-1px); }
        .store-nav { display: flex; align-items: center; gap: 14px; flex-shrink: 0; flex-wrap: wrap; }
        .nav-seller-btn { background-color: #0B5ED7; color: #ffffff; padding: 10px 18px; border-radius: 10px; font-weight: 700; font-size: 14px; text-decoration: none; display: inline-block; }
        .nav-seller-btn:hover { background-color: #094bac; }
        .nav-outline-btn { background-color: #ffffff; color: #0B5ED7; border: 1px solid #bfdbfe; padding: 9px 16px; border-radius: 10px; font-weight: 700; font-size: 14px; text-decoration: none; display: inline-block; }
        .nav-outline-btn:hover { background-color: #eff6ff; }
        .nav-link { color: #0B5ED7; font-size: 14px; font-weight: 700; text-decoration: none; }
        .nav-link:hover { text-decoration: underline; }
        .nav-user { font-size: 14px; font-weight: 700; color: #0f172a; white-space: nowrap; }
        .nav-user span { display: block; font-size: 11px; font-weight: 600; color: #64748b; }
        .btn-logout { background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca; padding: 9px 15px; border-radius: 10px; font-family: inherit; font-size: 14px; font-weight: 700; cursor: pointer; }
        .btn-logout:hover { background-color: #fee2e2; }
        .flash-message { padding: 13px 18px; border-radius: 10px; font-size: 14px; font-weight: 600; margin-bottom: 22px; }
        .flash-success { background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .flash-status { background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; }
        main { padding: 40px 50px; min-height: 70vh; max-width: 1280px; margin: 0 auto; }
        .store-footer { background-color: #0f172a; color: #ffffff; padding: 22px 20px; text-align: center; }
        .store-footer p { margin: 0; }
        @media (max-width: 768px) { main { padding: 24px 18px; } .store-nav { gap: 10px; } .nav-user { width: 100%; } }
    </style>
    @yield('styles')
</head>
<body>

    <!-- 1. HEADER TOKO (Front-Store) -->
    <header class="store-header navbar">
        <a href="/" class="store-brand">NUSAONE</a>

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
