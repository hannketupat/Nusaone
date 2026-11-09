@extends('layouts.admin')

@section('konten_admin')
    {{-- Flash Session Success --}}
    @if(session('success'))
        <div style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; padding: 14px 20px; border-radius: 10px; margin-bottom: 25px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
            <span>&#10003;</span> {{ session('success') }}
        </div>
    @endif

    {{-- Header Halaman & Tombol Tambah Produk --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 16px;">
        <div>
            <h2 style="font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 4px;">Katalog Produk</h2>
            <p style="color: #64748b; font-size: 14px;">Kelola seluruh koleksi produk busana dan kerajinan etnik NusaOne.</p>
        </div>
        <a href="/admin/products/create" style="background-color: #2563eb; color: #ffffff; text-decoration: none; padding: 11px 20px; border-radius: 10px; font-size: 14px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25); transition: background-color 0.2s;">
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
                        <th style="padding: 16px 20px;">Harga Satuan</th>
                        <th style="padding: 16px 20px; text-align: center; width: 120px;">Aksi</th>
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
                                <div style="font-weight: 700; color: #0f172a; margin-bottom: 4px; font-size: 15px;">
                                    {{ $product->name }}
                                </div>
                                <div style="color: #64748b; font-size: 13px; line-height: 1.4; max-width: 550px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $product->description }}
                                </div>
                            </td>
                            <td style="padding: 16px 20px;">
                                <span style="font-weight: 800; color: #0f172a; font-size: 15px;">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px; text-align: center;">
                                <a href="/detail/{{ $product->id }}" target="_blank" style="color: #2563eb; text-decoration: none; font-weight: 600; font-size: 13px; padding: 6px 12px; border-radius: 6px; border: 1px solid #dbeafe; background-color: #eff6ff; display: inline-block;">
                                    Lihat &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8;">
                                <p style="font-size: 16px; font-weight: 600; margin-bottom: 6px;">Belum ada produk yang terdaftar</p>
                                <p style="font-size: 13px; margin-bottom: 16px;">Klik tombol di bawah untuk menambahkan produk pertama Anda.</p>
                                <a href="/admin/products/create" style="background-color: #2563eb; color: #ffffff; text-decoration: none; padding: 9px 18px; border-radius: 8px; font-size: 13px; font-weight: 700;">
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
