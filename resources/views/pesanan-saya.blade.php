@extends('layouts.master')

@section('styles')
<style>
    .orders-header { margin-bottom: 24px; }
    .orders-header h2 { font-size: 26px; font-weight: 800; color: #0A192F; margin-bottom: 6px; }
    .orders-header p { color: #64748b; font-size: 14px; }
    .orders-card { background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; box-shadow: 0 2px 10px rgba(10, 25, 47, 0.04); }
    .orders-table { width: 100%; border-collapse: collapse; font-size: 14px; }
    .orders-table thead tr { background-color: #f8fafc; color: #475569; text-align: left; }
    .orders-table th { padding: 14px 18px; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; }
    .orders-table td { padding: 16px 18px; border-top: 1px solid #f1f5f9; vertical-align: top; }
    .invoice-code { font-weight: 800; color: #0A192F; }
    .order-date { display: block; font-size: 12px; color: #94a3b8; font-weight: 500; margin-top: 3px; }
    .order-product { font-weight: 700; color: #0A192F; }
    .order-qty { color: #64748b; }
    .badge { display: inline-block; padding: 5px 11px; border-radius: 999px; font-size: 12px; font-weight: 800; }
    .badge-pending { background-color: #fef3c7; color: #92400e; }
    .badge-paid { background-color: #dbeafe; color: #1e40af; }
    .badge-shipped { background-color: #d1fae5; color: #065f46; }
    .badge-default { background-color: #f1f5f9; color: #475569; }
    .btn-invoice { display: inline-block; color: #0A192F; text-decoration: none; font-weight: 700; font-size: 13px; padding: 7px 13px; border-radius: 8px; border: 1px solid #C5A059; background-color: #FDFBF7; transition: all 0.2s ease; }
    .btn-invoice:hover { background-color: #C5A059; color: #ffffff; }
    .empty-orders { text-align: center; padding: 70px 24px; background-color: #ffffff; border: 1px dashed #cbd5e1; border-radius: 16px; }
    .empty-orders .empty-icon { width: 74px; height: 74px; margin: 0 auto 18px; display: flex; align-items: center; justify-content: center; background-color: #f1f5f9; border-radius: 50%; font-size: 30px; }
    .empty-orders h3 { font-size: 20px; font-weight: 800; color: #0A192F; margin-bottom: 8px; }
    .empty-orders p { color: #64748b; font-size: 14px; margin-bottom: 20px; }
    .btn-shop { display: inline-block; background-color: #0A192F; color: #ffffff; text-decoration: none; font-weight: 700; font-size: 14px; padding: 11px 22px; border-radius: 10px; border: 1px solid #0A192F; transition: all 0.2s ease; }
    .btn-shop:hover { background-color: #C5A059; border-color: #C5A059; color: #ffffff; }
    .order-mobile-label { display: none; }
    @media (max-width: 768px) {
        .orders-table thead { display: none; }
        .orders-table, .orders-table tbody, .orders-table tr, .orders-table td { display: block; width: 100%; }
        .orders-table tr { padding: 14px 16px; border-top: 1px solid #e2e8f0; }
        .orders-table td { border: none; padding: 6px 0; }
        .order-mobile-label { display: inline-block; min-width: 110px; color: #94a3b8; font-size: 12px; font-weight: 700; text-transform: uppercase; }
    }
</style>
@endsection

@section('konten')
    <div class="orders-header">
        <h2>Pesanan Saya</h2>
        <p>Riwayat transaksi yang Anda buat di NusaOne, diurutkan dari yang terbaru.</p>
    </div>

    @if($transactions->isEmpty())
        <div class="empty-orders">
            <div class="empty-icon">&#128722;</div>
            <h3>Belum ada pesanan</h3>
            <p>Anda belum melakukan pemesanan. Yuk mulai belanja produk pilihan NusaOne.</p>
            <a href="/" class="btn-shop">Mulai Belanja</a>
        </div>
    @else
        <div class="orders-card">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Produk</th>
                        <th>Kurir</th>
                        <th>No. Resi</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>
                                <span class="invoice-code">{{ $transaction->invoice_code }}</span>
                                <span class="order-date">{{ $transaction->created_at ? $transaction->created_at->format('d M Y, H:i') : '-' }}</span>
                            </td>
                            <td>
                                <span class="order-product">{{ $transaction->product_name }}</span>
                                <span class="order-qty">({{ $transaction->quantity }}x)</span>
                            </td>
                            <td>
                                <span class="order-mobile-label">Kurir:</span>
                                {{ $transaction->courier }}
                            </td>
                            <td>
                                <span class="order-mobile-label">Resi:</span>
                                {{ $transaction->tracking_number ?: '-' }}
                            </td>
                            <td>
                                <span class="order-mobile-label">Total:</span>
                                <strong>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                @if($transaction->status == 'Pending')
                                    <span class="badge badge-pending">Pending</span>
                                @elseif($transaction->status == 'Paid')
                                    <span class="badge badge-paid">Paid</span>
                                @elseif($transaction->status == 'Shipped')
                                    <span class="badge badge-shipped">Shipped</span>
                                @else
                                    <span class="badge badge-default">{{ $transaction->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="/berhasil/{{ $transaction->id }}" class="btn-invoice">Lihat Invoice</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
