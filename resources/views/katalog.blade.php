@extends('layouts.master')

@section('styles')
<style>
    /* ===== KEYFRAME ANIMATIONS ===== */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(22px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== BANNER TOKO (HERO SECTION NUSANTARA) ===== */
    .catalog-banner {
        position: relative;
        overflow: hidden;
        background: linear-gradient(120deg, #1B2A4E 0%, #253a63 55%, #31497a 100%);
        border-radius: 20px;
        padding: 42px 44px;
        margin-bottom: 28px;
        color: #FFFFFF;
        box-shadow: 0 14px 34px rgba(27, 42, 78, 0.22);
    }
    .banner-bg-batik {
        position: absolute;
        inset: 0;
        background-image: url("{{ asset('images/bg-batik.png') }}");
        background-repeat: repeat;
        background-position: center;
        background-size: 240px auto;
        opacity: 0.10;
        mix-blend-mode: overlay;
        pointer-events: none;
        z-index: 1;
    }
    .catalog-banner::after {
        content: "";
        position: absolute;
        right: -90px;
        top: -110px;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, rgba(201, 162, 39, 0.35) 0%, rgba(201, 162, 39, 0) 68%);
        border-radius: 50%;
        z-index: 1;
    }
    .catalog-banner::before {
        content: "";
        position: absolute;
        right: 90px;
        bottom: -140px;
        width: 260px;
        height: 260px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.10) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
        z-index: 1;
    }
    .banner-content {
        position: relative;
        z-index: 3;
        max-width: 600px;
    }
    .banner-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: rgba(201, 162, 39, 0.18);
        border: 1px solid rgba(201, 162, 39, 0.45);
        color: #F3D77A;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.4px;
        text-transform: uppercase;
        padding: 6px 12px;
        border-radius: 999px;
        margin-bottom: 16px;
        animation: fadeInUp 0.6s ease-out both;
    }
    .catalog-banner h1 {
        font-size: 34px;
        font-weight: 800;
        letter-spacing: -0.8px;
        line-height: 1.18;
        margin-bottom: 10px;
        text-shadow: 0 2px 10px rgba(15, 23, 42, 0.4);
        animation: fadeInUp 0.8s ease-out forwards;
    }
    .catalog-banner p {
        color: #C7D2E5;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 20px;
        text-shadow: 0 1px 6px rgba(15, 23, 42, 0.3);
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }
    .banner-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        animation: fadeInUp 0.8s ease-out 0.35s both;
    }
    .product-count-badge {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        background-color: #FFFFFF;
        color: #1B2A4E;
        font-size: 14px;
        font-weight: 800;
        padding: 10px 18px;
        border-radius: 11px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.16);
    }
    .product-count-badge span {
        color: #C9A227;
        font-size: 18px;
        font-weight: 800;
    }
    .banner-note {
        color: #C7D2E5;
        font-size: 13px;
        font-weight: 600;
    }

    /* ===== FLOATING IMAGES (HERO NUSANTARA) ===== */
    .floating-img {
        position: absolute;
        object-fit: cover;
        border-radius: 18px;
        box-shadow: 0 20px 42px rgba(10, 20, 45, 0.45), 0 4px 14px rgba(0, 0, 0, 0.25);
        border: 3px solid rgba(255, 255, 255, 0.25);
        pointer-events: none;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
    .floating-img.img-1 {
        width: 195px;
        height: 195px;
        right: 175px;
        bottom: 24px;
        z-index: 2;
        animation: float 4s ease-in-out infinite;
    }
    .floating-img.img-2 {
        width: 170px;
        height: 170px;
        right: 32px;
        top: 24px;
        z-index: 1;
        animation: float 5s ease-in-out infinite;
    }

    /* ===== FILTER BAR ===== */
    .filter-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
        background-color: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 16px 20px;
        margin-bottom: 26px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
    }
    .search-info,
    .filter-info {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        font-size: 14px;
        color: #64748B;
        font-weight: 500;
    }
    .search-info strong {
        color: #1B2A4E;
        font-weight: 800;
    }
    .search-info .search-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background-color: #F1F5F9;
        color: #475569;
        flex-shrink: 0;
    }
    .search-info .search-icon svg {
        width: 16px;
        height: 16px;
    }
    .btn-reset {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #B91C1C;
        background-color: #FEF2F2;
        border: 1px solid #FECACA;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 11px;
        border-radius: 7px;
        transition: background-color 0.2s ease, border-color 0.2s ease;
    }
    .btn-reset:hover {
        background-color: #FEE2E2;
        border-color: #FCA5A5;
    }
    .sort-form {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }
    .sort-form label {
        font-size: 12px;
        font-weight: 800;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        white-space: nowrap;
    }
    .sort-select {
        appearance: none;
        -webkit-appearance: none;
        background-color: #F8FAFC;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2364748B' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        border: 1px solid #CBD5E1;
        border-radius: 9px;
        padding: 9px 34px 9px 13px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 700;
        color: #1B2A4E;
        cursor: pointer;
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
    }
    .sort-select:hover {
        background-color: #FFFFFF;
        border-color: #94A3B8;
    }
    .sort-select:focus {
        background-color: #FFFFFF;
        border-color: #C9A227;
        box-shadow: 0 0 0 3px rgba(201, 162, 39, 0.14);
    }

    /* ===== PRODUCT GRID ===== */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 24px;
    }

    /* ===== PRODUCT CARD ===== */
    .product-card {
        background-color: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.05);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }
    .product-card:hover {
        transform: translateY(-6px);
        border-color: #CBD5E1;
        box-shadow: 0 18px 34px rgba(15, 23, 42, 0.13);
    }
    .product-img-wrap {
        position: relative;
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        background: linear-gradient(135deg, #F1F5F9 0%, #E2E8F0 100%);
    }
    .product-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.45s ease;
    }
    .product-card:hover .product-img-wrap img {
        transform: scale(1.06);
    }
    .product-img-empty {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 8px;
        color: #94A3B8;
        font-size: 13px;
        font-weight: 600;
    }
    .product-img-empty svg {
        width: 38px;
        height: 38px;
        opacity: 0.6;
    }
    .stock-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: rgba(255, 255, 255, 0.94);
        backdrop-filter: blur(4px);
        color: #047857;
        font-size: 11px;
        font-weight: 800;
        padding: 5px 10px;
        border-radius: 999px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.12);
    }
    .stock-badge::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: #10B981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.18);
    }
    .stock-badge.habis {
        color: #B91C1C;
        background-color: rgba(254, 242, 242, 0.96);
    }
    .stock-badge.habis::before {
        background-color: #EF4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.18);
    }

    /* ===== PRODUCT BODY ===== */
    .product-body {
        padding: 16px 17px 18px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .product-category {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.1px;
        text-transform: uppercase;
        color: #C9A227;
        margin-bottom: 6px;
    }
    .product-name {
        color: #1B2A4E;
        font-size: 16px;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 7px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 44px;
    }
    .product-rating {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 10px;
    }
    .product-stars {
        color: #F59E0B;
        font-size: 13px;
        letter-spacing: 1px;
        line-height: 1;
    }
    .product-rating span {
        font-size: 12px;
        font-weight: 700;
        color: #94A3B8;
    }
    .product-price {
        color: #1B2A4E;
        font-weight: 800;
        font-size: 20px;
        letter-spacing: -0.4px;
        margin-top: auto;
        margin-bottom: 14px;
    }
    .product-price small {
        font-size: 12px;
        font-weight: 700;
        color: #94A3B8;
        letter-spacing: 0;
    }
    .btn-detail {
        display: block;
        text-align: center;
        background-color: #1B2A4E;
        color: #FFFFFF;
        padding: 11px 10px;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
        letter-spacing: 0.2px;
        transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
    }
    .btn-detail:hover {
        background-color: #C9A227;
        color: #1B2A4E;
        transform: translateY(-1px);
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 68px 24px;
        background-color: #FFFFFF;
        border: 1px dashed #CBD5E1;
        border-radius: 18px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
    }
    .empty-icon {
        width: 74px;
        height: 74px;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #F1F5F9;
        border-radius: 50%;
        color: #94A3B8;
    }
    .empty-icon svg {
        width: 34px;
        height: 34px;
    }
    .empty-state h3 {
        color: #1B2A4E;
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 7px;
        letter-spacing: -0.3px;
    }
    .empty-state p {
        color: #64748B;
        font-size: 14px;
        line-height: 1.6;
        max-width: 460px;
        margin: 0 auto 20px;
    }
    .btn-show-all {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #1B2A4E;
        color: #FFFFFF;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        padding: 11px 22px;
        border-radius: 10px;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }
    .btn-show-all:hover {
        background-color: #C9A227;
        color: #1B2A4E;
        transform: translateY(-1px);
    }

    @media (max-width: 1100px) {
        .banner-content {
            max-width: 500px;
        }
        .floating-img.img-1 {
            width: 165px;
            height: 165px;
            right: 140px;
            bottom: 20px;
        }
        .floating-img.img-2 {
            width: 145px;
            height: 145px;
            right: 22px;
            top: 22px;
        }
    }

    @media (max-width: 900px) {
        .banner-content {
            max-width: 100%;
        }
        .floating-img {
            opacity: 0.35;
            z-index: 2;
        }
        .floating-img.img-1 {
            width: 140px;
            height: 140px;
            right: 110px;
            bottom: 16px;
        }
        .floating-img.img-2 {
            width: 120px;
            height: 120px;
            right: 18px;
            top: 18px;
        }
    }

    @media (max-width: 768px) {
        .catalog-banner {
            padding: 30px 24px;
            border-radius: 16px;
        }
        .catalog-banner h1 {
            font-size: 25px;
        }
        .catalog-banner p {
            font-size: 14px;
        }
        .floating-img {
            opacity: 0.18;
            box-shadow: none;
            border: none;
            z-index: 1;
        }
        .floating-img.img-1 {
            width: 110px;
            height: 110px;
            right: -15px;
            bottom: -15px;
        }
        .floating-img.img-2 {
            width: 90px;
            height: 90px;
            right: 25px;
            top: -15px;
        }
        .filter-bar {
            align-items: flex-start;
            flex-direction: column;
            gap: 14px;
            padding: 15px 16px;
        }
        .sort-form {
            width: 100%;
        }
        .sort-select {
            flex: 1;
        }
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 16px;
        }
        .product-body {
            padding: 13px 13px 15px;
        }
        .product-name {
            font-size: 14px;
            min-height: 39px;
        }
        .product-price {
            font-size: 17px;
        }
        .btn-detail {
            font-size: 12px;
            padding: 10px 8px;
        }
    }
</style>
@endsection

@section('konten')

{{-- Banner Toko --}}
<section class="catalog-banner">
    {{-- Background Motif Batik Halus --}}
    <div class="banner-bg-batik"></div>

    <div class="banner-content">
        <span class="banner-eyebrow">NusaOne Marketplace</span>
        <h1>Katalog Produk Pilihan</h1>
        <p>Temukan busana batik, tenun, dan kerajinan etnik terbaik dari pengrajin lokal Nusantara.</p>
        <div class="banner-meta">
            <div class="product-count-badge">
                <span>{{ $products->count() }}</span> Produk Tersedia
            </div>
            <div class="banner-note">{{ request('search') ? 'Hasil pencarian produk pilihan Anda' : 'Koleksi terbaru dari NusaOne' }}</div>
        </div>
    </div>

    {{-- Floating Images Nusantara --}}
    <img src="{{ asset('images/batik.png') }}" class="floating-img img-1" alt="Batik">
    <img src="{{ asset('images/alam.jpg') }}" class="floating-img img-2" alt="Alam Indonesia">
</section>

{{-- Bar Kontrol Filter --}}
<div class="filter-bar">
    <div class="search-info">
        @if(request('search'))
            <span class="search-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="M21 21l-4.35-4.35"></path>
                </svg>
            </span>
            <span>Menampilkan hasil pencarian untuk "<strong>{{ request('search') }}</strong>"</span>
            <a href="/" class="btn-reset">&times; Reset Pencarian</a>
        @elseif(request('category'))
            <span>Menampilkan kategori "<strong>{{ request('category') }}</strong>"</span>
            <a href="/" class="btn-reset">&times; Reset Filter</a>
        @else
            <span>Menampilkan seluruh koleksi produk NusaOne.</span>
        @endif
    </div>

    <form action="/" method="GET" class="sort-form">
        @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
        @endif
        <label for="category">Kategori</label>
        <select name="category" id="category" class="sort-select" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
            @endforeach
        </select>
        <label for="sort">Urutkan</label>
        <select name="sort" id="sort" class="sort-select" onchange="this.form.submit()">
            <option value="terbaru" {{ request('sort') == 'terbaru' || !request('sort') ? 'selected' : '' }}>Terbaru</option>
            <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Harga Termurah</option>
            <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Harga Termahal</option>
        </select>
    </form>
</div>

{{-- Grid Produk --}}
<div class="product-grid">

    @forelse($products as $product)

    <div class="product-card">

        <div class="product-img-wrap">
            @if($product->image)
                <img src="{{ asset('assets/images/' . $product->image) }}" alt="{{ $product->name }}">
            @else
                <div class="product-img-empty">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <path d="M21 15l-5-5L5 21"></path>
                    </svg>
                    <span>Tanpa Gambar</span>
                </div>
            @endif
            @if($product->stock > 0)
                <span class="stock-badge">Stok: {{ $product->stock }}</span>
            @else
                <span class="stock-badge habis">Stok Habis</span>
            @endif
        </div>

        <div class="product-body">
            <div class="product-category">{{ $product->category ?? 'Produk NusaOne' }}</div>
            <h3 class="product-name">{{ $product->name }}</h3>

            <p class="product-price">
                <small>Rp</small> {{ number_format($product->price, 0, ',', '.') }}
            </p>

            <a href="/detail/{{ $product->id }}" class="btn-detail">
                Lihat Detail Produk
            </a>
        </div>

    </div>

    @empty

    <div class="empty-state">
        <div class="empty-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="7"></circle>
                <path d="M21 21l-4.35-4.35"></path>
                <path d="M8 11h6"></path>
            </svg>
        </div>
        <h3>Produk Tidak Ditemukan</h3>
        <p>
            @if(request('search'))
                Mohon maaf, kami tidak menemukan produk yang cocok dengan kata kunci "<strong>{{ request('search') }}</strong>". Coba gunakan kata kunci lain atau lihat seluruh produk kami.
            @else
                Mohon maaf, produk belum tersedia di etalase kami. Silakan kembali lagi nanti.
            @endif
        </p>
        <a href="/" class="btn-show-all">Tampilkan Semua Produk</a>
    </div>

    @endforelse

</div>
@endsection

