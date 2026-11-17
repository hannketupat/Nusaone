<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedUsers();
        $this->seedProducts();
    }

    /**
     * Akun admin & customer untuk pengujian multi-role.
     */
    private function seedUsers(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@toko.com'],
            [
                'name' => 'Admin Official Store',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '081200000001',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer1@gmail.com'],
            [
                'name' => 'Customer Satu',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'phone' => '081200000002',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer2@gmail.com'],
            [
                'name' => 'Customer Dua',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'phone' => '081200000003',
            ]
        );
    }

    /**
     * Data katalog awal. Produk lama hanya diperbarui kategori & stoknya,
     * sedangkan nama, harga, deskripsi, dan foto asli tidak diubah.
     */
    private function seedProducts(): void
    {
        $products = [
            [
                'name' => 'Outer Batik Motif Biru Putih Wanita – Kimono Belt Elegan',
                'description' => 'Outer wanita dengan motif batik bernuansa biru dan putih yang memberikan kesan elegan dan klasik. Dilengkapi tali pinggang untuk menyesuaikan bentuk pemakaian. Model lengan melebar membuat tampilan terlihat lebih stylish dan cocok dipadukan dengan berbagai outfit.',
                'price' => 1500000,
                'image' => 'batik1.jpeg',
                'category' => 'Jaket',
                'stock' => 12,
            ],
            [
                'name' => 'Outer Batik Motif Pink Putih Wanita – Kimono Belt Elegan',
                'description' => 'Outer wanita dengan motif batik bernuansa pink dan putih yang memberikan kesan elegan dan klasik. Dilengkapi tali pinggang untuk menyesuaikan bentuk pemakaian. Model lengan melebar membuat tampilan terlihat lebih stylish dan cocok dipadukan dengan berbagai outfit.',
                'price' => 2000000,
                'image' => 'batik2.jpeg',
                'category' => 'Jaket',
                'stock' => 10,
            ],
            [
                'name' => 'Tas Anyaman Handmade Natural dengan Handle Kayu – Tote Bag Etnik',
                'description' => 'Tas anyaman dengan warna natural yang memberikan kesan simpel, unik, dan natural. Dilengkapi handle berbahan kayu sehingga tampil semakin menarik. Cocok digunakan untuk jalan-jalan, liburan, maupun sebagai pelengkap outfit bernuansa natural dan etnik.',
                'price' => 250000,
                'image' => 'batik3.jpeg',
                'category' => 'Aksesoris',
                'stock' => 18,
            ],
            [
                'name' => 'selendang tenun etnik coklat motif geometris – aksesori fashion',
                'description' => 'selendang bernuansa coklat dengan motif geometris khas etnik yang memberikan tampilan unik dan berkarakter. Detail motif pada bagian tengah serta aksen rumbai di bagian ujung membuatnya cocok digunakan sebagai pelengkap busana.',
                'price' => 300000,
                'image' => 'batik4.jpeg',
                'category' => 'Aksesoris',
                'stock' => 15,
            ],
            [
                'name' => 'Selendang Tenun Etnik Merah Motif Geometris – Aksesori Fashion',
                'description' => 'Selendang bernuansa merah dengan motif geometris khas etnik yang memberikan tampilan unik dan berkarakter. Detail motif pada bagian tengah serta aksen rumbai di bagian ujung membuatnya cocok digunakan sebagai pelengkap busana.',
                'price' => 350000,
                'image' => 'batik5.png',
                'category' => 'Aksesoris',
                'stock' => 10,
            ],
            [
                'name' => 'Gelang Tali Etnik Handmade Motif Warna-Warni – Aksesori Unisex',
                'description' => 'Gelang tali dengan kombinasi warna merah, hitam, dan putih serta aksen manik-manik warna-warni. Desainnya simpel namun unik sehingga cocok digunakan sebagai aksesori sehari-hari atau dipadukan dengan gaya outfit etnik dan casual.',
                'price' => 400000,
                'image' => 'batik6.png',
                'category' => 'Aksesoris',
                'stock' => 25,
            ],
            [
                'name' => 'Kemeja Batik Pria Lengan Panjang Motif Parang Klasik',
                'description' => 'Kemeja batik pria lengan panjang dengan motif parang klasik berwarna coklat sogan. Bahan katun primisima yang adem dan nyaman digunakan untuk acara formal maupun kasual.',
                'price' => 275000,
                'image' => null,
                'category' => 'Atasan',
                'stock' => 20,
            ],
            [
                'name' => 'Blouse Batik Wanita Lengan Pendek Motif Kawung Modern',
                'description' => 'Blouse batik wanita dengan potongan modern dan motif kawung bernuansa biru. Menggunakan bahan katun halus sehingga nyaman dipakai seharian.',
                'price' => 320000,
                'image' => null,
                'category' => 'Atasan',
                'stock' => 16,
            ],
            [
                'name' => 'Rok Tenun Etnik Panjang Motif Garis Nusantara',
                'description' => 'Rok tenun panjang dengan motif garis khas Nusantara. Cocok dipadukan dengan atasan polos untuk tampilan etnik yang elegan.',
                'price' => 450000,
                'image' => null,
                'category' => 'Bawahan',
                'stock' => 14,
            ],
        ];

        foreach ($products as $data) {
            $product = Product::firstOrNew(['name' => $data['name']]);

            if (! $product->exists) {
                $product->fill($data);
            } else {
                $product->category = $data['category'];
                $product->stock = $data['stock'];
            }

            $product->save();
        }
    }
}
