<header class="sticky top-0 z-40 border-b border-sky-100 bg-white/90 backdrop-blur">
    <div class="container-x">
        <div class="flex items-center justify-between py-3">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 font-extrabold tracking-tight text-sea-900">
                @include('partials.logo', ['uid' => 'hdr', 'size' => 40])
                <span class="leading-tight">
                    {{ config('company.short_name') }}
                    <span class="block text-[.68rem] font-semibold uppercase tracking-[.08em] text-sky-500">Internet WiFi</span>
                </span>
            </a>

            <button id="navToggle" type="button" aria-controls="mainNav" aria-expanded="false" aria-label="Buka menu"
                    class="rounded-lg p-2 text-2xl text-sea-900 hover:bg-sky-50 lg:hidden">
                <i class="bi bi-list"></i>
            </button>

            @php
                $link = fn ($active) => 'block rounded-lg px-4 py-2 text-sm font-semibold transition ' . ($active ? 'bg-sky-100 text-sea-700' : 'text-slate-700 hover:bg-sky-50 hover:text-sea-700');
            @endphp
            <nav id="mainNav" class="absolute inset-x-0 top-full hidden border-b border-sky-100 bg-white p-4 shadow-lg lg:static lg:flex lg:border-0 lg:bg-transparent lg:p-0 lg:shadow-none lg:items-center lg:gap-1">
                <a class="{{ $link(request()->routeIs('home')) }}" href="{{ route('home') }}">Beranda</a>
                <a class="{{ $link(request()->routeIs('about')) }}" href="{{ route('about') }}">Tentang Kami</a>
                <a class="{{ $link(request()->routeIs('products.*')) }}" href="{{ route('products.index') }}">Produk</a>
                <a class="{{ $link(request()->routeIs('contact')) }}" href="{{ route('contact') }}">Kontak</a>
                <button type="button" data-modal-open="installModal" class="btn btn-primary mt-2 w-full lg:ml-2 lg:mt-0 lg:w-auto">
                    <i class="bi bi-wifi"></i> Pasang WiFi
                </button>
            </nav>
        </div>
    </div>
</header>
