<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NusaOne - E-Commerce</title>
    <style>
        :root {
            --navy: #1B2A4E;
            --gold: #C9A227;
            --bg: #F8F9FA;
            --white: #FFFFFF;
            --border: #E2E8F0;
            --muted: #718096;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: var(--bg);
            color: var(--navy);
        }

        /* ===== HEADER / NAVBAR ===== */
        header {
            background-color: var(--navy);
            padding: 18px 48px 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
            min-height: 152px;
            border-bottom: 3px solid var(--gold);
            flex-wrap: wrap;
        }
        .logo {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            margin-left: 16px;
            background-color: var(--white);
            padding: 10px 18px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.18);
            transition: box-shadow 0.25s ease, transform 0.25s ease;
        }
        .logo:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
            transform: translateY(-1px);
        }
        .logo img {
            height: 135px;
            width: auto;
            display: block;
        }
        nav {
            display: flex;
            align-items: center;
            gap: 28px;
            margin-right: 16px;
            flex-wrap: wrap;
        }
        nav a {
            color: var(--white);
            text-decoration: none;
            font-weight: 700;
            font-size: 17px;
            padding: 8px 4px;
            border-bottom: 3px solid transparent;
            transition: color 0.2s ease, border-color 0.2s ease;
        }
        nav a:hover {
            color: var(--gold);
            border-bottom-color: var(--gold);
        }
        nav a.active {
            color: var(--gold);
            border-bottom-color: var(--gold);
        }

        /* ===== MAIN ===== */
        main {
            padding: 40px 50px;
            min-height: 70vh;
        }

        /* ===== FOOTER ===== */
        footer {
            background-color: var(--navy);
            color: var(--white);
            padding: 22px 20px;
            text-align: center;
            border-top: 3px solid var(--gold);
        }
        footer p {
            margin: 0;
        }

        @media (max-width: 768px) {
            header {
                padding: 16px 20px 12px;
                justify-content: center;
                min-height: auto;
            }
            .logo {
                margin-left: 0;
            }
            .logo img {
                height: 80px;
            }
            nav {
                margin-right: 0;
                justify-content: center;
                gap: 20px;
            }
            main {
                padding: 24px 18px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- 1. HEADER -->
    <header>
        <a href="/" class="logo">
            <img src="{{ asset('assets/images/nusaone-logo.svg') }}" alt="NusaOne">
        </a>
        <nav>
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Katalog</a>
            <a href="/checkout" class="{{ request()->is('checkout*') ? 'active' : '' }}">Keranjang</a>
        </nav>
    </header>

    <!-- 2. MAIN (Area Konten Dinamis) -->
    <main>
        @yield('konten_utama')
    </main>

    <!-- 3. FOOTER -->
    <footer>
        <p>&copy; 2026 Hak Cipta Dilindungi - NusaOne</p>
    </footer>

</body>
</html>
