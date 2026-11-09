<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Mengambil riwayat transaksi dan ringkasan statistik
    public function transactions()
    {
        $transactions = Transaction::latest()->get();
        $total_products = Product::count();
        $total_transactions = Transaction::count();
        $total_amount = Transaction::sum('total_amount');

        $product_count = $total_products;
        $transaction_count = $total_transactions;
        $total_revenue = $total_amount;

        return view('admin.transactions', compact(
            'transactions',
            'total_products',
            'total_transactions',
            'total_amount',
            'product_count',
            'transaction_count',
            'total_revenue'
        ));
    }

    // Memperbarui status pesanan transaksi
    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pesanan ' . $transaction->invoice_code . ' berhasil diubah menjadi: ' . $request->status);
    }

    // Menampilkan daftar seluruh produk untuk admin
    public function products()
    {
        $products = Product::latest()->get();
        return view('admin.products', compact('products'));
    }

    // Menampilkan halaman form tambah produk
    public function createProduct()
    {
        return view('admin.create_product');
    }

    // Memproses dan menyimpan data produk baru
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('assets/images'), $imageName);
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect('/admin/products')->with('success', 'Produk berhasil ditambahkan!');
    }
}
