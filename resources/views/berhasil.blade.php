@extends('layouts.master')

@section('styles')
<style>
    .invoice-wrap { max-width: 760px; margin: 0 auto; }
    .invoice-card { background-color: #ffffff; padding: 40px; border-radius: 14px; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(10, 25, 47, 0.07); }
    .invoice-success { text-align: center; border-bottom: 2px dashed #e2e8f0; padding-bottom: 22px; margin-bottom: 26px; }
    .invoice-success .check-icon { font-size: 52px; line-height: 1; margin-bottom: 8px; }
    .invoice-success h2 { color: #16a34a; margin: 0 0 6px; font-size: 24px; font-weight: 800; }
    .invoice-success p { color: #64748b; margin: 0; font-size: 14px; }
    .invoice-brand { display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; flex-wrap: wrap; margin-bottom: 22px; }
    .invoice-brand h3 { font-size: 22px; font-weight: 800; color: #0A192F; margin: 0 0 4px; letter-spacing: -0.4px; }
    .invoice-brand h3 span { color: #C5A059; }
    .invoice-brand p { font-size: 12px; color: #64748b; margin: 0; }
    .invoice-code-box { text-align: right; }
    .invoice-code-box span { display: block; font-size: 11px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; }
    .invoice-code-box strong { font-size: 18px; color: #0A192F; }
    .invoice-table { width: 100%; border-collapse: collapse; margin-bottom: 22px; font-size: 14px; }
    .invoice-table td { padding: 9px 0; color: #64748b; vertical-align: top; }
    .invoice-table td:last-child { text-align: right; color: #0A192F; font-weight: 600; }
    .invoice-table .total-row td { border-top: 2px solid #e2e8f0; padding-top: 16px; font-size: 17px; font-weight: 800; color: #0A192F; }
    .invoice-table .total-row td:last-child { font-size: 22px; color: #C5A059; font-weight: 800; }
    .badge { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 800; }
    .badge-pending { background-color: #fef3c7; color: #92400e; }
    .badge-paid { background-color: #dbeafe; color: #1e40af; }
    .badge-shipped { background-color: #d1fae5; color: #065f46; }
    .badge-default { background-color: #f1f5f9; color: #475569; }
    .invoice-note { background-color: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 10px; padding: 14px 16px; font-size: 12px; color: #64748b; line-height: 1.6; margin-bottom: 24px; }
    .invoice-actions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
    .btn-print { background-color: #0A192F; color: #ffffff; border: 1px solid #0A192F; padding: 12px 24px; border-radius: 10px; font-family: inherit; font-size: 14px; font-weight: 700; cursor: pointer; transition: all 0.2s ease; }
    .btn-print:hover { background-color: #C5A059; border-color: #C5A059; color: #ffffff; }
    .btn-kembali { display: inline-block; background-color: #f8fafc; color: #0A192F; border: 1px solid #cbd5e1; padding: 12px 22px; border-radius: 10px; font-size: 14px; font-weight: 700; text-decoration: none; transition: all 0.2s ease; }
    .btn-kembali:hover { background-color: #C5A059; border-color: #C5A059; color: #ffffff; }

    @media print {
        .navbar,
        .footer,
        .store-header,
        .store-footer,
        .btn-print,
        .btn-kembali,
        .invoice-actions {
            display: none !important;
        }
        body {
            background: white !important;
        }
        main,
        .store-main {
            padding: 0 !important;
            max-width: 100% !important;
        }
        .invoice-wrap {
            max-width: 100%;
        }
        .invoice-card {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }
        .invoice-note {
            background: #ffffff !important;
        }
    }
    @media (max-width: 768px) {
        .invoice-card { padding: 24px 18px; }
        .invoice-brand { flex-direction: column; }
        .invoice-code-box { text-align: left; }
    }
</style>
@endsection

@section('konten')
    <div class="invoice-wrap">
        <div class="invoice-card">
            <div class="invoice-success">
                <div class="check-icon">&#9989;</div>
                <h2>Transaksi Berhasil Tercatat!</h2>
                <p>Terima kasih <strong>{{ $transaction->customer_name }}</strong>, pesanan Anda sedang kami proses.</p>
            </div>

            <div class="invoice-brand">
                <div>
                    <h3>NUSA<span>ONE</span></h3>
                    <p>E-Invoice / Struk Pembelian</p>
                </div>
                <div class="invoice-code-box">
                    <span>Nomor Invoice</span>
                    <strong>{{ $transaction->invoice_code }}</strong>
                </div>
            </div>

            <table class="invoice-table">
                <tr>
                    <td>Waktu Transaksi</td>
                    <td>{{ $transaction->created_at ? $transaction->created_at->format('d M Y, H:i') : '-' }} WIB</td>
                </tr>
                <tr>
                    <td>Produk yang Dibeli</td>
                    <td>{{ $transaction->product_name }} {{ $transaction->quantity }}x</td>
                </tr>
                <tr>
                    <td>Penerima &amp; No. HP</td>
                    <td>{{ $transaction->customer_name }} &bull; {{ $transaction->customer_phone }}</td>
                </tr>
                <tr>
                    <td>Alamat Pengiriman</td>
                    <td>{{ $transaction->customer_address }}</td>
                </tr>
                <tr>
                    <td>Ekspedisi &amp; Ongkos Kirim</td>
                    <td>{{ $transaction->courier }} (Rp {{ number_format($transaction->shipping_cost, 0, ',', '.') }})</td>
                </tr>
                <tr>
                    <td>Nomor Resi</td>
                    <td>{{ $transaction->tracking_number ?: 'Belum tersedia' }}</td>
                </tr>
                <tr>
                    <td>Status Pesanan</td>
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
                </tr>
                <tr class="total-row">
                    <td>TOTAL PEMBAYARAN</td>
                    <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                </tr>
            </table>

            <div class="invoice-note">
                Simpan invoice ini sebagai bukti pembelian yang sah. Pembayaran dianggap lunas setelah
                status pesanan berubah menjadi Paid atau Shipped.
            </div>

            <div class="invoice-actions">
                <button type="button" onclick="window.print()" class="btn-print">Cetak Invoice</button>
                <a href="/" class="btn-kembali">&larr; Kembali Belanja ke Beranda</a>
            </div>
        </div>
    </div>
@endsection
