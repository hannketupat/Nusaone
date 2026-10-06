@extends('layouts.master')

@section('styles')
<style>
    .page-title {
        color: var(--navy);
        font-size: 30px;
        font-weight: 700;
        letter-spacing: -0.3px;
        margin-bottom: 8px;
    }
    .gold-rule {
        width: 64px;
        height: 4px;
        background-color: var(--gold);
        border-radius: 4px;
        margin-bottom: 30px;
    }

    .form-card {
        background-color: var(--white);
        padding: 26px;
        border: 1px solid var(--border);
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        width: 60%;
    }
    .form-group {
        margin-bottom: 18px;
    }
    .form-group label {
        display: block;
        color: var(--navy);
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 7px;
    }
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 11px 12px;
        border-radius: 8px;
        border: 1px solid var(--border);
        font-family: inherit;
        font-size: 15px;
        color: var(--navy);
        background-color: var(--bg);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201, 162, 39, 0.18);
    }

    .form-divider {
        border: 0;
        border-top: 1px solid var(--border);
        margin-bottom: 18px;
    }
    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 600;
        font-size: 16px;
        color: var(--navy);
        margin-bottom: 20px;
    }
    .total-row span {
        color: var(--gold);
        font-size: 20px;
        font-weight: 700;
    }

    .btn-submit {
        background-color: var(--navy);
        color: var(--white);
        padding: 13px 25px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        font-family: inherit;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.2s ease, color 0.2s ease;
    }
    .btn-submit:hover {
        background-color: var(--gold);
        color: var(--navy);
    }

    @media (max-width: 768px) {
        .form-card {
            width: 100%;
            padding: 20px;
        }
        .page-title {
            font-size: 24px;
        }
    }
</style>
@endsection

@section('konten_utama')
<h1 class="page-title">Keranjang Belanja</h1>
<div class="gold-rule"></div>

<h2 style="color: var(--navy); font-size: 21px; font-weight: 600; margin-bottom: 20px;">Pengiriman &amp; Pembayaran</h2>

<div class="form-card">
    <form action="/berhasil" method="GET">
        <div class="form-group">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat Pengiriman:</label>
            <textarea id="alamat" name="alamat" placeholder="Masukkan alamat lengkap pengiriman" rows="3" required></textarea>
        </div>
        <hr class="form-divider">
        <div class="total-row">
            <p>Total Bayar:</p>
            <span>Rp 150.000</span>
        </div>
        <button type="submit" class="btn-submit">
            Konfirmasi Pesanan
        </button>
    </form>
</div>
@endsection
