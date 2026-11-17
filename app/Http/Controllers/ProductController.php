<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    // FUNGSI 1: Menampilkan seluruh produk di Katalog + Pencarian, Filter Kategori & Sorting
    public function index(Request $request)
    {
        $query = Product::query();

        // Logika Pencarian Real-Time (Search Bar)
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('description', 'LIKE', '%'.$keyword.'%');
            });
        }

        // Logika Filter Kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Logika Filter Harga (Sorting)
        if ($request->sort == 'termurah') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'termahal') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->get();

        $categories = Product::query()
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('katalog', compact('products', 'categories'));
    }

    // FUNGSI 2: Menampilkan 1 produk spesifik di halaman Detail
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('detail', compact('product'));
    }

    // FUNGSI 3: Menampilkan halaman Form Checkout dengan membawa data barang yang dipilih
    public function checkout($id)
    {
        $product = Product::findOrFail($id);

        return view('checkout', compact('product'));
    }

    // FUNGSI 4: Menangkap kiriman Form, validasi stok, menghitung total, dan menyimpan pesanan
    public function storeTransaction(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'customer_address' => ['required', 'string', 'max:1000'],
            'courier' => ['required', 'in:JNE Reguler,J&T Express,SiCepat BEST'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($request->integer('product_id'));

        $request->validate([
            'quantity' => ['max:'.$product->stock],
        ], [
            'quantity.max' => 'Jumlah beli melebihi stok tersedia (sisa '.$product->stock.' pcs).',
        ]);

        $transaction = DB::transaction(function () use ($request) {
            $product = Product::lockForUpdate()->findOrFail($request->integer('product_id'));
            $quantity = $request->integer('quantity');

            if ($quantity > $product->stock) {
                throw ValidationException::withMessages([
                    'quantity' => 'Stok tidak mencukupi. Sisa stok saat ini: '.$product->stock.'.',
                ]);
            }

            $shipping_cost = match ($request->courier) {
                'J&T Express' => 20000,
                'SiCepat BEST' => 25000,
                default => 15000,
            };

            $subtotal = $product->price * $quantity;
            $total_amount = $subtotal + $shipping_cost;

            do {
                $invoice_code = 'INV-2026-'.str_pad((string) random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            } while (Transaction::where('invoice_code', $invoice_code)->exists());

            $transaction = Transaction::create([
                'invoice_code' => $invoice_code,
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'product_name' => $product->name,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'courier' => $request->courier,
                'quantity' => $quantity,
                'shipping_cost' => $shipping_cost,
                'total_amount' => $total_amount,
                'status' => 'Pending',
                'tracking_number' => null,
            ]);

            $product->decrement('stock', $quantity);

            return $transaction;
        });

        return redirect('/berhasil/'.$transaction->id);
    }

    // FUNGSI 5: Menampilkan halaman E-Invoice berdasarkan ID Transaksi
    public function success($id)
    {
        $transaction = Transaction::findOrFail($id);

        // Cek kepemilikan: jika invoice bukan milik user login DAN bukan admin, tolak akses (403)
        if ((int) $transaction->user_id !== (int) Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki hak akses untuk melihat invoice pesanan ini.');
        }

        if (view()->exists('success')) {
            return view('success', compact('transaction'));
        }

        return view('berhasil', compact('transaction'));
    }
}
