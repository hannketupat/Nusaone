@extends('layouts.admin')

@section('konten_admin')
    <style>
        .btn-save {
            background-color: #0A192F;
            color: #ffffff;
            border: 1px solid #0A192F;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(10, 25, 47, 0.2);
            transition: all 0.2s ease;
        }
        .btn-save:hover {
            background-color: #C5A059;
            border-color: #C5A059;
            color: #ffffff;
        }
        .link-back {
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
            transition: color 0.2s;
        }
        .link-back:hover {
            color: #C5A059;
        }
    </style>

    {{-- Header Halaman --}}
    <div style="margin-bottom: 25px;">
        <a href="/admin/products" class="link-back">
            &larr; Kembali ke Katalog Produk
        </a>
        <h2 style="font-size: 24px; font-weight: 800; color: #0A192F; margin-bottom: 4px;">Tambah Produk Baru</h2>
        <p style="color: #64748b; font-size: 14px;">Isi formulir di bawah ini untuk menambahkan barang dagangan baru ke katalog.</p>
    </div>

    {{-- Error Validasi --}}
    @if($errors->any())
        <div style="background-color: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; padding: 16px 20px; margin-bottom: 25px; color: #991b1b;">
            <div style="font-weight: 700; margin-bottom: 8px; font-size: 14px;">Terjadi kesalahan pengisian form:</div>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; line-height: 1.6;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah Produk (2 Kolom) --}}
    <form action="/admin/products/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1.6fr; gap: 30px; align-items: start;">
            
            {{-- KOLOM KIRI: Upload & Live Preview Gambar --}}
            <div style="background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <label style="display: block; font-weight: 700; color: #0A192F; font-size: 15px; margin-bottom: 8px;">
                    Foto Produk <span style="color: #ef4444;">*</span>
                </label>
                <p style="color: #64748b; font-size: 13px; margin-bottom: 16px;">
                    Format JPG, JPEG, PNG, atau WEBP (Maksimal 2MB).
                </p>

                {{-- Area Dropzone / Preview --}}
                <div style="position: relative; border: 2px dashed #cbd5e1; border-radius: 10px; padding: 20px; text-align: center; background-color: #f8fafc; cursor: pointer; transition: border-color 0.2s;" onclick="document.getElementById('image-input').click();">
                    
                    {{-- Placeholder saat belum ada gambar terpilih --}}
                    <div id="preview-placeholder" style="padding: 30px 10px;">
                        <div style="font-size: 38px; margin-bottom: 10px; color: #94a3b8;">📷</div>
                        <p style="font-weight: 600; color: #334155; font-size: 14px; margin-bottom: 4px;">Pilih atau Unggah Foto</p>
                        <p style="color: #94a3b8; font-size: 12px;">Klik di sini untuk memilih file</p>
                    </div>

                    {{-- Elemen Image Live Preview --}}
                    <img id="preview-image" src="#" alt="Preview" style="display: none; width: 100%; max-height: 280px; object-fit: contain; border-radius: 8px; margin: 0 auto;">
                </div>

                <input type="file" id="image-input" name="image" accept="image/*" style="display: none;" onchange="previewFile(this)" required>

                <div style="margin-top: 14px; text-align: center;">
                    <button type="button" onclick="document.getElementById('image-input').click();" style="background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;">
                        Pilih File Gambar
                    </button>
                </div>
            </div>

            {{-- KOLOM KANAN: Data Nama, Harga, Deskripsi --}}
            <div style="background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 28px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                
                {{-- Input Nama Produk --}}
                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; font-weight: 700; color: #0A192F; font-size: 14px; margin-bottom: 8px;">
                        Nama Produk <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Outer Batik Motif Biru Putih" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; font-family: inherit; color: #0A192F; outline: none; transition: border-color 0.2s, box-shadow 0.2s;" onfocus="this.style.borderColor='#C5A059'; this.style.boxShadow='0 0 0 3px rgba(197, 160, 89, 0.15)';" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none';">
                </div>

                {{-- Input Harga (Prefix Rp) --}}
                <div style="margin-bottom: 20px;">
                    <label for="price" style="display: block; font-weight: 700; color: #0A192F; font-size: 14px; margin-bottom: 8px;">
                        Harga Satuan <span style="color: #ef4444;">*</span>
                    </label>
                    <div style="display: flex; align-items: center; border: 1px solid #cbd5e1; border-radius: 8px; overflow: hidden; background-color: #ffffff; transition: border-color 0.2s;">
                        <span style="background-color: #f1f5f9; color: #475569; font-weight: 700; font-size: 14px; padding: 12px 16px; border-right: 1px solid #cbd5e1;">
                            Rp
                        </span>
                        <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="0" min="0" required style="width: 100%; padding: 12px 16px; border: none; font-size: 15px; font-weight: 600; font-family: inherit; color: #0A192F; outline: none;">
                    </div>
                </div>

                {{-- Input Kategori --}}
                <div style="margin-bottom: 20px;">
                    <label for="category" style="display: block; font-weight: 700; color: #0A192F; font-size: 14px; margin-bottom: 8px;">
                        Kategori Produk <span style="color: #ef4444;">*</span>
                    </label>
                    <select id="category" name="category" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; font-family: inherit; color: #0A192F; outline: none; background-color: #ffffff; cursor: pointer;">
                        <option value="" disabled {{ old('category') ? '' : 'selected' }}>-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Input Stok --}}
                <div style="margin-bottom: 20px;">
                    <label for="stock" style="display: block; font-weight: 700; color: #0A192F; font-size: 14px; margin-bottom: 8px;">
                        Stok Awal <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" placeholder="0" min="0" required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; font-family: inherit; color: #0A192F; outline: none;">
                </div>

                {{-- Textarea Deskripsi --}}
                <div style="margin-bottom: 24px;">
                    <label for="description" style="display: block; font-weight: 700; color: #0A192F; font-size: 14px; margin-bottom: 8px;">
                        Deskripsi Lengkap <span style="color: #ef4444;">*</span>
                    </label>
                    <textarea id="description" name="description" rows="5" placeholder="Tuliskan deskripsi lengkap mengenai bahan, motif, ukuran, dan keunikan produk..." required style="width: 100%; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; font-family: inherit; color: #0A192F; outline: none; line-height: 1.5; resize: vertical; transition: border-color 0.2s, box-shadow 0.2s;" onfocus="this.style.borderColor='#C5A059'; this.style.boxShadow='0 0 0 3px rgba(197, 160, 89, 0.15)';" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none';">{{ old('description') }}</textarea>
                </div>

                {{-- Tombol Submit & Batal --}}
                <div style="display: flex; gap: 12px; align-items: center;">
                    <button type="submit" class="btn-save">
                        Simpan Produk
                    </button>
                    <a href="/admin/products" style="background-color: #f1f5f9; color: #475569; text-decoration: none; padding: 12px 20px; border-radius: 8px; font-size: 14px; font-weight: 600;">
                        Batal
                    </a>
                </div>

            </div>

        </div>
    </form>

    {{-- Script JavaScript Live Preview Gambar --}}
    <script>
        function previewFile(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview-image');
                    const placeholder = document.getElementById('preview-placeholder');
                    
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    if (placeholder) {
                        placeholder.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
