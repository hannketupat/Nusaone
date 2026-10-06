@extends('layouts.master')

@section('styles')
<style>
    .success-card {
        text-align: center;
        background-color: var(--white);
        padding: 56px 40px;
        border-radius: 12px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        width: 50%;
        margin: 0 auto;
    }
    .success-icon {
        font-size: 60px;
        line-height: 1;
        margin-bottom: 12px;
    }
    .success-title {
        color: var(--navy);
        font-size: 27px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .success-desc {
        color: var(--muted);
        font-size: 15px;
        margin-bottom: 18px;
    }
    .success-resi {
        color: var(--muted);
        font-size: 15px;
        padding: 13px;
        background-color: var(--bg);
        border-radius: 8px;
        border: 1px solid var(--border);
    }
    .success-resi strong {
        color: var(--navy);
    }

    .btn-home {
        display: inline-block;
        margin-top: 24px;
        background-color: var(--navy);
        color: var(--white);
        padding: 12px 24px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        transition: background-color 0.2s ease, color 0.2s ease;
    }
    .btn-home:hover {
        background-color: var(--gold);
        color: var(--navy);
    }

    @media (max-width: 768px) {
        .success-card {
            width: 100%;
            padding: 40px 22px;
        }
    }
</style>
@endsection

@section('konten_utama')
<div class="success-card">
    <div class="success-icon">&#9989;</div>
    <h2 class="success-title">Transaksi Berhasil!</h2>
    <p class="success-desc">Terima kasih, pesanan Anda sedang kami proses.</p>
    <p class="success-resi">Nomor Resi: <strong>INV-2026-XYZ99</strong></p>
    <a href="/" class="btn-home">Kembali ke Beranda</a>
</div>
@endsection
