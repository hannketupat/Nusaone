<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - NusaOne</title>
    <!-- Google Font Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F9FA; min-height: 100vh; padding: 24px; display: flex; align-items: center; justify-content: center; }
        .login-box { background-color: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; max-width: 430px; width: 100%; padding: 40px 36px; box-shadow: 0 14px 34px rgba(10, 25, 47, 0.08); }
        .seller-tag { display: inline-block; background-color: #0A192F; color: #C5A059; border: 1px solid #C5A059; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; padding: 5px 10px; border-radius: 6px; margin-bottom: 16px; }
        .login-box h1 { font-size: 26px; font-weight: 800; color: #0A192F; letter-spacing: -0.4px; margin-bottom: 8px; }
        .login-box .login-desc { color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 26px; }
        .input-group { margin-bottom: 18px; }
        .input-label { display: block; font-size: 13px; font-weight: 700; color: #0A192F; margin-bottom: 7px; }
        .input-field { width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; font-family: inherit; color: #0A192F; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
        .input-field:focus { border-color: #C5A059; box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.15); }
        .password-field-wrap { position: relative; }
        .password-field-wrap .input-field { padding-right: 110px; }
        .toggle-password-btn { position: absolute; right: 8px; top: 50%; transform: translateY(-50%); background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; padding: 5px 12px; border-radius: 8px; font-family: inherit; font-size: 12px; font-weight: 700; cursor: pointer; }
        .remember-group { display: flex; align-items: center; gap: 8px; margin-bottom: 22px; }
        .remember-group input { accent-color: #0A192F; width: 16px; height: 16px; cursor: pointer; }
        .remember-group label { font-size: 13px; font-weight: 500; color: #475569; cursor: pointer; }
        .btn-submit { width: 100%; background-color: #0A192F; color: #ffffff; border: 1px solid #0A192F; padding: 13px 24px; border-radius: 10px; font-family: inherit; font-size: 15px; font-weight: 700; cursor: pointer; transition: all 0.2s ease; }
        .btn-submit:hover { background-color: #C5A059; border-color: #C5A059; color: #ffffff; }
        .login-footer { margin-top: 22px; text-align: center; }
        .login-footer a { color: #64748b; text-decoration: none; font-size: 13px; font-weight: 600; transition: color 0.2s; }
        .login-footer a:hover { color: #C5A059; }
        .alert-success { background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; padding: 14px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; font-weight: 500; }
        .alert-error { background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca; padding: 14px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; font-weight: 500; }
    </style>
</head>
<body>
    <div class="login-box">
        <span class="seller-tag">NUSAONE STORE</span>
        <h1>Masuk ke Akun Anda</h1>
        <p class="login-desc">Masuk sebagai customer untuk berbelanja, atau sebagai admin untuk mengelola toko.</p>

        @if(session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf

            <div class="input-group">
                <label class="input-label" for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Contoh: admin@toko.com" required autofocus class="input-field">
            </div>

            <div class="input-group">
                <label class="input-label" for="password">Kata Sandi</label>
                <div class="password-field-wrap">
                    <input type="password" id="passwordInput" name="password" placeholder="Masukkan kata sandi..." required class="input-field">
                    <button type="button" onclick="togglePassword()" id="toggleBtn" class="toggle-password-btn">Lihat</button>
                </div>
            </div>

            <div class="remember-group">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ingat sesi login saya</label>
            </div>

            <button type="submit" class="btn-submit">Masuk &rarr;</button>
        </form>

        <div class="login-footer">
            Belum punya akun? <a href="/register">Daftar di sini</a>
            <br><br>
            <a href="/">&larr; Kembali ke Etalase Toko Depan</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            var pwd = document.getElementById('passwordInput');
            var btn = document.getElementById('toggleBtn');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                btn.innerHTML = 'Tutup';
            } else {
                pwd.type = 'password';
                btn.innerHTML = 'Lihat';
            }
        }
    </script>
</body>
</html>
