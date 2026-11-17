<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - NusaOne</title>
    <!-- Google Font Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0A192F;
            --gold: #C5A059;
            --gold-hover: #b38e44;
            --white: #ffffff;
            --bg: #F8F9FA;
            --border: #e2e8f0;
            --muted: #64748b;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F9FA; color: #0A192F; line-height: 1.5; }
        .topbar { background-color: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 0 48px; height: 68px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; box-shadow: 0 2px 8px rgba(10, 25, 47, 0.04); }
        .topbar-brand { display: flex; align-items: center; gap: 12px; text-decoration: none; color: #0A192F; }
        .topbar-brand .badge-admin { background-color: #0A192F; color: #C5A059; border: 1px solid #C5A059; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 6px; letter-spacing: 0.5px; text-transform: uppercase; }
        .topbar-brand h1 { font-size: 18px; font-weight: 800; color: #0A192F; letter-spacing: -0.3px; }
        .topbar-brand h1 span { color: #C5A059; }
        .topbar-nav { display: flex; align-items: center; gap: 8px; margin-left: auto; }
        .nav-item { text-decoration: none; color: #0A192F; font-size: 14px; font-weight: 600; padding: 8px 14px; border-radius: 8px; transition: all 0.2s ease; border: 1px solid transparent; }
        .nav-item:hover { color: #C5A059; background-color: #F8F9FA; border-color: #C5A059; }
        .nav-item.active { color: #0A192F; background-color: #FDFBF7; border-color: #C5A059; font-weight: 700; }
        .nav-item-btn { background-color: #0A192F; color: #ffffff; padding: 8px 16px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 14px; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 6px; border: 1px solid #0A192F; }
        .nav-item-btn:hover { background-color: #C5A059; border-color: #C5A059; color: #ffffff; }
        .nav-item-store { color: #0A192F; text-decoration: none; font-size: 14px; font-weight: 600; padding: 8px 14px; border-radius: 8px; border: 1px solid #e2e8f0; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 6px; }
        .nav-item-store:hover { background-color: #F8F9FA; border-color: #C5A059; color: #C5A059; }
        main { padding: 32px; max-width: 1280px; margin: 0 auto; }
        .container-admin { padding: 32px; max-width: 1280px; margin: 0 auto; }
        footer { background-color: #0A192F; color: #ffffff; padding: 24px 20px; text-align: center; border-top: 2px solid #C5A059; }
        footer p { margin: 0; font-size: 13px; }
        @media (max-width: 768px) {
            .topbar { height: auto; padding: 16px 20px; flex-direction: column; gap: 14px; }
            .topbar-nav { flex-wrap: wrap; justify-content: center; }
            main { padding: 20px 16px; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <a href="/admin/transactions" class="topbar-brand">
            <span class="badge-admin">SELLER CENTER</span>
            <h1>Portal Manajemen Toko</h1>
        </a>

        <nav class="topbar-nav">
            <a href="/admin/transactions" class="nav-item {{ request()->is('admin/transactions*') ? 'active' : '' }}">
                Pesanan Masuk
            </a>
            <a href="/admin/products" class="nav-item {{ request()->is('admin/products*') ? 'active' : '' }}">
                Katalog Produk
            </a>
            <a href="/admin/products/create" class="nav-item-btn">
                + Tambah Produk
            </a>
            <a href="/" target="_blank" class="nav-item-store">
                Dashboard Toko &rarr;
            </a>
        </nav>

        @auth
            <div style="display:flex; align-items:center; gap:12px; margin-left:12px; padding-left:16px; border-left:1px solid #e2e8f0;">
                <div style="text-align:right;">
                    <span style="display:block; font-size:11px; color:#64748b; font-weight:600;">Admin Aktif</span>
                    <strong style="font-size:13px; color:#0f172a;">{{ Auth::user()->name }}</strong>
                </div>
                <form action="/logout" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" style="background-color:#fef2f2; color:#dc2626; border:1px solid #fecaca; padding:8px 14px; border-radius:8px; font-family:inherit; font-size:13px; font-weight:700; cursor:pointer;">Keluar</button>
                </form>
            </div>
        @endauth
    </header>

    <main class="container-admin">
        @yield('konten_admin')
    </main>

    <footer>
        <p>Portal Seller Center &bull; Kompetensi Keahlian Rekayasa Perangkat Lunak - SMK Plus Pelita Nusantara</p>
    </footer>
</body>
</html>
