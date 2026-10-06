<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Outer Batik Motif Biru Putih Wanita – Kimono Belt Elegan',
            'description' => 'Outer wanita dengan motif batik bernuansa biru dan putih yang memberikan kesan elegan dan klasik. Dilengkapi tali pinggang untuk menyesuaikan bentuk pemakaian. Model lengan melebar membuat tampilan terlihat lebih stylish dan cocok dipadukan dengan berbagai outfit.',
            'price' => 1500000,
            'image' => 'batik1.jpeg'
        ]);

        Product::create([
            'name' => 'Outer Batik Motif Pink Putih Wanita – Kimono Belt Elegan',
            'description' => 'Outer wanita dengan motif batik bernuansa pink dan putih yang memberikan kesan elegan dan klasik. Dilengkapi tali pinggang untuk menyesuaikan bentuk pemakaian. Model lengan melebar membuat tampilan terlihat lebih stylish dan cocok dipadukan dengan berbagai outfit.',
            'price' => 2000000,
            'image' => 'batik2.jpeg'
        ]);

        Product::create([
            'name' => 'Tas Anyaman Handmade Natural dengan Handle Kayu – Tote Bag Etnik',
            'description' => 'Tas anyaman dengan warna natural yang memberikan kesan simpel, unik, dan natural. Dilengkapi handle berbahan kayu sehingga tampil semakin menarik. Cocok digunakan untuk jalan-jalan, liburan, maupun sebagai pelengkap outfit bernuansa natural dan etnik.',
            'price' => 250000,
            'image' => 'batik3.jpeg'
        ]);

        Product::create([
            'name' => 'selendang tenun etnik coklat motif geometris – aksesori fashion',
            'description' => 'selendang bernuansa coklat dengan motif geometris khas etnik yang memberikan tampilan unik dan berkarakter. Detail motif pada bagian tengah serta aksen rumbai di bagian ujung membuatnya cocok digunakan sebagai pelengkap busana.',
            'price' => 300000,
            'image' => 'batik4.jpeg'
        ]);

        Product::create([
            'name' => 'Selendang Tenun Etnik Merah Motif Geometris – Aksesori Fashion',
            'description' => 'Selendang bernuansa merah dengan motif geometris khas etnik yang memberikan tampilan unik dan berkarakter. Detail motif pada bagian tengah serta aksen rumbai di bagian ujung membuatnya cocok digunakan sebagai pelengkap busana.',
            'price' => 350000,
            'image' => 'batik5.png'
        ]);

        Product::create([
            'name' => 'Gelang Tali Etnik Handmade Motif Warna-Warni – Aksesori Unisex',
            'description' => 'Gelang tali dengan kombinasi warna merah, hitam, dan putih serta aksen manik-manik warna-warni. Desainnya simpel namun unik sehingga cocok digunakan sebagai aksesori sehari-hari atau dipadukan dengan gaya outfit etnik dan casual.',
            'price' => 400000,
            'image' => 'batik6.png'
        ]);
    }
}
