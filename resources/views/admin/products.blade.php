@extends('layouts.admin')

@section('konten_admin')
    <style>
        .btn-add-product {
            background-color: #0A192F;
            color: #ffffff;
            text-decoration: none;
            padding: 11px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #0A192F;
            box-shadow: 0 2px 6px rgba(10, 25, 47, 0.2);
            transition: all 0.2s ease;
        }
        .btn-add-product:hover {
            background-color: #C5A059;
            border-color: #C5A059;
            color: #ffffff;
        }
        .btn-view-product {
            color: #0A192F;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #C5A059;
            background-color: #FDFBF7;
            display: inline-block;
            transition: all 0.2s ease;
        }
        .btn-view-product:hover {
            background-color: #C5A059;
            color: #ffffff;
        }
        .badge-category {
            display: inline-block;
            background-color: #FDFBF7;
            color: #0A192F;
            border: 1px solid #C5A059;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }
    </style>

    {{-- Flash Session Success --}}
    @if(session('success'))
        <div style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; padding: 14px 20px; border-radius: 10px; margin-bottom: 25px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
            <span>&#10003;</span> {{ session('success') }}
        </div>
    @endif

    {{-- Header Halaman & Tombol Tambah Produk --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 16px;">
        <div>
            <h2 style="font-size: 24px; font-weight: 800; color: #0A192F; margin-bottom: 4px;">Katalog Produk</h2>
            <p style="color: #64748b; font-size: 14px;">Kelola seluruh koleksi produk busana dan kerajinan etnik NusaOne.</p>
        </div>
        <a href="/admin/products/create" class="btn-add-product">
            <span>+</span> Tambah Produk Baru
        </a>
    </div>

    {{-- Card Tabel Produk --}}
    <div style="background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                <thead>
                    <tr style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">
                        <th style="padding: 16px 20px; width: 70px;">No</th>
                        <th style="padding: 16px 20px; width: 110px;">Thumbnail</th>
                        <th style="padding: 16px 20px;">Nama Produk</th>
                        <th style="padding: 16px 20px;">Kategori</th>
                        <th style="padding: 16px 20px;">Stok</th>
                        <th style="padding: 16px 20px;">Harga Satuan</th>
                        <th style="padding: 16px 20px; text-align: center; width: 250px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background-color 0.15s;">
                            <td style="padding: 16px 20px; color: #94a3b8; font-weight: 600;">
                                {{ $index + 1 }}
                            </td>
                            <td style="padding: 16px 20px;">
                                @if($product->image)
                                    <img src="{{ asset('assets/images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 64px; height: 64px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0; background-color: #f8fafc; display: block;">
                                @else
                                    <div style="width: 64px; height: 64px; border-radius: 8px; background-color: #f1f5f9; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 11px;">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 16px 20px;">
                                <div style="font-weight: 700; color: #0A192F; margin-bottom: 4px; font-size: 15px;">
                                    {{ $product->name }}
                                </div>
                                <div style="color: #64748b; font-size: 13px; line-height: 1.4; max-width: 550px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $product->description }}
                                </div>
                            </td>
                            <td style="padding: 16px 20px;">
                                <span class="badge-category">
                                    {{ $product->category ?? '-' }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px;">
                                @if($product->stock > 0)
                                    <span style="font-weight: 700; color: #047857;">{{ $product->stock }}</span>
                                @else
                                    <span style="font-weight: 700; color: #dc2626;">Habis</span>
                                @endif
                            </td>
                            <td style="padding: 16px 20px;">
                                <span style="font-weight: 800; color: #0A192F; font-size: 15px;">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px; text-align: center;">
                                <div style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; flex-wrap: wrap;">
                                    <a href="/detail/{{ $product->id }}" target="_blank" class="btn-view-product">
                                        Lihat &rarr;
                                    </a>
                                    <a href="/admin/products/{{ $product->id }}/edit" style="color: #b45309; text-decoration: none; font-weight: 600; font-size: 13px; padding: 6px 12px; border-radius: 6px; border: 1px solid #fde68a; background-color: #fffbeb; display: inline-block;">
                                        Edit
                                    </a>
                                    <form action="/admin/products/{{ $product->id }}/delete" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini? Data dan foto produk akan dihapus permanen.');" style="display: inline-block; margin: 0;">
                                        @csrf
                                        <button type="submit" style="color: #dc2626; font-weight: 600; font-size: 13px; padding: 6px 12px; border-radius: 6px; border: 1px solid #fecaca; background-color: #fef2f2; cursor: pointer; font-family: inherit;">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 40px; text-align: center; color: #94a3b8;">
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 6px;">Belum ada produk yang terdaftar</p>
                                <p style="font-size: 13px; margin-bottom: 16px;">Klik tombol di bawah untuk menambahkan produk pertama Anda.</p>
                                <a href="/admin/products/create" class="btn-add-product" style="padding: 9px 18px; font-size: 13px;">
                                    + Tambah Produk Sekarang
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
