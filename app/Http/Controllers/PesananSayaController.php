<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class PesananSayaController extends Controller
{
    // Menampilkan riwayat transaksi milik customer yang sedang login
    public function index()
    {
        $transactions = Transaction::query()
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        if (view()->exists('pesanan-saya')) {
            return view('pesanan-saya', compact('transactions'));
        }

        return view('pesanan_saya', compact('transactions'));
    }
}
