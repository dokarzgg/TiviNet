# Website Tivi Internet

Website penyedia layanan **internet WiFi**, dibangun dengan **Laravel 13 + Blade + Tailwind CSS v4**, bertema **biru laut & putih awan**.

## Fitur

- **Beranda** — hero, **5 paket WiFi** (tampil per Mbps), keunggulan, cara pasang, tombol **Lihat Produk**
- **Produk** — **10 paket** (10 – 500 Mbps) dibagi **2 halaman** (5 per halaman): `1` · `2` · `Berikutnya`
- **Gradasi biru kartu otomatis**: makin tinggi Mbps, makin gelap warna kartunya (terang untuk 10 Mbps → biru laut pekat untuk 500 Mbps)
- **Popup detail** di setiap produk → tombol **Pasang Sekarang** → langsung muncul **formulir pendaftaran pasang WiFi baru** (paket otomatis terpilih)
- **Tentang Kami** — profil, visi, misi, nilai, lokasi + tombol Google Maps
- **Kontak** — formulir pesan + info kontak
- **Tombol WhatsApp mengambang** — klik → popup → *Mulai Chat* (membuka WhatsApp)
- Data pendaftaran tersimpan di tabel `installation_requests`

## Kebutuhan

| Perangkat lunak | Versi | Catatan |
|---|---|---|
| PHP | 8.3 atau lebih baru | aktifkan ekstensi `pdo_sqlite`, `sqlite3`, `mbstring`, `openssl`, `fileinfo`, `curl`, `zip` |
| Composer | 2.x | https://getcomposer.org |
| Node.js | 20 LTS atau lebih baru | https://nodejs.org |
| VS Code | terbaru | ekstensi: *PHP Intelephense*, *Laravel Blade Snippets* |

Cek di terminal: `php -v`, `composer -V`, `node -v`.

## Langkah menjalankan di VS Code

1. Ekstrak file zip, lalu di VS Code: **File → Open Folder…** → pilih folder `tivi-internet`.
2. Buka terminal: **Terminal → New Terminal** (`` Ctrl+` ``).
3. Jalankan perintah berikut satu per satu:

```bash
# 1. Pasang dependensi PHP
composer install

# 2. Salin file pengaturan
#    Windows (CMD / PowerShell):
copy .env.example .env
#    macOS / Linux:  cp .env.example .env

# 3. Buat kunci aplikasi
php artisan key:generate

# 4. Buat file database SQLite
#    Windows PowerShell:  New-Item database/database.sqlite -ItemType File
#    Windows CMD:         type nul > database\database.sqlite
#    macOS / Linux:       touch database/database.sqlite

# 5. Buat tabel + isi 10 paket WiFi
php artisan migrate --seed

# 6. Pasang & build front-end
npm install
npm run build
```

4. Jalankan website:

```bash
php artisan serve
```

5. Buka **http://127.0.0.1:8000** di browser.

> Saat mengubah tampilan/CSS/JS, jalankan `npm run dev` di terminal kedua (otomatis reload), atau `npm run build` lagi. Tailwind memindai kelas dari file Blade, jadi kelas baru baru muncul setelah `npm run dev`/`build` berjalan.

### Menjalankan tes

```bash
php artisan test
```

### Masalah yang sering muncul

| Pesan / gejala | Solusi |
|---|---|
| `could not find driver` | Di `php.ini` hapus tanda `;` pada `extension=pdo_sqlite` dan `extension=sqlite3`, lalu buka ulang terminal. |
| `Vite manifest not found` | Jalankan `npm run build`. |
| `No application encryption key has been specified` | Jalankan `php artisan key:generate`. |
| Tampilan polos tanpa gaya | Jalankan `npm run build` (atau `npm run dev`). |
| Port 8000 dipakai | `php artisan serve --port=8001` |

### Memakai MySQL (XAMPP / Laragon) — opsional

Buat database kosong (mis. `tivi`), ubah `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tivi
DB_USERNAME=root
DB_PASSWORD=
```

lalu `php artisan migrate --seed`.

## Mengubah isi website

| Yang ingin diubah | File |
|---|---|
| Nama, alamat, link Google Maps, nomor WhatsApp, jam layanan | `config/company.php` |
| Paket, harga, deskripsi (10 produk) | `database/seeders/ProductSeeder.php` → lalu `php artisan migrate:fresh --seed` |
| Paket yang tampil di beranda | kolom `is_featured` di seeder (5 paket) |
| Jumlah produk per halaman | `app/Http/Controllers/ProductController.php` (`paginate(5)`) |
| Warna tema | `resources/css/app.css` (bagian `@theme`) |
| Gradasi warna kartu per kecepatan | `app/Models/Product.php` (`getCardGradientAttribute`, tiga titik warna) |
| Kartu paket | `resources/views/partials/product-card.blade.php` |
| Tampilan pagination | `resources/views/vendor/pagination/tivi.blade.php` |
| Teks halaman | `resources/views/pages/*.blade.php` |
| Formulir pendaftaran (popup) | `resources/views/partials/install-modal.blade.php` |
| Popup detail produk | `resources/views/partials/product-modal.blade.php` |
| Tombol WhatsApp | `resources/views/partials/whatsapp.blade.php` |

**Logo:** simpan logo Anda sebagai `public/images/logo.png` — otomatis dipakai di header dan footer. Jika file belum ada, tampil logo bawaan (ikon WiFi).

> **Penting:** harga paket, alamat teks, email, serta teks visi/misi adalah **contoh**. Ganti dengan data resmi sebelum website dipublikasikan.

## Melihat data pendaftaran yang masuk

```bash
php artisan tinker
>>> App\Models\InstallationRequest::with('product')->latest()->get(['id','product_id','name','phone','address','status','created_at']);
```

Pesan dari halaman Kontak: `App\Models\ContactMessage::latest()->get();`

## Struktur penting

```
app/Http/Controllers/   PageController, ProductController, InstallationController, ContactController
app/Models/             Product, InstallationRequest, ContactMessage
config/company.php      data perusahaan, WhatsApp, Google Maps
database/migrations/    products, installation_requests, contact_messages
database/seeders/       ProductSeeder (10 paket)
resources/views/        layouts/, partials/, pages/
resources/css/app.css   Tailwind v4: tema biru laut & putih awan, komponen (btn, field, modal, dll.)
resources/js/app.js     popup (<dialog>), menu mobile, tombol WhatsApp
routes/web.php          daftar route
tests/Feature/          WebsiteTest (10 tes)
```

Berbasis kerangka kerja [Laravel](https://laravel.com) (lisensi MIT).
