<footer class="bg-sea-950 pt-14 text-white/70">
    <div class="container-x">
        <div class="grid gap-10 pb-10 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <div class="mb-4 flex items-center gap-2.5">
                    @include('partials.logo', ['uid' => 'ftr', 'size' => 40])
                    <strong class="text-xl text-white">{{ config('company.name') }}</strong>
                </div>
                <p class="max-w-md">
                    {{ config('company.tagline') }}. Pilih paket sesuai kebutuhan, daftar online, dan teknisi kami siap memasang di lokasi Anda.
                </p>
            </div>

            <div class="lg:col-span-3">
                <h6 class="mb-4 font-bold text-white">Menu</h6>
                <ul class="grid gap-2">
                    <li><a class="transition hover:text-sky-300" href="{{ route('home') }}">Beranda</a></li>
                    <li><a class="transition hover:text-sky-300" href="{{ route('about') }}">Tentang Kami</a></li>
                    <li><a class="transition hover:text-sky-300" href="{{ route('products.index') }}">Produk</a></li>
                    <li><a class="transition hover:text-sky-300" href="{{ route('contact') }}">Kontak</a></li>
                </ul>
            </div>

            <div class="lg:col-span-4">
                <h6 class="mb-4 font-bold text-white">Kontak</h6>
                <ul class="grid gap-3">
                    <li class="flex gap-2.5">
                        <i class="bi bi-geo-alt text-sky-400"></i>
                        <span>
                            {{ config('company.address') }}
                            <a href="{{ config('company.maps_url') }}" target="_blank" rel="noopener" class="block text-sm transition hover:text-sky-300">Lihat di Google Maps</a>
                        </span>
                    </li>
                    <li class="flex gap-2.5">
                        <i class="bi bi-whatsapp text-sky-400"></i>
                        <a class="transition hover:text-sky-300" href="https://wa.me/{{ config('company.whatsapp') }}" target="_blank" rel="noopener">{{ config('company.whatsapp_display') }}</a>
                    </li>
                    <li class="flex gap-2.5"><i class="bi bi-clock text-sky-400"></i><span>{{ config('company.hours') }}</span></li>
                </ul>
            </div>
        </div>

        <div class="flex flex-col justify-between gap-1 border-t border-white/10 py-4 text-sm md:flex-row">
            <span>&copy; {{ date('Y') }} {{ config('company.name') }}. Hak cipta dilindungi.</span>
            <span>Penyedia layanan internet WiFi</span>
        </div>
    </div>
</footer>
