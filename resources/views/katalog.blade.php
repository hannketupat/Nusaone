@extends('layouts.master')

@section('styles')
<style>
    /* ===== JUDUL HALAMAN ===== */
    .page-title {
        color: var(--navy);
        font-size: 30px;
        font-weight: 700;
        letter-spacing: -0.3px;
        margin-bottom: 8px;
    }
    .page-subtitle {
        color: var(--muted);
        font-size: 15px;
        margin-bottom: 28px;
    }
    .gold-rule {
        width: 64px;
        height: 4px;
        background-color: var(--gold);
        border-radius: 4px;
        margin-bottom: 30px;
    }

    /* ===== GRID RESPONSIF ===== */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 24px;
    }

    /* ===== CARD PRODUK ===== */
    .product-card {
        background-color: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 14px;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: box-shadow 0.25s ease, transform 0.25s ease;
    }
    .product-card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        transform: translateY(-3px);
    }

    /* ===== GAMBAR PRODUK (1:1) ===== */
    .product-thumb {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        border-radius: 8px;
        display: block;
        background-color: var(--bg);
    }
    .product-thumb-empty {
        width: 100%;
        aspect-ratio: 1 / 1;
        border-radius: 8px;
        background-color: var(--border);
        color: var(--muted);
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 6px;
    }
    .product-thumb-empty svg {
        width: 34px;
        height: 34px;
        opacity: 0.6;
    }

    /* ===== NAMA & HARGA ===== */
    .product-name {
        color: var(--navy);
        font-size: 17px;
        font-weight: 600;
        margin: 15px 2px 6px;
    }
    .product-price {
        color: var(--gold);
        font-weight: 700;
        font-size: 20px;
        margin-bottom: 16px;
        margin-left: 2px;
    }

    /* ===== TOMBOL ===== */
    .btn-detail {
        margin-top: auto;
        display: block;
        text-align: center;
        background-color: var(--navy);
        color: var(--white);
        padding: 11px 10px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        transition: background-color 0.2s ease, color 0.2s ease;
    }
    .btn-detail:hover {
        background-color: var(--gold);
        color: var(--navy);
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 70px 24px;
        background-color: var(--white);
        border: 1px dashed var(--border);
        border-radius: 12px;
    }
    .empty-state svg {
        width: 54px;
        height: 54px;
        color: var(--muted);
        opacity: 0.55;
        margin-bottom: 16px;
    }
    .empty-state h3 {
        color: var(--muted);
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 6px;
    }
    .empty-state p {
        color: var(--muted);
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 16px;
        }
        .page-title {
            font-size: 24px;
        }
        .product-price {
            font-size: 18px;
        }
    }
</style>
@endsection

@section('konten_utama')
<h1 class="page-title">Katalog Produk</h1>
<div class="gold-rule"></div>

<div class="product-grid">

    @forelse($products as $product)

    <div class="product-card">

        @if($product->image)
            <img src="{{ asset('assets/images/' . $product->image) }}" alt="{{ $product->name }}" class="product-thumb">
        @else
            <div class="product-thumb-empty">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <path d="M21 15l-5-5L5 21"></path>
                </svg>
                <span>Tanpa Gambar</span>
            </div>
        @endif

        <h3 class="product-name">{{ $product->name }}</h3>

        <p class="product-price">
            Rp {{ number_format($product->price, 0, '', '') }}
        </p>

        <a href="/detail/{{ $product->id }}" class="btn-detail">
            Lihat Detail
        </a>
    </div>

    @empty
    <div class="empty-state">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
        </svg>
        <h3>Mohon maaf, produk belum tersedia di etalase kami.</h3>
        <p>Silakan kembali lagi nanti.</p>
    </div>
    @endforelse

</div>
@endsection
