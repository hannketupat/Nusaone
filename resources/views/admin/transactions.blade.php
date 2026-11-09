@extends('layouts.admin')

@section('konten_admin')
    {{-- Flash Session Success --}}
    @if(session('success'))
        <div style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; padding: 14px 20px; border-radius: 8px; margin-bottom: 25px; font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Judul Halaman --}}
    <div style="margin-bottom: 25px;">
        <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 6px;">Kelola Transaksi Penjualan</h2>
        <p style="color: #64748b; font-size: 14px;">Pantau data pesanan masuk dan perbarui status pengiriman pelanggan.</p>
    </div>

    {{-- 3 Kartu Statistik --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div style="background-color: #ffffff; padding: 20px; border-radius: 10px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <p style="color: #64748b; font-size: 14px; margin-bottom: 8px; font-weight: 600;">Total Produk</p>
            <h3 style="font-size: 28px; font-weight: bold; color: #0f172a;">{{ $total_products ?? $product_count ?? 0 }}</h3>
        </div>

        <div style="background-color: #ffffff; padding: 20px; border-radius: 10px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <p style="color: #64748b; font-size: 14px; margin-bottom: 8px; font-weight: 600;">Pesanan</p>
            <h3 style="font-size: 28px; font-weight: bold; color: #0f172a;">{{ $total_transactions ?? $transaction_count ?? 0 }}</h3>
        </div>

        <div style="background-color: #ffffff; padding: 20px; border-radius: 10px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <p style="color: #64748b; font-size: 14px; margin-bottom: 8px; font-weight: 600;">Omzet</p>
            <h3 style="font-size: 28px; font-weight: bold; color: #059669;">Rp {{ number_format($total_amount ?? $total_revenue ?? 0, 0, ',', '.') }}</h3>
        </div>
    </div>

    {{-- Tabel Daftar Pesanan --}}
    <div style="background-color: #ffffff; border-radius: 10px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="padding: 18px 24px; border-bottom: 1px solid #e2e8f0;">
            <h3 style="font-size: 18px; font-weight: bold; color: #0f172a;">Daftar Pesanan Masuk</h3>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                <thead>
                    <tr style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #475569;">
                        <th style="padding: 14px 20px;">Invoice</th>
                        <th style="padding: 14px 20px;">Pelanggan</th>
                        <th style="padding: 14px 20px;">Produk</th>
                        <th style="padding: 14px 20px;">Total Bayar</th>
                        <th style="padding: 14px 20px;">Status</th>
                        <th style="padding: 14px 20px; text-align: center;">Aksi Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 14px 20px; font-weight: 600; color: #2563eb;">
                                {{ $transaction->invoice_code }}
                                <div style="font-size: 12px; color: #94a3b8; font-weight: normal;">
                                    {{ $transaction->created_at ? $transaction->created_at->format('d M Y, H:i') : '-' }}
                                </div>
                            </td>
                            <td style="padding: 14px 20px;">
                                <strong>{{ $transaction->customer_name }}</strong>
                                <div style="font-size: 12px; color: #64748b;">{{ $transaction->customer_phone }}</div>
                            </td>
                            <td style="padding: 14px 20px;">
                                {{ $transaction->product_name }}
                                <span style="color: #64748b;">({{ $transaction->quantity }}x)</span>
                            </td>
                            <td style="padding: 14px 20px; font-weight: bold; color: #0f172a;">
                                Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                            </td>
                            <td style="padding: 14px 20px;">
                                @if($transaction->status == 'Pending')
                                    <span style="background-color: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-weight: bold; font-size: 12px;">
                                        Pending
                                    </span>
                                @elseif($transaction->status == 'Paid')
                                    <span style="background-color: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 4px; font-weight: bold; font-size: 12px;">
                                        Paid
                                    </span>
                                @elseif($transaction->status == 'Shipped')
                                    <span style="background-color: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 4px; font-weight: bold; font-size: 12px;">
                                        Shipped
                                    </span>
                                @else
                                    <span style="background-color: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 4px; font-weight: bold; font-size: 12px;">
                                        {{ $transaction->status }}
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 14px 20px; text-align: center;">
                                <form action="/admin/transactions/{{ $transaction->id }}/status" method="POST" style="display: inline-flex; gap: 8px;">
                                    @csrf
                                    <button type="submit" name="status" value="Paid" style="background-color: #2563eb; color: white; border: none; padding: 6px 12px; border-radius: 5px; font-size: 13px; font-weight: 600; cursor: pointer;">
                                        Set Lunas
                                    </button>
                                    <button type="submit" name="status" value="Shipped" style="background-color: #059669; color: white; border: none; padding: 6px 12px; border-radius: 5px; font-size: 13px; font-weight: 600; cursor: pointer;">
                                        Set Dikirim
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 30px; text-align: center; color: #94a3b8;">
                                Belum ada data transaksi yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
