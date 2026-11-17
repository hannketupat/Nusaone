@extends('layouts.master')

@section('styles')
<style>
    .back-link {
        display: inline-block;
        color: var(--navy);
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        padding: 9px 16px;
        background-color: var(--white);
        border: 1px solid var(--border);
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: color 0.2s ease, border-color 0.2s ease, box-shadow 0.25s ease;
    }
    .back-link:hover {
        color: var(--gold);
        border-color: var(--gold);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
    }

    .detail-card {
        display: flex;
        gap: 32px;
        margin-top: 22px;
        background-color: var(--white);
        padding: 26px;
        border-radius: 12px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    .detail-image {
        width: 42%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        border-radius: 12px;
        display: block;
        background-color: var(--bg);
        border: 1px solid var(--border);
    }
    .detail-info {
        width: 58%;
    }
    .detail-name {
        color: var(--navy);
        font-size: 27px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .detail-price {
        color: var(--gold);
        font-size: 27px;
        font-weight: 700;
        margin-bottom: 20px;
    }
    .detail-label {
        color: var(--navy);
        font-weight: 700;
        font-size: 16px;
        border-bottom: 2px solid var(--gold);
        display: inline-block;
        padding-bottom: 5px;
        margin-bottom: 12px;
    }
    .detail-spec {
        list-style: none;
        margin-bottom: 18px;
    }
    .detail-spec li {
        color: var(--muted);
        font-size: 15px;
        padding: 7px 0 7px 18px;
        position: relative;
    }
    .detail-spec li::before {
        content: "";
        position: absolute;
        left: 0;
        top: 15px;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background-color: var(--gold);
    }
    .detail-desc {
        color: var(--muted);
        font-size: 15px;
        line-height: 1.7;
    }

    .btn-buy {
        display: inline-block;
        margin-top: 24px;
        background-color: var(--navy);
        color: var(--white);
        padding: 13px 28px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        transition: background-color 0.2s ease, color 0.2s ease;
    }
    .btn-buy {
        border: none;
        font-family: inherit;
        cursor: pointer;
    }
    .btn-buy:hover {
        background-color: var(--gold);
        color: #ffffff;
    }
    .btn-buy-disabled,
    .btn-buy-disabled:hover {
        background-color: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
        transform: none;
    }
    .detail-image-empty {
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        font-weight: 600;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .detail-card {
            flex-direction: column;
            gap: 22px;
            padding: 20px;
        }
        .detail-image,
        .detail-info {
            width: 100%;
        }
    }
</style>
@endsection

@section('konten')
    <a href="/" class="back-link">&larr; Kembali ke Katalog</a>

    <div class="detail-card">
        <!-- Gambar Kiri -->
        @if($product->image)
            <img src="{{ asset('assets/images/' . $product->image) }}" alt="{{ $product->name }}" class="detail-image">
        @else
            <div class="detail-image detail-image-empty">Tanpa Gambar</div>
        @endif

        <!-- Spesifikasi Kanan -->
        <div class="detail-info">
            <h2 class="detail-name">{{ $product->name }}</h2>
            <h3 class="detail-price">Rp {{ number_format($product->price, 0, '', '.') }}</h3>

            <p class="detail-label">Spesifikasi</p>
            <ul class="detail-spec">
                <li>Kategori: {{ $product->category ?? '-' }}</li>
                <li>Stok tersedia: {{ $product->stock }} pcs</li>
                <li>Bahan: Katun Premium</li>
                <li>Ukuran tersedia: M, L, XL</li>
                <li>Kondisi: Baru 100%</li>
            </ul>
            <p class="detail-desc">Deskripsi: {{ $product->description }}</p>

            @if($product->stock > 0)
                <a href="/checkout/{{ $product->id }}" class="btn-buy">
                    Beli Sekarang
                </a>
            @else
                <button type="button" class="btn-buy btn-buy-disabled" disabled>
                    Stok Habis
                </button>
            @endif
        </div>
    </div>
@endsection

