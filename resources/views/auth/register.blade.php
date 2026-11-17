<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - NusaOne</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F9FA; min-height: 100vh; padding: 24px; display: flex; align-items: center; justify-content: center; }
        .register-box { background-color: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; max-width: 460px; width: 100%; padding: 40px 36px; box-shadow: 0 14px 34px rgba(10, 25, 47, 0.08); }
        .store-tag { display: inline-block; background-color: #0A192F; color: #C5A059; border: 1px solid #C5A059; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; padding: 5px 10px; border-radius: 6px; margin-bottom: 16px; }
        .register-box h1 { font-size: 26px; font-weight: 800; color: #0A192F; letter-spacing: -0.4px; margin-bottom: 8px; }
        .register-box .register-desc { color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 26px; }
        .input-group { margin-bottom: 18px; }
        .input-label { display: block; font-size: 13px; font-weight: 700; color: #0A192F; margin-bottom: 7px; }
        .input-field { width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; font-family: inherit; color: #0A192F; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
        .input-field:focus { border-color: #C5A059; box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.15); }
        .input-hint { color: #94a3b8; font-size: 12px; margin-top: 6px; }
        .field-error { color: #dc2626; font-size: 12px; font-weight: 600; margin-top: 6px; }
        .btn-submit { width: 100%; background-color: #0A192F; color: #ffffff; border: 1px solid #0A192F; padding: 13px 24px; border-radius: 10px; font-family: inherit; font-size: 15px; font-weight: 700; cursor: pointer; transition: all 0.2s ease; margin-top: 6px; }
        .btn-submit:hover { background-color: #C5A059; border-color: #C5A059; color: #ffffff; }
        .register-footer { margin-top: 22px; text-align: center; font-size: 13px; color: #64748b; }
        .register-footer a { color: #0A192F; text-decoration: none; font-weight: 700; transition: color 0.2s; }
        .register-footer a:hover { color: #C5A059; text-decoration: none; }
        .alert-error { background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca; padding: 14px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; font-weight: 500; }
    </style>
</head>
<body>
    <div class="register-box">
        <span class="store-tag">NUSAONE STORE</span>
        <h1>Daftar Akun Baru</h1>
        <p class="register-desc">Buat akun customer untuk mulai berbelanja dan memantau pesanan Anda.</p>

        @if($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf

            <div class="input-group">
                <label class="input-label" for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required autofocus class="input-field">
                @error('name')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label class="input-label" for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Contoh: budi@gmail.com" required class="input-field">
                @error('email')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label class="input-label" for="phone">Nomor WhatsApp / HP</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 081234567890" class="input-field">
                @error('phone')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label class="input-label" for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required class="input-field">
                <p class="input-hint">Gunakan minimal 8 karakter.</p>
                @error('password')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label class="input-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required class="input-field">
            </div>

            <button type="submit" class="btn-submit">Daftar Sekarang</button>
        </form>

        <div class="register-footer">
            Sudah punya akun? <a href="/login">Masuk di sini</a>
            <br><br>
            <a href="/">&larr; Kembali ke Etalase Toko</a>
        </div>
    </div>
</body>
</html>
