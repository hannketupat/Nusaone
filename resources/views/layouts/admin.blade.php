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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
            line-height: 1.5;
        }

        /* Topbar Putih */
        .topbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 32px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }
        .topbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #0f172a;
        }
        .topbar-brand .badge-admin {
            background-color: #0f172a;
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .topbar-brand h1 {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.3px;
        }
        .topbar-brand h1 span {
            color: #2563eb;
        }

        /* Menu Navigasi */
        .topbar-nav {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nav-item {
            text-decoration: none;
            color: #64748b;
            font-size: 14px;
            font-weight: 600;
            padding: 8px 14px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .nav-item:hover {
            color: #0f172a;
            background-color: #f1f5f9;
        }
        .nav-item.active {
            color: #2563eb;
            background-color: #eff6ff;
            font-weight: 700;
        }
        .nav-item-btn {
            background-color: #2563eb;
            color: #ffffff !important;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .nav-item-btn:hover {
            background-color: #1d4ed8;
        }
        .nav-item-store {
            color: #475569;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .nav-item-store:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
            color: #0f172a;
        }

        /* Container Konten */
        main {
            padding: 32px;
            max-width: 1280px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .topbar {
                height: auto;
                padding: 16px 20px;
                flex-direction: column;
                gap: 14px;
            }
            .topbar-nav {
                flex-wrap: wrap;
                justify-content: center;
            }
            main {
                padding: 20px 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Topbar Putih dengan Navigasi Menu -->
    <header class="topbar">
        <a href="/admin/transactions" class="topbar-brand">
            <span class="badge-admin">Admin</span>
            <h1>Nusa<span>One</span></h1>
        </a>

        <nav class="topbar-nav">
            <a href="/admin/transactions" class="nav-item {{ request()->is('admin/transactions*') ? 'active' : '' }}">
                Pesanan Masuk
            </a>
            <a href="/admin/products" class="nav-item {{ request()->is('admin/products') ? 'active' : '' }}">
                Katalog Produk
            </a>
            <a href="/admin/products/create" class="nav-item-btn">
                + Tambah Produk
            </a>
            <a href="/" target="_blank" class="nav-item-store">
                Lihat Toko Depan &rarr;
            </a>
        </nav>
    </header>

    <!-- Konten Utama Admin -->
    <main>
        @yield('konten_admin')
    </main>
</body>
</html>
