<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Daftar kategori produk yang tersedia di etalase.
     *
     * @var array<int, string>
     */
    public const CATEGORIES = ['Atasan', 'Bawahan', 'Jaket', 'Aksesoris'];

    protected $guarded = [];
}
