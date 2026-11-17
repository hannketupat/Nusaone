<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Mengambil riwayat transaksi, filter status, dan ringkasan 4 statistik
    public function transactions(Request $request)
    {
        $status_filter = $request->query('status');
        $allowed_status = ['Pending', 'Paid', 'Shipped'];

        $query = Transaction::latest();

        // Logika filter status (jika ada request 'status')
        if ($request->filled('status') && in_array($status_filter, $allowed_status, true)) {
            $query->where('status', $status_filter);
        } else {
            $status_filter = 'Semua';
        }

        $transactions = $query->get();

        // 4 Statistik Seller Center:
        // 1. Total Produk
        $total_products = Product::count();
        $total_produk = $total_products;

        // 2. Pending
        $pending_count = Transaction::where('status', 'Pending')->count();
        $pending = $pending_count;

        // 3. Paid+Shipped
        $processed_count = Transaction::whereIn('status', ['Paid', 'Shipped'])->count();
        $paid_shipped = $processed_count;

        // 4. Omzet Bersih (hanya sum dari status Paid dan Shipped)
        $net_revenue = (int) Transaction::whereIn('status', ['Paid', 'Shipped'])->sum('total_amount');
        $omzet_bersih = $net_revenue;

        return view('admin.transactions', compact(
            'transactions',
            'total_products',
            'total_produk',
            'pending_count',
            'pending',
            'processed_count',
            'paid_shipped',
            'net_revenue',
            'omzet_bersih',
            'status_filter'
        ));
    }

    // Memperbarui status pesanan dan wajib menangkap nomor resi (tracking_number)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Paid,Shipped',
            'tracking_number' => 'nullable|string|max:255',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'status' => $request->status,
            'tracking_number' => $request->tracking_number,
        ]);

        return back()->with('success', 'Pesanan '.$transaction->invoice_code.' berhasil diperbarui menjadi: '.$transaction->status);
    }

    // Menampilkan daftar seluruh produk untuk admin
    public function products()
    {
        $products = Product::latest()->get();

        return view('admin.products', compact('products'));
    }

    // Menampilkan halaman form tambah produk dengan opsi kategori
    public function createProduct()
    {
        $categories = Product::CATEGORIES;

        return view('admin.create_product', compact('categories'));
    }

    // Memproses dan menyimpan data produk baru
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'category' => 'required',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time().'_'.str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('assets/images'), $imageName);
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category' => $request->category,
            'stock' => $request->stock,
            'image' => $imageName,
        ]);

        return redirect('/admin/products')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menampilkan halaman form edit produk berdasarkan ID
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Product::CATEGORIES;

        return view('admin.edit_product', compact('product', 'categories'));
    }

    // Memproses perubahan data produk (Update)
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'category' => 'required',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $imageName = $product->image;

        // Jika Admin mengunggah foto baru, hapus foto lama lalu upload foto baru
        if ($request->hasFile('image')) {
            if ($imageName && file_exists(public_path('assets/images/'.$imageName))) {
                unlink(public_path('assets/images/'.$imageName));
            }

            $file = $request->file('image');
            $imageName = time().'_'.str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('assets/images'), $imageName);
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category' => $request->category,
            'stock' => $request->stock,
            'image' => $imageName,
        ]);

        return redirect('/admin/products')->with('success', 'Produk berhasil diperbarui!');
    }

    // Menghapus produk beserta file fotonya
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && file_exists(public_path('assets/images/'.$product->image))) {
            unlink(public_path('assets/images/'.$product->image));
        }

        $product->delete();

        return redirect('/admin/products')->with('success', 'Produk berhasil dihapus!');
    }
}
