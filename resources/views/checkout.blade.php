@extends('layouts.master')

@section('styles')
<style>
    .checkout-breadcrumb { margin-bottom: 25px; font-size: 14px; color: #64748b; }
    .checkout-breadcrumb a { color: #0A192F; text-decoration: none; font-weight: 600; transition: color 0.2s; }
    .checkout-breadcrumb a:hover { color: #C5A059; text-decoration: none; }
    .checkout-title { margin-bottom: 20px; color: #0A192F; font-size: 24px; font-weight: 800; }
    .checkout-grid { display: flex; gap: 30px; align-items: flex-start; }
    .checkout-form-card { width: 60%; background-color: #ffffff; padding: 25px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(10, 25, 47, 0.04); }
    .form-group { margin-bottom: 16px; }
    .form-label { font-weight: 700; display: block; margin-bottom: 6px; font-size: 14px; color: #0A192F; }
    .form-input { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px; color: #0A192F; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
    .form-input:focus { border-color: #C5A059; box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.15); }
    .form-row { display: flex; gap: 20px; margin-bottom: 20px; }
    .form-row > div:first-child { width: 65%; }
    .form-row > div:last-child { width: 35%; }
    .field-hint { font-size: 12px; color: #64748b; margin-top: 5px; }
    .field-error { font-size: 12px; color: #dc2626; font-weight: 700; margin-top: 5px; }
    .btn-submit-order { background-color: #0A192F; color: #ffffff; padding: 15px; width: 100%; border: 1px solid #0A192F; border-radius: 8px; font-family: inherit; font-weight: 800; font-size: 16px; cursor: pointer; transition: all 0.2s ease; }
    .btn-submit-order:hover { background-color: #C5A059; border-color: #C5A059; color: #ffffff; }
    .btn-submit-order:disabled { background-color: #e2e8f0; border-color: #e2e8f0; color: #94a3b8; cursor: not-allowed; }
    .summary-card { width: 40%; background-color: #ffffff; padding: 25px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(10, 25, 47, 0.04); }
    .summary-card h3 { margin-top: 0; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px; font-size: 18px; color: #0A192F; }
    .summary-img { width: 100%; height: 180px; object-fit: cover; border-radius: 8px; margin-bottom: 15px; background-color: #f1f5f9; }
    .summary-img-empty { width: 100%; height: 180px; display: flex; align-items: center; justify-content: center; border-radius: 8px; margin-bottom: 15px; background-color: #f1f5f9; color: #94a3b8; font-size: 13px; font-weight: 600; }
    .summary-name { margin: 0 0 6px; color: #0A192F; font-size: 18px; }
    .summary-price { color: #C5A059; font-weight: 800; margin: 0 0 10px; font-size: 22px; }
    .summary-stock { font-size: 13px; color: #64748b; margin: 0 0 12px; font-weight: 600; }
    .summary-note { font-size: 13px; color: #64748b; line-height: 1.5; }
    .stock-warning { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; padding: 12px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; margin-bottom: 16px; }
    @media (max-width: 768px) {
        .checkout-grid { flex-direction: column; }
        .checkout-form-card,
        .summary-card { width: 100%; }
        .form-row { flex-direction: column; gap: 16px; }
        .form-row > div:first-child,
        .form-row > div:last-child { width: 100%; }
    }
</style>
@endsection

@section('konten')
    <div class="checkout-breadcrumb">
        <a href="/">Katalog Utama</a>
        <span style="margin: 0 10px;">/</span>
        <a href="/detail/{{ $product->id }}">{{ $product->name }}</a>
        <span style="margin: 0 10px;">/</span>
        <span style="color: #0A192F; font-weight: 700;">Checkout Pesanan</span>
    </div>

    <h2 class="checkout-title">Formulir Pengiriman &amp; Pembayaran</h2>

    <div class="checkout-grid">
        {{-- KOLOM KIRI: FORMULIR INPUT DATA PEMBELI --}}
        <div class="checkout-form-card">
            @if($product->stock <= 0)
                <div class="stock-warning">
                    Maaf, stok produk ini sedang habis. Silakan kembali ke katalog dan pilih produk lain.
                </div>
            @endif

            <form action="/checkout/proses" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="form-group">
                    <label class="form-label" for="customer_name">Nama Lengkap Penerima:</label>
                    <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', Auth::user()->name) }}" placeholder="Contoh: Budi Santoso" class="form-input" required>
                    @error('customer_name')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="customer_phone">Nomor WhatsApp / HP Aktif:</label>
                    <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', Auth::user()->phone) }}" placeholder="Contoh: 081234567890" class="form-input" required>
                    @error('customer_phone')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="customer_address">Alamat Lengkap Pengiriman:</label>
                    <textarea id="customer_address" name="customer_address" rows="3" placeholder="Tuliskan Nama Jalan, RT/RW, Kecamatan, dan Kota/Kabupaten..." class="form-input" required>{{ old('customer_address') }}</textarea>
                    @error('customer_address')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div>
                        <label class="form-label" for="courier">Pilih Ekspedisi Kurir:</label>
                        <select id="courier" name="courier" class="form-input" required>
                            <option value="JNE Reguler" {{ old('courier') == 'JNE Reguler' ? 'selected' : '' }}>JNE Reguler (Ongkir Rp 15.000)</option>
                            <option value="J&T Express" {{ old('courier') == 'J&T Express' ? 'selected' : '' }}>J&amp;T Express (Ongkir Rp 20.000)</option>
                            <option value="SiCepat BEST" {{ old('courier') == 'SiCepat BEST' ? 'selected' : '' }}>SiCepat BEST (Ongkir Rp 25.000)</option>
                        </select>
                        @error('courier')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label" for="quantity">Jumlah Beli (Qty):</label>
                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="{{ $product->stock }}" class="form-input" required>
                        <div class="field-hint">Sisa stok: {{ $product->stock }} pcs</div>
                        @error('quantity')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn-submit-order" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                    Konfirmasi &amp; Buat Pesanan Sekarang
                </button>
            </form>
        </div>

        {{-- KOLOM KANAN: RINGKASAN PRODUK --}}
        <div class="summary-card">
            <h3>Ringkasan Pesanan</h3>

            @if($product->image)
                <img src="{{ asset('assets/images/'.$product->image) }}" alt="{{ $product->name }}" class="summary-img">
            @else
                <div class="summary-img-empty">Tanpa Gambar</div>
            @endif

            <h3 class="summary-name">{{ $product->name }}</h3>
            <p class="summary-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="summary-stock">Kategori: {{ $product->category ?? '-' }} &bull; Stok: {{ $product->stock }} pcs</p>

            <hr style="margin: 15px 0; border: 0; border-top: 1px dashed #cbd5e1;">
            <p class="summary-note">
                *Total tagihan akhir (Harga Produk dikali Jumlah Beli ditambah Ongkos Kirim) akan
                dihitung secara otomatis oleh sistem pada halaman Invoice setelah Anda menekan
                tombol Konfirmasi.
            </p>
        </div>
    </div>
@endsection
